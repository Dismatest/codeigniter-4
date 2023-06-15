<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\DisplayDashboardModel;
use App\Models\Users;
use App\Models\Shares;
use App\Models\Sacco;
use App\Models\SaccoMembership;
use App\Models\LoginActivityModel;
use App\Models\Notification;
use App\Models\SharesOnSale;
use App\Models\SaccoShares;
use App\Models\BidShares;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use Ramsey\Uuid\Uuid;

class Home extends BaseController


{
    use ResponseTrait;

    public $displayDashboard;
    public $email;
    public $shares;
    public $sharesOnSale;
    public $users;
    public $sacco;
    public $saccoShares;
    public $saccoMembershp;
    public $notification;
    public $bidShares;
    public $loginActivityModel;

    public function __construct()
    {
        helper(['form', 'url', 'text', 'date']);
        $this->displayDashboard = new DisplayDashboardModel();
        $this->email = \Config\Services::email();
        $this->shares = new Shares();
        $this->users = new Users();
        $this->sacco = new Sacco();
        $this->saccoMembershp = new SaccoMembership();
        $this->notification = new Notification();
        $this->sharesOnSale = new SharesOnSale();
        $this->saccoShares = new SaccoShares();
        $this->bidShares = new BidShares();
        $this->loginActivityModel = new LoginActivityModel();
    }

    public function welcomePage()
    {
        try {
            $getActiveShares = $this->displayDashboard->getActiveShares();
            $data = [
                'activeShares' => $getActiveShares,
                'WelcomePageTitle' => 'welcome to share market',
            ];
        } catch (\CodeIgniter\Database\Exceptions\DataBaseException $e) {
            $data = [
                'error' => $e,
            ];
            $this->displayDashboard->insertError($data);
        }

        return view('welcome_page', $data);
    }

    public function indexPage()
    {
        $allSacco = $this->displayDashboard->getAllSaccos();
        $data = [
            'allSacco' => $allSacco,
        ];
        return view('index', $data);
    }

    public function explorePage()
    {
        $user_id = session()->get('user_id');
        $getAllSacco = $this->displayDashboard->getAllSaccos();
        $getSearch = $this->displayDashboard->getSearch($user_id);
        $data = [
            'allSacco' => $getAllSacco,
            'search' => $getSearch,
        ];
        return view('explore', $data);
    }

    public function exploreSearch()
    {
        $user_id = session()->get('user_id');
        $searchOne = trim($this->request->getGet('selectedSacco'));
        $searchTwo = trim($this->request->getGet('sharePrice'));


        $data = [
            'user_id' => $user_id,
            'sacco_name' => $searchOne,
            'total' => $searchTwo,
        ];

        $checkSearch = $this->displayDashboard->checkSearch($user_id, $searchOne, $searchTwo);
        if (!$checkSearch) {
            try {
                $this->displayDashboard->saveSearch($data);
            } catch (\CodeIgniter\Database\Exceptions\DataBaseException $e) {
                $data = [
                    'error' => $e,
                ];
                $this->displayDashboard->insertError($data);
            }
        }

        // Prepare query to get all records
        $shares = $this->sharesOnSale->select('shares_on_sale.*, users.fname, users.lname, sacco.name, sacco.logo')
            ->join('users', 'users.user_id = shares_on_sale.user_id', 'left')
            ->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left')
            ->where('shares_on_sale.is_verified', '1')
            ->orderBy('shares_on_sale.created_at', 'DESC');

        // Apply search filters
        if (!empty($searchOne)) {
            $shares = $shares->groupStart()
                ->orLike('sacco.name', '%' . $searchOne . '%')
                ->groupEnd();
        }

        if (!empty($searchTwo)) {
            $shares = $shares->groupStart()
                ->orLike('shares_on_sale.total', '%' . $searchTwo . '%')
                ->orLike('shares_on_sale.shares_on_sale', '%' . $searchTwo . '%')
                ->groupEnd();
        }

        if (!empty($sort)) {
            $shares = $shares->orLike('sacco.created_at', $sort);
        }

        // Retrieve all data without pagination
        $sacco = $shares->get()->getResult();

        return $this->response->setJSON($sacco);
    }


    public function getRecommendedShares()
    {
        $getRecommendedShares = $this->displayDashboard->getRecommendedShares();
        return $this->respond($getRecommendedShares);
    }

