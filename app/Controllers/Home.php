<?php

namespace App\Controllers;
use App\Libraries\Hash;
use App\Models\DisplayDashboardModel;
use App\Models\Users;
use App\Models\Shares;
use App\Models\Sacco;
use App\Models\SaccoMembership;
use App\Models\Notification;
use App\Models\SharesOnSale;
use App\Models\SaccoShares;
use App\Models\BidShares;
use CodeIgniter\I18n\Time;
use mysql_xdevapi\Exception;

class Home extends BaseController


{
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

    public function __construct(){

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
    }
    public function welcomePage() {
        $data = [
            'WelcomePageTitle' => 'Welcome',
        ];
        return view('welcome_page', $data);
    }
    public function indexPage() {
        return view('index');
    }

    public function search(){

        $pager = \Config\Services::pager();
        $searchOne = $this->request->getPost('searchOne');
        $searchTwo = $this->request->getPost('searchTwo');
        $sort = $this->request->getPost('sort');

        // Prepare query to get all records
        $shares = $this->sharesOnSale->select('shares_on_sale.*, users.fname, users.lname, sacco.name, sacco.sacco_id')
            ->join('users', 'users.user_id = shares_on_sale.user_id', 'left')
            ->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left')
            ->where('shares_on_sale.is_verified', '1')
            ->orderBy('shares_on_sale.created_at', 'ASC');

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

    public function forgotPassword(){
        $data = [];
        if($this->request->getMethod() == 'post'){
            $rules = [
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} is required',
                        'valid_email' => 'Please provide a valid email address',
                    ]
                ],
            ];
            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{

                $email = $this->request->getVar('email');
                $userData = $this->displayDashboard->validateEmail($email);
                if(!empty($userData)){

                    if($this->displayDashboard->updateResetTime($userData['uniid'])){
                        $name = $userData['fname'];
                        $emailSubject = "Password reset link";
                        $setFrom = 'billclintonogot88@gmail.com';
                        $messageTitle = "Sacco Product Application";
                        $message = "Your your password reset link has been sent successfully, click the link now to change your password, the link expires within 39min".anchor(base_url('password-reset/'.$userData['uniid']),' reset password link','');

                        if($this->sendEmail($name, $email, $setFrom, $messageTitle, $emailSubject, $message)){
                            session()->setTempdata('success', 'An email with the password reset link has been sent to your email, change your password within 39 min', 3);
                            return redirect()->to(base_url('forgot-password'));
                        }else{
                            return redirect()->to(base_url('forgot-password'))->with('fail', 'we can not send an activation email now');
                        }

                    }else{
                        session()->setTempdata('fail', 'We can not update your password right now', 3);
                        return redirect()->to(base_url('forgot-password'));
                    }
                }else{
                    session()->setTempdata('fail', 'Your details were not found', 3);
                    return redirect()->to(base_url('forgot-password'));
                }

            }
        }
        return view('forgot-password', $data);
}

    public function sendEmail($fname, $email, $setFrom, $messageTitle, $emailSubject, $message)
    {
        $this->email->setFrom($setFrom, $messageTitle);
        $this->email->setTo("$email");

        $this->email->setSubject("$emailSubject");

        $email_template = view('email_template_account_creation', [
            'name' => $fname,
            'message' => $message
        ]);

        // Set email message
        $this->email->setMessage($email_template);
        if($this->email->send()){
            return true;
        }else{
            return false;
        }
    }

    public function passwordReset($uniid=null){
        $data = [];

        if(!empty($uniid)){

            $userData = $this->displayDashboard->verifyUniid($uniid);
            if(!empty($userData)){

                if($this->expiryTime($userData['updated_at'])){

                    if($this->request->getMethod() == 'post'){
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
                        if($this->validate($rules)){
                            $password = password_hash($this->request->getVar('newPassword'), PASSWORD_DEFAULT);
                            if($this->displayDashboard->passwordUpdate($uniid, $password)){
                                session()->setTempdata('success', 'Your password was reset successfully, please login', 3);
                                return redirect()->to(base_url(''));
                            }else{
                                session()->setTempdata('fail', 'Your are not able to reset your password', 3);
                                return redirect()->to(base_url('reset-password'));
                            }
                        }else{
                            $data['validation'] = $this->validator;
                        }

                    }
                }else{
                    $data['error'] = 'The password reset link has expired';
                }
            }else{
                $data['error'] = 'There is no user with these credentials';
            }

        }else{
            $data['error'] = 'Unauthorize access';
        }
        return view('reset-password-form', $data);
}

    public function expiryTime($date){
        $updated_time = strtotime($date);
        $currentTime = time();
        $difference_time = ($currentTime - $updated_time)/60;
        if($difference_time < 1800){
            return true;
        }else{
            return false;
        }
}
    public function share($id = null){
        $data = [];
        $uuid = session()->get('currentLoggedInUser');
        $user = $this->users->where('uniid', $uuid)->first();
        $shares = $this->sharesOnSale->select('shares_on_sale.*, users.fname, users.lname, sacco.name')
            ->join('users', 'users.user_id = shares_on_sale.user_id', 'left')
            ->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left')
            ->where('shares_on_sale.uuid', $id)
            ->where('shares_on_sale.is_verified', '1')
            ->first();


        //retrieving the users who are already registered to the sacco they want to buy shares from
        $is_approved = $this->saccoMembershp->where('user_id', $user['user_id'])
                ->where('sacco_id', $shares['sacco_id'])
                ->where('is_approved', '1')
                ->countAllResults() == 1;


        if($this->request->getMethod() == 'post'){
            $rules = [
                'identification' => [
                    'rules' => 'required|numeric|min_length[8]|max_length[8]',
                    'errors' => [
                        'required' => 'Your identification number is required',
                        'numeric' => 'Your identification number must be numeric',
                        'min_length' => 'Your identification number must be 8 digits',
                        'max_length' => 'Your identification number must be 8 digits',
                    ]
                ]
            ];
            if(!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            }else{
                global $sacco_id, $user_id;
                $user_id = $user['user_id'];
                $sacco_id = $shares['sacco_id'];
                $identification = $this->request->getVar('identification');
                $membershipData = [
                    'user_id' => $user_id,
                    'sacco_id' => $sacco_id,
                    'id_number' => $identification,
                    'is_approved' => '0',
                ];

                $is_registered = $this->saccoMembershp->where('user_id', $user['user_id'])
                        ->where('sacco_id', $shares['sacco_id'])
                        ->countAllResults() == 1;
                if($is_registered){
                    session()->setTempdata('fail', 'You have already requested to join this sacco, please wait for admin approval.');
                    return redirect()->back();
                }else{
                    if($this->saccoMembershp->save($membershipData)){
                        $message = 'A new member has requested to join your sacco, please approve the request';
                        $notifications = [
                            'user_id' => $user['user_id'],
                            'sacco_id' => $sacco_id,
                            'message' => $message,
                            'read_status' => '0',
                        ];
                        $this->notification->save($notifications);
                        session()->setTempdata('success', 'Your request has been sent to the sacco admin, you will be notified once your request is approved', 3);
                        return redirect()->back();
                    }else{
                        session()->setTempdata('fail', 'Your request was not sent, please try again', 3);
                        return redirect()->back();
                    }

                }
            }
        }
        $data = [
            'user' => $user,
            'share' => $shares,
            'is_approved' => $is_approved,
        ];

        return view('share', $data);
    }

    function lipaNaMpesaPassword()
    {
        //timestamp
        $timestamp = date('YmdHms');
        //passkey
        $passKey ="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";

        $businessShortCOde =174379;
        //generate password
        $mpesaPassword = base64_encode($businessShortCOde.$passKey.$timestamp);

        return $mpesaPassword;
    }


    function newAccessToken()
    {
        $consumer_key="3AYA63kiam57dzjJSGnGVnmS3z6fSEAR";
        $consumer_secret="OIvi32V0JF3GuHIP";
        $credentials = base64_encode($consumer_key.":".$consumer_secret);
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials,"Content-Type:application/json"));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);
        curl_close($curl);

        if($access_token){
            return $access_token->access_token;
        }else{
            return false;
        }
    }


    public function payment(){
        global $errors;
        global $trim_phone;
        $price = $this->request->getGet('total');
        $share_id = $this->request->getGet('share_id');
        $userId = session()->get('currentLoggedInUser');
        $getUser = $this->users->where('uniid', $userId)->first();
        $phone = $getUser['phone'];
        $processedPhone = $this->processPhoneNumber($phone);

        $phone_code = $this->request->getPost('phone-code');
        $myPhone = $this->request->getPost('phone');
        $trim_phone = ltrim($phone_code, '+');

        $phone_number = $trim_phone.$myPhone;

        $mpesa_check_box = $this->request->getPost('mpesa-check-box');

        if($mpesa_check_box == 'on'){

            $url = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
            $curl_post_data = [
                'BusinessShortCode' => getenv('MPESA_SHORTCODE'),
                'Password' => "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjMwMzAyMTMxOTA3",
                'Timestamp' => "20230302131907",
                'TransactionType' => "CustomerPayBillOnline",
                'Amount' => 1, // $price
                'PartyA' => $phone_number,
                'PartyB' => getenv('MPESA_PARTYB'),
                'PhoneNumber' => $phone_number,
                'CallBackURL' => "https://5e41-197-232-79-73.in.ngrok.io/payment_callback",
                'AccountReference' => "saccoPayment",
                'TransactionDesc' => "buy shares",
            ];

            $data_string = json_encode($curl_post_data);


            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->newAccessToken()));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            $curl_response = curl_exec($curl);
            if($curl_response === false)
            {
                $info = curl_getinfo($curl);
                curl_close($curl);
                die('error occurred during curl exec. Additional info: ' . var_export($info));
            }else{


                $response = json_decode($curl_response, true);
                curl_close($curl);
                $data = [
                    'share_id' => $share_id,
                    'user_id' => $userId,
                    'merchantRequestID' => $response['MerchantRequestID'],
                    'checkoutRequestID' => $response['CheckoutRequestID'],
                ];
                $this->displayDashboard->savePaymentsData($data);
            }

        }else{
            $errors = 'Please ensure you have checked the mpesa payment option here before you can continue continue';
        }

        $data = [
            'total' => $price,
            'phone' => $processedPhone,
            'errors' => $errors,
        ];
        return view('payment', $data);
    }

    public function processPhoneNumber($phone){
        return substr($phone, 1);

    }

    public function paymentCallback(){

        $response = file_get_contents('php://input');
        log_message("error", "Response: " . $response);

        $json = json_decode($response, true);

        $merchantRequestID = $json['Body']['stkCallback']['MerchantRequestID'];

        if($json['Body']['stkCallback']['ResultCode'] == 0) {
            $checkoutRequestID = $json['Body']['stkCallback']['CheckoutRequestID'];
            $amount = 0;
            $mpesaReceiptNumber = '';
            $phone = '';
            $date ='';

            foreach($json['Body']['stkCallback']['CallbackMetadata']['Item'] as $params){
                switch ($params['Name']){
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
                $this->displayDashboard->updatePaymentData($amount, $mpesaReceiptNumber, $phone, $date, $merchantRequestID, $checkoutRequestID);

            }catch (\CodeIgniter\Database\Exceptions\DataBaseException $e){
                $data = [
                    'error' => $e,
                ];
                $this->displayDashboard->insertError($data);
            }
        }
        return 'ok';
    }

    public function saccoMembership(){

        $uuid = session()->get('currentLoggedInUser');
        $user = $this->users->where('uniid', $uuid)->first();
        $sacco = $this->sacco->findAll();

        $data = [];
        if($this->request->getMethod() == 'post'){

            $rules = [
                'identification' => [
                    'rules' => 'required|numeric|min_length[8]|max_length[8]',
                    'errors' => [
                        'required' => 'Your identification number is required',
                        'numeric' => 'Your identification number must be numeric',
                        'min_length' => 'Your identification number must be 8 digits',
                        'max_length' => 'Your identification number must be 8 digits',
                    ]
                ],
                'selectName' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please select a sacco',
                    ]
                ],
            ];
            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $identification = $this->request->getVar('identification');
                $sacco_id = $this->request->getVar('selectName');

                session()->set('request_joining_sacco_id', $sacco_id);

                $membership = [
                    'user_id' => $user['user_id'],
                    'id_number' => $identification,
                    'sacco_id' => $sacco_id,
                ];

                //checking if the user has already requested to join the sacco
                $is_requested = $this->saccoMembershp->where('user_id', $user['user_id'])
                    ->where('sacco_id', $sacco_id)
                    ->countAllResults() == 1;
                if($is_requested){
                    return redirect()->back()->with('fail', 'You have already requested to join this sacco, please wait for admin approval.');
                }else{
                    if($this->saccoMembershp->save($membership)){
                        $message = 'A new member has requested to join your sacco, please approve the request';
                        $notifications = [
                            'user_id' => $user['user_id'],
                            'sacco_id' => $sacco_id,
                            'message' => $message,
                            'read_status' => '0',
                        ];
                        $this->notification->save($notifications);
                        return redirect()->back()->with('success', 'Your request has been sent to the sacco admin, you will be notified once your request is approved');
                    }else{
                        return redirect()->back()->with('fail', 'Your request was not sent, please try again');
                    }

                }
            }
        }

        $data = [
            'user' => $user,
            'sacco' => $sacco,
        ];
        return view('sacco-membership', $data);
    }

    public function dashboard() {

        $sacco_id = '';
        $membership_number = '';
        $userServices = service('userData');
        $membershipService = service('membershipData');
        $userShares = $this->displayDashboard->getUserShares();
        $is_a_member = $this->displayDashboard->is_Member();
        $is_approved = $this->displayDashboard->is_Verified();
        $member_commission = $this->displayDashboard->findAllRecords();

        if($userShares) {

            foreach ($userShares as $share){
                $sacco_id = $share['sacco_id'];
                $membership_number = $share['membership_number'];
            }

        }
        if($this->request->getMethod() == 'post'){
            $shares = $this->request->getVar('shares', FILTER_SANITIZE_STRING);
            $price = $this->request->getVar('price', FILTER_SANITIZE_STRING);
            $total = $this->request->getVar('total', FILTER_SANITIZE_STRING);

            $shareData = [

                'uuid'   => md5(str_shuffle('abcdefghijklmnopqrstuvwxyz1234567890'.time())),
                'user_id'     => $userServices->getUserData()->user_id,
                'sacco_id' => $sacco_id,
                'membership_number' => $membership_number,
                'cost_per_share'  => $price,
                'shares_on_sale' => $shares,
                'total'  => $total,

            ];
            $postShare = $this->displayDashboard->saveShareData($shareData);
            if(!empty($postShare))
            {
                session()->setTempdata('fail', 'Something went wrong', 3);
                return redirect()->to(base_url('dashboard'));
            }else{
                session()->setTempdata('success', 'You have successfully posted shares for sale', 3);
                return redirect()->to(base_url('dashboard'));
            }

        }

        $data = [
            'dashboardTitle' => 'Dashboard',
            'userData' => $userServices->getUserData(),
            'userShares' => $userShares,
            'is_approved' => $is_approved,
            'is_a_member' => $is_a_member,
            'member_commission' => $member_commission[0]['commission'],
            'is_requested' => $membershipService->getUserRegistration(),
        ];

        return view('dashboard', $data);
    }

    public function bid($id = null){
        $uuid = session()->get('currentLoggedInUser');
        $user = $this->users->where('uniid', $uuid)->first();
        $shares = $this->sharesOnSale->select('shares_on_sale.*, users.fname, users.lname, sacco.name')
            ->join('users', 'users.user_id = shares_on_sale.user_id', 'left')
            ->join('sacco', 'sacco.sacco_id = shares_on_sale.sacco_id', 'left')
            ->where('shares_on_sale.uuid', $id)
            ->where('shares_on_sale.is_verified', '1')
            ->first();

        if($shares['user_id'] == $user['user_id']){
            session()->setTempdata('fail', 'You are the owner of this share, you can`t place a bid.', 3);
            return redirect()->back()->to(base_url().'/share/'.$id);
        }

        if($this->request->getMethod() == 'post'){
             $bid =  $this->request->getVar('bid');

                $bidData = [
                    'user_id' => $user['user_id'],
                    'share_on_sale_id' => $shares['share_on_sale_id'],
                    'bid_amount' => $bid,
                    'seller_id' => $shares['user_id'],
                    'sacco_id' => $shares['sacco_id'],
                    'action' => '0',
                ];

                $has_bid = $this->bidShares->where('user_id', $user['user_id'])
                    ->where('share_on_sale_id', $shares['share_on_sale_id'])
                    ->countAllResults() == 1;
                if(!$has_bid){
                    if($this->bidShares->save($bidData)) {
                        $sessionData = [
                            'user_bid_id' => $user['user_id'],
                            'share_on_sale_bid_id' => $shares['share_on_sale_id'],
                            'bid_amount' => $bid,
                            'seller_bid_id' => $shares['user_id'],
                        ];
                        session()->set($sessionData);
                        session()->setTempdata('success', 'Your bid has been placed', 3);
                        return redirect()->back()->to(base_url().'/share/'.$id);
                    }else{
                        session()->setTempdata('fail', 'Your bid was not placed, please try again', 3);
                        return redirect()->back()->to(base_url().'/share/'.$id);
                    }
                }else{
                    session()->setTempdata('fail', 'Your already have an active bid, go to my_bids and purchase', 3);
                    return redirect()->back()->to(base_url().'/share/'.$id);
                }
        }
    }

    public function bids(){
        global $amount;
        $uuid = session()->get('currentLoggedInUser');
        $userData = $this->displayDashboard->getCurrentUserInformation($uuid);
        $bid_share = $this->bidShares->select('bid_share.*, shares_on_sale.share_on_sale_id, shares_on_sale.total, users.fname, users.lname, sacco.name')
            ->join('shares_on_sale', 'shares_on_sale.share_on_sale_id = bid_share.share_on_sale_id', 'left')
            ->join('users', 'users.user_id = bid_share.user_id', 'left')
            ->join('sacco', 'sacco.sacco_id = bid_share.sacco_id', 'left')
            ->where('bid_share.seller_id', $userData->user_id)
            ->where('bid_share.action', '0')
            ->findAll();

        $accepted_bids = $this->bidShares->select('bid_share.*, shares_on_sale.share_on_sale_id, shares_on_sale.uuid, shares_on_sale.total, users.fname, users.lname, sacco.name')
            ->join('shares_on_sale', 'shares_on_sale.share_on_sale_id = bid_share.share_on_sale_id', 'left')
            ->join('users', 'users.user_id = bid_share.seller_id', 'left')
            ->join('sacco', 'sacco.sacco_id = bid_share.sacco_id', 'left')
            ->where('bid_share.user_id', $userData->user_id)
            ->where('bid_share.action', '1')
            ->findAll();

        $rejected_bids = $this->bidShares->select('bid_share.*, shares_on_sale.share_on_sale_id, shares_on_sale.uuid, shares_on_sale.total, users.fname, users.lname, sacco.name')
            ->join('shares_on_sale', 'shares_on_sale.share_on_sale_id = bid_share.share_on_sale_id', 'left')
            ->join('users', 'users.user_id = bid_share.seller_id', 'left')
            ->join('sacco', 'sacco.sacco_id = bid_share.sacco_id', 'left')
            ->where('bid_share.user_id', $userData->user_id)
            ->where('bid_share.action', '2')
            ->findAll();

        foreach ($accepted_bids as $accepted_bid){
            $amount = $accepted_bid['bid_amount'];
            $uuid = $accepted_bid['uuid'];
        }

        $payment_link = base_url('payment/initiate_payment/') . '?share_id=' . urlencode($uuid) . '&total=' . urlencode($amount);
        global $id;
        if(!empty($accepted_bid)){
            $id = $accepted_bid['sacco_id'];
        }else{
            $id = '';
        }
        $pdf_view = $this->displayDashboard->getPdfView($id);

        header('Content-type: application/pdf');
        header('Content-Disposition: inline');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');


        $data = [
            'bids' => $bid_share,
            'accepted_bids' => $accepted_bids,
            'rejected_bids' => $rejected_bids,
            'payment_link' => $payment_link,
            'pdf_view' => $pdf_view,
        ];
        return view('bids', $data);
    }

    public function acceptBid($id = null){
        $bids = $this->bidShares->find($id);
        $bidData = [
            'action' => '1',
        ];
        if($this->bidShares->update($bids['bid_id'], $bidData)) {
            session()->setTempdata('success', 'Bid approved', 3);
            return redirect()->back()->to(base_url() . '/dashboard');
        }
    }

    public function rejectBid($id = null){
        $bids = $this->bidShares->find($id);
        $bidData = [
            'action' => '2',
        ];
        if($this->bidShares->update($bids['bid_id'], $bidData)) {
            session()->setTempdata('success', 'Bid rejected', 3);
            return redirect()->back()->to(base_url() . '/dashboard');
        }

    }

    public function savedShares(){

        $userServices = service('userData');
        $userShares = $this->displayDashboard->getUserShares();
        $is_a_member = $this->displayDashboard->is_Member();

        $data = [
            'userData' => $userServices->getUserData(),
            'userShares' => $userShares,
            'is_a_member' => $is_a_member,

        ];
        return view('saved', $data);
    }

    public function profile(){
        $userServices = service('userData');
        $userShares = $this->displayDashboard->getUserShares();
        $is_a_member = $this->displayDashboard->is_Member();
        $data = [
            'userData' => $userServices->getUserData(),
            'userShares' => $userShares,
            'is_a_member' => $is_a_member,
        ];
        return view('settings', $data);
    }

    public function needHelp(){
        $userServices = service('userData');
        $userShares = $this->displayDashboard->getUserShares();
        $is_a_member = $this->displayDashboard->is_Member();
        $data = [
            'userData' => $userServices->getUserData(),
            'userShares' => $userShares,
            'is_a_member' => $is_a_member,
        ];
        return view('help', $data);
    }
    public function activeShares(){
        $userServices = service('userData');
        $is_a_member = $this->displayDashboard->is_Member();
        $data = [
            'userData' => $userServices->getUserData(),
            'is_a_member' => $is_a_member,
        ];
      return view('active_shares', $data);
    }

    public function yourShareStatus(){
        $userServices = service('userData');
        $user_id = $userServices->getUserData()->user_id;
        $getShares = $this->displayDashboard->getUserSharesStatus($user_id);
        if($getShares){
            $response = [
                'message' => 'success',
                'userShares' => $getShares,
            ];
            return $this->response->setJSON($response);
        }
    }

    public function shareHistory(){
        $user_id = session()->get('user_id');
        $userServices = service('userData');
        $userShares = $this->displayDashboard->getUserShares();
        $is_a_member = $this->displayDashboard->is_Member();
        $user_share_history = $this->displayDashboard->getTransactions($user_id);
        $data = [
            'userData' => $userServices->getUserData(),
            'userShares' => $userShares,
            'is_a_member' => $is_a_member,
            'user_share_history' => $user_share_history,
        ];
        return view('share_history', $data);
    }

    public function membershipStatus(){
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


    public function sell(){
        return view('sell');
    }

    public function sellNow(){
        $member_commission = $this->displayDashboard->findAllRecords();
        $userShares = $this->displayDashboard->getUserShares();
        $getAllSacco = $this->displayDashboard->getAllSaccos();

        $data = [
            'member_commission' => $member_commission[0]['commission'],
            'userShares' => $userShares,
            'saccos' => $getAllSacco,
        ];
        return view('sell_now', $data);
    }

    public function sellNowAjax(){

        $userServices = service('userData');

        if($this->request->getMethod() == 'post'){
            $sacco_id = $this->request->getPost('sacco_id');
            $shares = $this->request->getPost('share');
            $price = $this->request->getPost('price');
            $membership_number = $this->request->getPost('member_number');
            $total = $this->request->getPost('total');

            $shareData = [

                'uuid'   => md5(str_shuffle('abcdefghijklmnopqrstuvwxyz1234567890'.time())),
                'user_id'     => $userServices->getUserData()->user_id,
                'sacco_id' => $sacco_id,
                'membership_number' => $membership_number,
                'cost_per_share'  => $price,
                'shares_on_sale' => $shares,
                'total'  => $total,

            ];
            $postShare = $this->displayDashboard->saveShareData($shareData);
            return $this->response->setJSON($postShare);
    }
    }

    public function verifyMemberNumber(){
        if($this->request->getMethod() == 'post'){
            $member_number = $this->request->getPost('verify');
            $user_id = session()->get('user_id');
            $share = $this->displayDashboard->verifyMemberNumber($member_number, $user_id);
            if($share){
                $response = [
                    'status' => 200,
                    'message' => 'Member number verified successfully',
                    'share'=> $share,
                ];
                return $this->response->setJSON($response);
            }else{
                $response = [
                    'status' => 400,
                    'message' => 'Membership number do not exists',
                ];
                return $this->response->setJSON($response);
            }
        }
    }

    public function saveShare($share_id){

        $ajax_share_id = $this->request->getVar('ajax-share-id');
        $user_id = session()->get('user_id');
        if($share_id == $ajax_share_id){

            $shareData = [
                'user_id' => $user_id,
                'share_id' => $share_id,
            ];
            if($this->displayDashboard->saved($shareData)){
                $response = [
                    'status' => 200,
                    'message' => 'Share saved successfully',
                ];
                return $this->response->setJSON($response);
            }else{
                $response = [
                    'status' => 400,
                    'message' => 'Share not saved',
                ];
                return $this->response->setJSON($response);
            }
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

    public function requestMembership(){

        return view ('request-membership');
    }

    public function messages(){
        return view('messages');
    }
    public function message($id = null){
        return view('message');
    }

}