    public function search()
    {

        $pager = \Config\Services::pager();
        $searchOne = $this->request->getPost('searchOne');
        $searchTwo = $this->request->getPost('searchTwo');
        $sort = $this->request->getPost('sort');

        // Prepare query to get all records
        $shares = $this->sharesOnSale->select('shares_on_sale.*, users.fname, users.lname, sacco.name, sacco.logo, sacco.sacco_id')
            ->join('users', 'users.user_id = shares_on_sale.user_id', 'left')
            ->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left')
            ->where('shares_on_sale.is_verified', '1')
            ->orderBy('shares_on_sale.created_at', 'DESC');

        // Apply search filters
        if (!empty($searchOne)) {
            $shares = $shares->groupStart()
                ->orLike('sacco.name', '%' . $searchOne . '%')
                ->groupEnd();
        }

        if (!empty($searchTwo)) {
            $shares = $shares->groupStart()
                ->orLike('shares_on_sale.total', '%' . $searchTwo . '%')
                ->orLike('shares_on_sale.shares_on_sale', '%' . $searchTwo . '%')
                ->groupEnd();
        }

        if (!empty($sort)) {
            $shares = $shares->orLike('shares_on_sale.created_at', $sort);
        }

        // Get paginated results
        $perPage = 10; // Set the number of records per page
        $shares = $shares->paginate($perPage, 'default', $pager->getCurrentPage());

        // Get the pager links
        $pagerLinks = $pager->links('default', 'full-pagination');

        // Add the pager links to the JSON response
        $responseData = [
            'shares' => $shares,
            'pagerLinks' => $pagerLinks
        ];

        return $this->response->setJSON($responseData);
    }

    public function forgotPassword()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} is required',
                        'valid_email' => 'Please provide a valid email address',
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                $email = $this->request->getVar('email');
                $userData = $this->displayDashboard->validateEmail($email);
                if (!empty($userData)) {

                    if ($this->displayDashboard->updateResetTime($userData['uniid'])) {
                        $subject = "Password reset link";

                        $message = "<br/><br/> " . $userData['fname'] . ", this email contains your password reset link. click the link now to change your password, the link expires within 39min " . anchor(base_url('password-reset/' . $userData['uniid']), ' password reset link', '');

                        if (service('sendEmail')->send_email($userData['email'], $userData['fname'], $subject, $message)) {
                            $email_logs = [
                                'uuid' => Uuid::uuid4()->toString(),
                                'fname' => $userData['fname'] . ' ' . $userData['lname'],
                                'email' => $userData['email'],
                                'message_title' => $subject,
                                'role' => 'user',
                                'status' => '1',
                            ];

                            $this->loginActivityModel->insertEmailLogs($email_logs);
                            session()->setTempdata('success', 'An email with the password reset link has been sent to your email, change your password within 39 min', 3);
                            return redirect()->to(base_url('forgot-password'));
                        } else {
                            $email_logs = [
                                'uuid' => Uuid::uuid4()->toString(),
                                'fname' => $userData['fname'] . ' ' . $userData['lname'],
                                'email' => $userData['email'],
                                'message_title' => $subject,
                                'role' => 'saccoAdmin',
                                'status' => '0',
                            ];

                            $this->loginActivityModel->insertEmailLogs($email_logs);
                            return redirect()->to(base_url('forgot-password'))->with('fail', 'we can not send an activation email now');
                        }

                    } else {
                        session()->setTempdata('fail', 'We can not update your password right now', 3);
                        return redirect()->to(base_url('forgot-password'));
                    }
                } else {
                    session()->setTempdata('fail', 'Your details were not found', 3);
                    return redirect()->to(base_url('forgot-password'));
                }

            }
        }
        return view('forgot-password', $data);
    }

    public function passwordReset($uniid = null)
    {
        $data = [];

        if (!empty($uniid)) {

            $userData = $this->displayDashboard->verifyUniid($uniid);
            if (!empty($userData)) {

                if ($this->expiryTime($userData['updated_at'])) {

                    if ($this->request->getMethod() == 'post') {
                        $rules = [
                            'newPassword' => [
                                'rules' => 'required|min_length[5]|max_length[20]',
                                'errors' => [
                                    'required' => 'password field is required',
                                    'min_length' => 'minimum password must be five',
                                    'max_length' => 'maximum password length must be twenty',
                                ]
                            ],
                            'confPassword' => [
                                'rules' => 'required|min_length[5]|max_length[20]|matches[newPassword]',
                                'errors' => [
                                    'required' => 'password field is required',
                                    'min_length' => 'minimum password must be five',
                                    'max_length' => 'maximum password length must be twenty',
                                ]
                            ],
                        ];
                        if ($this->validate($rules)) {
                            $password = password_hash($this->request->getVar('newPassword'), PASSWORD_DEFAULT);
                            if ($this->displayDashboard->passwordUpdate($uniid, $password)) {
                                session()->setTempdata('success', 'Your password was reset successfully, please login', 3);
                                return redirect()->to(base_url(''));
                            } else {
                                session()->setTempdata('fail', 'Your are not able to reset your password', 3);
                                return redirect()->to(base_url('reset-password'));
                            }
                        } else {
                            $data['validation'] = $this->validator;
                        }

                    }
                } else {
                    $data['error'] = 'The password reset link has expired';
                }
            } else {
                $data['error'] = 'There is no user with these credentials';
            }

        } else {
            $data['error'] = 'Unauthorize access';
        }
        return view('reset-password-form', $data);
    }

    public function expiryTime($date)
    {
        $updated_time = strtotime($date);
        $currentTime = time();
        $difference_time = ($currentTime - $updated_time) / 60;
        if ($difference_time < 1800) {
            return true;
        } else {
            return false;
        }
    }

    public function share($id = null)
    {
        $uuid = session()->get('currentLoggedInUser');
        $user = $this->users->where('uniid', $uuid)->first();
        $shares = $this->sharesOnSale->select('shares_on_sale.*, users.fname, users.lname, sacco.name')
            ->join('users', 'users.user_id = shares_on_sale.user_id', 'left')
            ->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left')
            ->where('shares_on_sale.uuid', $id)
            ->where('shares_on_sale.is_verified', '1')
            ->first();

        $related_shares = $this->sharesOnSale->select('shares_on_sale.*, users.fname, users.lname, sacco.name')
            ->join('users', 'users.user_id = shares_on_sale.user_id', 'left')
            ->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left')
            ->where('shares_on_sale.sacco_id', $shares['sacco_id'])
            ->where('shares_on_sale.is_verified', '1')
            ->where('shares_on_sale.uuid !=', $id)
            ->orWhere('shares_on_sale.shares_on_sale', '>', $shares['shares_on_sale'])
            ->orWhere('shares_on_sale.total', '>', $shares['total'])
            ->findAll();

        $data = [
            'user' => $user,
            'share' => $shares,
            'related_shares' => $related_shares
        ];

        return view('share', $data);
    }

    public function getBid()
    {
        $bid_id = $this->request->getPost('bidId');
        $share_id = $this->request->getPost('shareId');

        $bid = $this->bidShares->select('bid_share.bid_id, bid_share.share_on_sale_id, bid_share.bid_amount, bid_share.action, users.uniid, users.phone')
            ->join('users', 'bid_share.buyer_id = users.uniid')
            ->where('bid_id', $bid_id)
            ->where('share_on_sale_id', $share_id)
            ->where('action', '1')
            ->first();
        if ($bid) {
            return $this->response->setJSON($bid);
        } else {
            $response = [
                'message' => 'there was an error',
            ];

            return $this->response->setJSON($response);
        }

    }

    public function confirmPayment()
    {
        $myPhone = $this->request->getPost('phoneNumber');
        $price = $this->request->getPost('bidAmount');
        $bid_id = $this->request->getPost('bidId');

        $response = service('paymentService')->payment($myPhone, $price, $bid_id);

        if($response['status'] == 200){
            return $this->response->setJSON($response, 200);
        }else if ($response['status'] == 500) {
            return $this->response->setJSON($response, 500);
        }

    }

    public function paymentCallback()
    {

        $response = file_get_contents('php://input');
        log_message("error", "Response: " . $response);

        $json = json_decode($response, true);

        $merchantRequestID = $json['Body']['stkCallback']['MerchantRequestID'];

        if ($json['Body']['stkCallback']['ResultCode'] == 0) {
            $checkoutRequestID = $json['Body']['stkCallback']['CheckoutRequestID'];
            $amount = 0;
            $mpesaReceiptNumber = '';
            $phone = '';
            $date = '';
            $callback_uuid = Uuid::uuid4()->toString();

            foreach ($json['Body']['stkCallback']['CallbackMetadata']['Item'] as $params) {
                switch ($params['Name']) {
                    case 'Amount':
                        $amount = $params['Value'];
                        break;
                    case 'MpesaReceiptNumber':
                        $mpesaReceiptNumber = $params['Value'];
                        break;
                    case 'PhoneNumber':
                        $phone = $params['Value'];
                        break;
                    case 'TransactionDate':
                        $date = $params['Value'];
                        break;
                }
            }
            try {
                $callbackData = [
                    'callback_uuid' => $callback_uuid,
                    'merchantRequestID' => $merchantRequestID,
                    'checkoutRequestID' => $checkoutRequestID,
                    'amount' => $amount,
                    'mpesaReceiptNumber' => $mpesaReceiptNumber,
                    'phoneNumber' => $phone,
                    'transactionDate' => $date,
                ];
                $this->displayDashboard->updatePaymentData($callbackData);

            } catch (\CodeIgniter\Database\Exceptions\DataBaseException $e) {
                $data = [
                    'error' => $e,
                ];
                $this->displayDashboard->insertError($data);
            }
        }
        return 'ok';
    }
    function checkPayment(){
        $merchantRequestID= $this->request->getPost('merchantRequestID');
        $responseData = $this->displayDashboard->checkPaymentModel($merchantRequestID);
       if(!empty($responseData['mpesaReceiptNumber'])){
           $transactionMessage = 'We acknowledge payment of Ksh. '.$responseData['amount'].' to sacco Hisa, at '.$responseData['transactionDate'].'. Thank you for using our services.';
           if(service('sendSMS')->text_msg($responseData['phoneNumber'], $transactionMessage)){
               $email_logs = [
                   'uuid' => Uuid::uuid4()->toString(),
                   'fname' => session()->get('fname').' ' .session()->get('lname'),
                   'phone' => session()->get('phone'),
                   'message_title' => 'Bid accepted',
                   'role' => 'user',
                   'status' => '1',
               ];
               $this->displayDashboard->insertSMSLogs($email_logs);
           }else{
               $email_logs = [
                   'uuid' => Uuid::uuid4()->toString(),
                   'fname' => session()->get('fname').' ' .session()->get('lname'),
                   'phone' => session()->get('phone'),
                   'message_title' => 'Bid accepted',
                   'role' => 'user',
                   'status' => '0',
               ];
               $this->displayDashboard->insertSMSLogs($email_logs);
           }
           $response = [
               'status' => 200,
               'mpesaReceiptNumber' => $responseData['mpesaReceiptNumber'],
               'message' => 'Payment successful, mpesaReceiptNumber'.$responseData['mpesaReceiptNumber'].' .Thank you',
           ];
              return $this->response->setJSON($response);
       }
    }

    public function saccoMembership()
    {

        $uuid = session()->get('currentLoggedInUser');
        $user = $this->users->where('uniid', $uuid)->first();
        $sacco = $this->sacco->findAll();

        $data = [
            'user' => $user,
            'sacco' => $sacco,
        ];
        return view('sacco-membership', $data);
    }

    public function bid($id = null)
    {

        $uuid = session()->get('currentLoggedInUser');
        $shares = $this->sharesOnSale->select('shares_on_sale.*, users.fname, users.lname, sacco.name')
            ->join('users', 'users.user_id = shares_on_sale.user_id', 'left')
            ->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left')
            ->where('shares_on_sale.uuid', $id)
            ->where('shares_on_sale.is_verified', '1')
            ->first();

        if ($this->request->getMethod() == 'post') {
            $bid = $this->request->getVar('bid');
            $buyerMembershipNumber = $this->request->getVar('memberNumber');

            $bidData = [
                'buyer_id' => $uuid,
                'uuid' => Uuid::uuid4()->toString(),
                'share_on_sale_id' => $id,
                'bid_amount' => $bid,
                'buyer_membership_number' => $buyerMembershipNumber,
                'seller_id' => $shares['user_id'],
                'sacco_id' => $shares['sacco_id'],
                'action' => '0',
            ];

            if ($this->bidShares->save($bidData)) {
                $response = [
                    'status' => '200',
                    'message' => 'Your bid was placed successfully, please wait for the seller to approve your bid',
                ];

                return $this->response->setJSON($response);
            } else {
                $response = [
                    'status' => '500',
                    'message' => 'Something went wrong',
                ];

                return $this->response->setJSON($response);
            }
        }
    }

    public function hasBid($id = null)
    {
        $uuid = session()->get('currentLoggedInUser');
        $user = $this->users->where('uniid', $uuid)->first();
        $shares = $this->sharesOnSale->select('shares_on_sale.*, users.fname, users.lname, sacco.name')
            ->join('users', 'users.user_id = shares_on_sale.user_id', 'left')
            ->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left')
            ->where('shares_on_sale.uuid', $id)
            ->where('shares_on_sale.is_verified', '1')
            ->first();


        if ($shares['user_id'] == $user['user_id']) {
            $response = [
                'status' => '500',
                'message' => 'You cannot bid for your own shares',
            ];

            return $this->response->setJSON($response);
        }
    }

    public function hasActiveBid($id = null)
    {

        $uuid = session()->get('currentLoggedInUser');
        $user = $this->users->where('uniid', $uuid)->first();

        $has_bid = $this->bidShares
                ->select('bid_share.*')
                ->where('buyer_id', $user['uniid'])
                ->where('share_on_sale_id', $id)
                ->whereIn('action', [0, 1])
                ->countAllResults() == 1;

        if ($has_bid) {
            $response = [
                'status' => '200',
                'message' => 'You already have an active bid for this share capital',
            ];

            return $this->response->setJSON($response);
        }

    }

    public function bids()
    {
        global $amount;
        global $id;
        $uuid = session()->get('currentLoggedInUser');
        $userData = $this->displayDashboard->getCurrentUserInformation($uuid);

//        the seller sees the bids that have been placed on his shares

        $bid_share = $this->bidShares->select('bid_share.bid_amount, bid_share.bid_id, bid_share.uuid as bid_uuid, bid_share.action, bid_share.created_at, shares_on_sale.total, shares_on_sale.uuid, shares_on_sale.share_on_sale_id, users.fname as buyer_fname, users.lname as buyer_lname, sacco.name')
            ->join('shares_on_sale', 'shares_on_sale.uuid = bid_share.share_on_sale_id', 'right')
            ->join('users', 'users.uniid = bid_share.buyer_id', 'left')
            ->join('sacco', 'sacco.sacco_id = bid_share.sacco_id', 'left')
            ->where('bid_share.seller_id', $userData->user_id)
            ->where('bid_share.action', '0')
            ->findAll();

//        the seller accepts the bid goes to the buyer

        $accepted_bids = $this->bidShares->select('bid_share.bid_amount, bid_share.bid_id, bid_share.action, bid_share.uuid as bid_uuid, bid_share.updated_at, shares_on_sale.total, shares_on_sale.uuid, users.fname as seller_fname, users.lname as seller_lname, sacco.name, sacco.sacco_id')
            ->join('shares_on_sale', 'shares_on_sale.uuid = bid_share.share_on_sale_id', 'right')
            ->join('users', 'users.user_id = bid_share.seller_id', 'right')
            ->join('sacco', 'sacco.sacco_id = bid_share.sacco_id', 'right')
            ->where('bid_share.buyer_id', $userData->uniid)
            ->where('bid_share.action', '1')
            ->findAll();


//        the seller rejects the bid, goes to the buyer
        $rejected_bids = $this->bidShares->select('bid_share.bid_amount, bid_share.bid_id, bid_share.uuid as bid_uuid, bid_share.action, bid_share.updated_at, shares_on_sale.uuid, shares_on_sale.total, shares_on_sale.share_on_sale_id, users.fname as seller_fname, users.lname as seller_lname, sacco.name')
            ->join('shares_on_sale', 'shares_on_sale.uuid = bid_share.share_on_sale_id', 'left')
            ->join('users', 'users.user_id = bid_share.seller_id', 'left')
            ->join('sacco', 'sacco.sacco_id = bid_share.sacco_id', 'left')
            ->where('bid_share.buyer_id', $userData->uniid)
            ->where('bid_share.action', '2')
            ->findAll();

        if ($accepted_bids > 0) {

            foreach ($accepted_bids as $accepted_bid) {
                $amount = $accepted_bid['bid_amount'];
                $id = $accepted_bid['sacco_id'];
            }
        }


        $pdf_view = $this->displayDashboard->getPdfView($id);


        $sellers_received_bids = $this->bidShares->select('bid_share.*')
            ->join('shares_on_sale', 'shares_on_sale.share_on_sale_id = bid_share.share_on_sale_id', 'left')
            ->where('bid_share.action', '0')
            ->where('bid_share.seller_id', $userData->user_id)
            ->countAllResults();


        $buyers_received_bids = $this->bidShares->select('bid_share.*')
            ->where('bid_share.action', '2')
            ->where('bid_share.buyer_id', $userData->uniid)
            ->countAllResults();

        $session_data = [
            'buyers_received_bids' => $buyers_received_bids,
            'sellers_received_bids' => $sellers_received_bids,
        ];
        session()->set($session_data);


        $data = [
            'bids' => $bid_share,
            'accepted_bids' => $accepted_bids,
            'rejected_bids' => $rejected_bids,
            'pdf_view' => $pdf_view,
        ];


        return view('bids', $data);
    }

    public function acceptBid($id = null)
    {
        $bids = $this->bidShares->where('uuid', $id)->first();
        $sacco = $this->sacco->select('name')->where('sacco_id', $bids['sacco_id'])->first();
        $bidAmount = $bids['bid_amount'];
        $buyer_phone = $this->users->select('phone, fname')->where('uniid', $bids['buyer_id'])->first();
        $base_url = base_url('my_bids');
        $message = 'Dear, '. $buyer_phone['fname'] .' your bid of Ksh ' . $bidAmount . ' for ' . $sacco['name'] . ' shares capital was accepted by the seller, you can now purchase the share capital. Go to ' . $base_url;
        $bidData = [
            'updated_at' => date('Y-m-d h:i:s'),
            'action' => '1',
        ];
        if ($this->bidShares->update($bids['bid_id'], $bidData)) {
            if(service('sendSMS')->text_msg($buyer_phone['phone'], $message)){
                $email_logs = [
                    'uuid' => Uuid::uuid4()->toString(),
                    'fname' => session()->get('fname').' ' .session()->get('lname'),
                    'phone' => session()->get('phone'),
                    'message_title' => 'Bid accepted',
                    'role' => 'user',
                    'status' => '1',
                ];
                $this->displayDashboard->insertSMSLogs($email_logs);
            }else{
                $email_logs = [
                    'uuid' => Uuid::uuid4()->toString(),
                    'fname' => session()->get('fname').' ' .session()->get('lname'),
                    'phone' => session()->get('phone'),
                    'message_title' => 'Bid accepted',
                    'role' => 'user',
                    'status' => '0',
                ];
                $this->displayDashboard->insertSMSLogs($email_logs);
            }
            session()->setFlashdata('success', 'Share capital bid has been approved successfully', 3);
            return redirect()->back()->to(base_url() . '/saved/your_active_shares');
        } else {

            session()->setFlashdata('fail', 'We could not complete your request at the moment, please try again latter');
            return redirect()->back()->to(base_url() . '/saved/your_active_shares');
        }
    }

    public function rejectBid($id = null)
    {
        $bids = $this->bidShares->find($id);
        $sacco = $this->sacco->select('name')->where('sacco_id', $bids['sacco_id'])->first();
        $bidAmount = $bids['bid_amount'];
        $buyer_phone = $this->users->select('phone, fname')->where('uniid', $bids['buyer_id'])->first();
        $message = 'Dear, '.$buyer_phone['fname'].' your bid of Ksh ' . $bidAmount . ' on ' . $sacco['name'] . ' share capital was rejected by the seller. Please try again with a higher bid amount.';
        $bidData = [
            'updated_at' => date('Y-m-d h:i:s'),
            'action' => '2',
        ];
        if ($this->bidShares->update($bids['bid_id'], $bidData)) {
            if(service('sendSMS')->text_msg($buyer_phone['phone'], $message)){
                $email_logs = [
                    'uuid' => Uuid::uuid4()->toString(),
                    'fname' => session()->get('fname').' ' .session()->get('lname'),
                    'phone' => session()->get('phone'),
                    'message_title' => 'Bid rejected',
                    'role' => 'user',
                    'status' => '1',
                ];
                $this->displayDashboard->insertSMSLogs($email_logs);
            }else{
                $email_logs = [
                    'uuid' => Uuid::uuid4()->toString(),
                    'fname' => session()->get('fname').' ' .session()->get('lname'),
                    'phone' => session()->get('phone'),
                    'message_title' => 'Bid rejected',
                    'role' => 'user',
                    'status' => '0',
                ];
                $this->displayDashboard->insertSMSLogs($email_logs);
            }
            session()->setFlashdata('success', 'You have rejected the bid successfully', 3);
            return redirect()->back()->to(base_url() . '/saved/your_active_shares');
        } else {
            session()->setFlashdata('fail', 'We could not complete your request at the moment, please try again latter');
            return redirect()->back()->to(base_url() . '/saved/your_active_shares');
        }

    }

    public function savedShares()
    {

        $userServices = service('userData');

        $data = [
            'userData' => $userServices->getUserData(),
        ];
        return view('saved', $data);
    }

    public function deleteSavedShareAjax()
    {
        $share_id = $this->request->getPost('saved_id');
        $user_id = session()->get('currentLoggedInUser');
        $delete = $this->displayDashboard->deleteSavedShare($share_id, $user_id);
        if ($delete) {
            $response = [
                'status' => 200,
                'message' => 'Saved share capital deleted successfully',
            ];
            return $this->response->setJSON($response);
        } else {
            $response = [
                'status' => 500,
                'message' => 'An error has occurred, again later',
            ];
            return $this->response->setJSON($response);
        }
    }

    public function profile()
    {
        $userServices = service('userData');
        $data = [
            'userData' => $userServices->getUserData(),
        ];
        return view('account', $data);

    }

    public function settings()
    {
        $userServices = service('userData');
        $data = [
            'userData' => $userServices->getUserData(),
        ];
        return view('settings', $data);
    }

    public function needHelp()
    {
        $userServices = service('userData');
        $data = [
            'userData' => $userServices->getUserData(),
        ];
        return view('help', $data);
    }

    public function activeShares()
    {
        $userServices = service('userData');
        $data = [
            'userData' => $userServices->getUserData(),
        ];

        return view('active_shares', $data);
    }

    public function yourShareStatus()
    {
        $userServices = service('userData');
        $user_id = $userServices->getUserData()->user_id;
        $getShares = $this->displayDashboard->getUserSharesStatus($user_id);
        if ($getShares) {
            $response = [
                'message' => 'success',
                'userShares' => $getShares,
            ];
            return $this->response->setJSON($response);
        }
    }

    public function shareHistory()
    {
        $user_id = session()->get('user_id');
        $userServices = service('userData');
        $user_share_history = $this->displayDashboard->getTransactions($user_id);
        $data = [
            'userData' => $userServices->getUserData(),
            'user_share_history' => $user_share_history,
        ];
        return view('share_history', $data);
    }

    public function membershipStatus()
    {
        $userServices = service('userData');

        $userShares = $this->displayDashboard->getUserShares();
        $is_a_member = $this->displayDashboard->is_Member();
        $membership_status = $this->displayDashboard->membershipStatus();
        $data = [
            'userData' => $userServices->getUserData(),
            'userShares' => $userShares,
            'is_a_member' => $is_a_member,
            'membership_status' => $membership_status,
        ];
        return view('membership_status', $data);
    }


    public function sell()
    {
        return view('sell');
    }

    public function sellNow()
    {
        $set_member_commission = '';
        $member_commission = $this->displayDashboard->findAllRecords();
        if (!empty($member_commission)) {
            $set_member_commission = $member_commission[0]['commission'];
        }
        $getAllSacco = $this->displayDashboard->getAllSaccos();

        $data = [
            'member_commission' => $set_member_commission,
            'saccos' => $getAllSacco,
        ];
        return view('sell_now', $data);
    }

    public function sellNowAjax()
    {

        if ($this->request->getMethod() == 'post') {
            $sacco_id = $this->request->getPost('sacco_id');
            $shares = $this->request->getPost('share');
            $membership_number = $this->request->getPost('member_number');
            $total = $this->request->getPost('total');

            $user_id = service('userData')->getUserData()->user_id;

            $shareData = [

                'uuid' => Uuid::uuid4()->toString(),
                'user_id' => $user_id,
                'sacco_id' => $sacco_id,
                'membership_number' => $membership_number,
                'shares_on_sale' => $shares,
                'total' => $total,

            ];


            $postShare = $this->displayDashboard->saveShareData($shareData);
            if ($postShare) {
                $response = [
                    'status' => 200,
                    'message' => 'Share capital successfully posted, you will be notified once approved by the sacco',
                ];
                return $this->response->setJSON($response);
            } else {
                $response = [
                    'status' => 500,
                    'message' => 'We could not complete your request at the moment, please try again latter',
                ];
                return $this->response->setJSON($response);
            }
        }
    }

    public function verifyMemberNumber()
    {
        if ($this->request->getMethod() == 'post') {
            $member_number = $this->request->getPost('verify');
            $user_id = session()->get('user_id');
            $share = $this->displayDashboard->verifyMemberNumber($member_number, $user_id);
            if ($share) {
                $response = [
                    'status' => 200,
                    'message' => 'Member number verified successfully',
                    'share' => $share,
                ];
                return $this->response->setJSON($response);
            } else {
                $response = [
                    'status' => 400,
                    'message' => 'Membership number do not exists',
                ];
                return $this->response->setJSON($response);
            }
        }
    }

    public function saveShare()
    {

        $ajax_share_id = $this->request->getPost('share_id');
        $user_id = session()->get('currentLoggedInUser');

        $shareData = [
            'user_id' => $user_id,
            'share_id' => $ajax_share_id,
        ];

        $checkIfSaved = $this->displayDashboard->checkIfSaved($ajax_share_id, $user_id);
        if ($checkIfSaved) {
            $deleted = $this->displayDashboard->deleteShare($ajax_share_id);
            if ($deleted) {
                $response = [
                    'status' => 200,
                    'message' => 'Share capital removed successfully',
                ];
                return $this->response->setJSON($response);
            }
        } else {
            $saved = $this->displayDashboard->saved($shareData);
            if ($saved) {
                $response = [
                    'status' => 200,
                    'message' => 'Share capital saved successfully',
                ];
                return $this->response->setJSON($response);
            }
        }
    }

    public function getAllSavedSharesAjax()
    {

        $getAllSavedShares = $this->displayDashboard->getAllSavedShares();
        if ($getAllSavedShares) {
            $response = [
                'status' => 200,
                'shares' => $getAllSavedShares,
            ];
            return $this->response->setJSON($response);
        } else {
            $response = [
                'status' => 500,
            ];
            return $this->response->setJSON($response);
        }
    }

    public function getSaccoCostPerShare()
    {
        if ($this->request->getMethod() == 'post') {

            try {
                $sacco_id = $this->request->getPost('sacco_id');
                $sacco = $this->displayDashboard->getSaccoCostPerShare($sacco_id);
                if ($sacco) {
                    $response = [
                        'status' => 200,
                        'sacco_cost_per_share' => $sacco,
                    ];
                    return $this->response->setJSON($response);
                } else {
                    $response = [
                        'status' => 400,
                    ];
                    return $this->response->setJSON($response);
                }
            } catch (\Exception $e) {
                // Handle the exception here
                $response = [
                    'status' => 500,
                    'error' => $e->getMessage(),
                ];
                return $this->response->setJSON($response);
            }
        }
    }

    public function requestMembership($share_id)
    {
        $userServices = service('userData');

        $data = [
            'userData' => $userServices->getUserData(),
            'share_id' => $share_id,
        ];
        return view('request-membership', $data);
    }

    public function saveMembershipAjax()
    {
        $userServices = service('userData');
        if ($this->request->getMethod() == 'post') {

            $identification_number = $this->request->getPost('idNumber');
            $sacco_id = $this->request->getPost('sacco_id');


            $membership = [
                'user_id' => $userServices->getUserData()->user_id,
                'id_number' => $identification_number,
                'sacco_id' => $sacco_id,
            ];

            //checking if the user has already requested to join the sacco
            $is_requested = $this->saccoMembershp->where('user_id', $userServices->getUserData()->user_id)
                    ->where('sacco_id', $sacco_id)
                    ->countAllResults() == 1;


            if ($is_requested) {
                $response = [
                    'status' => 200,
                    'message' => 'You have already submitted your request, please go back to share capital listing and place your bid.',
                ];
                return $this->response->setJSON($response);
            } else {

                if ($this->saccoMembershp->save($membership)) {
                    $response = [
                        'status' => 200,
                        'message' => 'Your request has been submitted successfully, you can make your share capital bid now.',
                    ];
                    return $this->response->setJSON($response);
                }


            }
        }
    }

    public function delete_accepted_bid_sharesAjax($bid_id)
    {

        $userServices = service('userData');
        $user_id = $userServices->getUserData()->uniid;
        $delete = $this->displayDashboard->delete_bid_shares($bid_id, $user_id);
        if ($delete) {
            $response = [
                'status' => 200,
                'message' => 'Bid has been deleted successfully',
            ];
            return $this->response->setJSON($response);
        } else {
            $response = [
                'status' => 500,
                'message' => 'Bid not deleted',
            ];
            return $this->response->setJSON($response);
        }
    }

    public function delete_rejected_bid_sharesAjax($bid_id)
    {

        $userServices = service('userData');
        $user_id = $userServices->getUserData()->uniid;
        $encode = json_encode($user_id);
        $encode2 = json_encode($bid_id);
        log_message('info', 'user id is ' . $encode);
        log_message('info', 'bid id is ' . $encode2);
        $delete = $this->displayDashboard->delete_bid_shares($bid_id, $user_id);
        if ($delete) {
            $response = [
                'status' => 200,
                'message' => 'Bid has been deleted successfully',
            ];
            return $this->response->setJSON($response);
        } else {
            $response = [
                'status' => 500,
                'message' => 'Bid not deleted',
            ];
            return $this->response->setJSON($response);
        }
    }


    public function getSaccoAllShares($id = null)
    {
        $ShareData = [];

        try {
            $getSaccoShares = $this->displayDashboard->getAllSaccoShares($id);
            $getSaccoName = $this->displayDashboard->getSaccoName($id);

            $ShareData = [
                'shares' => $getSaccoShares,
                'sacco_name' => $getSaccoName,
            ];
        } catch (\CodeIgniter\Database\Exceptions\DataBaseException $e) {

            $data = [
                'error' => $e,
            ];
            $this->displayDashboard->insertError($data);
        }

        return view('sacco-all-shares', $ShareData);
    }

    public function notifications()
    {
        return view('notifications');
    }

    public function getSaccoShares()
    {

        try {
            $allSaccoShares = $this->displayDashboard->getSaccoShares();
            if ($allSaccoShares) {
                $response = [
                    'status' => 200,
                    'shares' => $allSaccoShares,
                ];
                return $this->response->setJSON($response);
            }
        } catch (\CodeIgniter\Database\Exceptions\DataBaseException $e) {
            $response = [
                'status' => 500,
                'message' => $e->getMessage(),
            ];
            return $this->response->setJSON($response);
        }
    }

    public function getSacco()
    {
        $search = $this->request->getVar('search');
        $sacco = $this->displayDashboard->getSacco($search);
        if ($sacco) {
            $response = [
                'status' => 200,
                'sacco' => $sacco,
            ];
            return $this->response->setJSON($response);
        } else {
            $response = [
                'status' => 500,
                'message' => 'No sacco found',
            ];
            return $this->response->setJSON($response);
        }
    }

    public function messages()
    {
        return view('messages');
    }

    public function message($id = null)
    {
        return view('message');
    }

}
