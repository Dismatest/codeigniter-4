<?php

namespace Modules\Admin\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use Modules\Admin\Models\SaccoModels;
use App\Models\Notification;
use App\Models\Users;
use App\Models\SaccoMembership;
use App\Models\SaccoShares;

class Admin extends BaseController
{
    public $adminModel;
    public $notificationModel;
    public $userModel;
    public $saccoMembershipModel;
    public $saccoSharesModel;

    protected $email;

    public function __construct()
    {
        helper('text');
        $this->adminModel = new SaccoModels();
        $this->notificationModel = new Notification();
        $this->userModel = new Users();
        $this->saccoMembershipModel = new SaccoMembership();
        $this->saccoSharesModel = new SaccoShares();
        $this->email = \Config\Services::email();
    }

    public function dashboard()
    {
        $data['dashboardTitle'] = 'Admin Dashboard';
        $uuid = session()->get('currentLoggedInSacco');
        $data['saccoData'] = $this->adminModel->getCurrentSaccoInformation($uuid);
        $data['totalMembers'] = $this->adminModel->getTotalUsers($data['saccoData']['sacco_id']);
        $data['totalActiveShares'] = $this->adminModel->getTotalActiveShares($data['saccoData']['sacco_id']);
        return view('Modules\Admin\Views\dashboard', $data);
    }

    public function notifications()
    {
        return view('Modules\Admin\Views\notifications');
    }

    // all the sacco admin shares methods
    public function manageShares()

    {
        $data = [];
        $shares = $this->adminModel->manageShares();
        foreach ($shares as $key => $value) {
            $shares[$key]['created_at'] = date('d M Y', strtotime($value['created_at']));
            $data = [
                'time' => $shares[$key]['created_at'],
                'manageShearsTitle' => 'Manage Shares',
                'shares' => $shares,
            ];
        }
        return view('Modules\Admin\Views\manage-shears', $data);
    }

    public function verifyShares($id = null)
    {
        $shares = $this->adminModel->verifyShares($id);
        if ($shares) {
            return redirect()->to('admin/manage-shares')->with('success', 'Shares verified successfully');
        } else {
            return redirect()->to('admin/manage-shares')->with('fail', 'Shares verification failed');
        }
    }


    public function deleteShares($id = null)
    {
        try {

            $this->adminModel->deleteShares($id);
            return redirect()->to('admin/manage-shares')->with('success', 'Shares deleted successfully');
        } catch (\CodeIgniter\Database\Exceptions\DataBaseException $e) {
            return redirect()->to('admin/manage-shares')->with('fail', 'Shares deletion failed');
        }

    }

    // all the sacco admin users methods
    public function manageNewUsers()
    {
        $data = [];
        $saccoID = session()->get('sacco_id');
        $users = $this->adminModel->manageUsers($saccoID);

        foreach ($users as $key => $value) {
            $users[$key]['created_at'] = date('d M Y', strtotime($value['created_at']));
            $data = [
                'date_created' => $users[$key]['created_at'],
                'manageUsersTitle' => 'Manage Users',
                'users' => $users,
            ];
        }
        return view('Modules\Admin\Views\manage-users', $data);
    }

    public function listMembers()
    {
        $allMembers = $this->adminModel->allMembers();
        $data = [
            'allMembers' => $allMembers,
        ];
        return view('Modules\Admin\Views\list_members', $data);
    }

    public function updateUserShares($id)
    {
        if ($this->request->getMethod() == 'post') {
            $data = [
                'shares_amount' => $this->request->getPost('sharesAmount'),
            ];
            $save = $this->adminModel->updateUserShares($id, $data);
            if ($save) {
                return redirect()->to('admin/manage-users')->with('success', 'Shares updated successfully');
            } else {
                return redirect()->to('admin/manage-users')->with('fail', 'Shares update failed');
            }
        }
        $this->adminModel->updateUserShares($id);
    }

    public function createShare()
    {
        $saccoID = session()->get('currentLoggedInSacco');
        $sacco = $this->adminModel->getCurrentSaccoInformation($saccoID);

        $getCommission = $this->adminModel->getComission();

        $data = [
            'sacco' => $sacco,
            'getCommission' => $getCommission,
        ];

        return view('Modules\Admin\Views\create-share', $data);
    }

    public function deleteUserShares($id)
    {
        $shares = $this->adminModel->deleteUserShares($id);
        if ($shares) {
            return redirect()->to('admin/manage-users')->with('success', 'Shares deleted successfully');
        } else {
            return redirect()->to('admin/manage-users')->with('fail', 'Shares deletion failed');
        }
    }

    public function addUserShares()
    {
        $data = [];
        $saccoID = session()->get('sacco_id');
        $users = $this->userModel->select('users.user_id, users.fname, users.lname, sacco_membership.is_approved, sacco_membership.has_shares, sacco.sacco_id')
            ->join('sacco_membership', 'sacco_membership.user_id = users.user_id')
            ->join('sacco', 'sacco.sacco_id = sacco_membership.sacco_id')
            ->where('sacco_membership.is_approved', '1')
            ->where('sacco_membership.has_shares', '0')
            ->where('sacco.sacco_id', $saccoID)
            ->orderby('users.user_id', 'ASC')
            ->findAll();

        $sacco = $this->adminModel->getCurrentSaccoInformation(session()->get('currentLoggedInSacco'));

        $rules = [
            'selectCustomerName' => [
                'rules' => 'required|is_unique[sacco_shares.user_id]',
                'errors' => [
                    'required' => 'Please select a user',
                ]
            ],
            'membershipNumber' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please enter the membership number',
                ]
            ],
            'sharesAmount' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Please enter the membership number',
                    'numeric' => 'Please enter a valid amount',
                ]
            ],
            'cost' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Please enter the membership number',
                    'decimal' => 'Please enter a valid amount',
                ]
            ],
        ];
        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
        } else {
            $data = [
                'user_id' => $this->request->getPost('selectCustomerName'),
                'sacco_id' => $sacco['sacco_id'],
                'membership_number' => $this->request->getPost('membershipNumber'),
                'shares_amount' => $this->request->getPost('sharesAmount'),
                'cost_per_share' => $this->request->getPost('cost'),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $save = $this->adminModel->addUserShares($data);
            if ($save) {
                //I want to update a column called has_shares in the sacco_membership table
                $this->saccoMembershipModel->update($this->request->getPost('selectCustomerName'), ['has_shares' => 1]);
                return redirect()->to('admin/add-user-shares')->with('success', 'Shares added successfully');
            } else {
                return redirect()->to('admin/add-user-shares')->with('fail', 'Shares addition failed');
            }
        }
        $data = [
            'users' => $users,
            'sacco' => $sacco['name'],
        ];
        return view('Modules\Admin\Views\user_shares', $data);
    }

    public function newMembers()
    {
        $newMembers = $this->adminModel->findAllNewMembers();
        $data = [
            'newMembers' => $newMembers,
        ];
        return view('Modules\Admin\Views\new-members', $data);
    }

    public function approveMemberRequest($id)
    {
        $approve = $this->adminModel->approveMemberRequest($id);
        if ($approve) {
            return redirect()->to('admin/new-members')->with('success', 'Member approved successfully');
        } else {
            return redirect()->to('admin/new-members')->with('fail', 'Member approval failed');
        }
    }

    public function deleteMemberRequest($id)
    {
        $delete = $this->adminModel->deleteMemberRequest($id);
        if ($delete) {
            return redirect()->to('admin/new-members')->with('success', 'Request deleted successfully');
        } else {
            return redirect()->to('admin/new-members')->with('fail', 'Member request deletion failed');
        }
    }

    public function login()
    {
        $data = [];
        $data["adminLoginTitle"] = "Admin Login";
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Your email is required',
                        'valid_email' => 'A valid email address is required',
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[5]|max_length[20]',
                    'errors' => [
                        'required' => 'Your password is required',
                        'min_length' => 'The length of password must be more than five',
                        'max_length' => 'The maximum password length must be less than twenty',
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;


            } else {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $sacco = $this->adminModel->loginSacco($email);

                if (!$sacco) {
                    session()->setFlashdata('fail', 'Can`t find the user with that email');
                    return redirect()->to('admin/login');
                }

                $passwordCheck = Hash::decrypt($password, $sacco['password']);
                if (!$passwordCheck) {
                    session()->setFlashdata('fail', 'Password is incorrect');
                    return redirect()->to('admin/login');
                } else {
                    $sacco_id = $sacco['sacco_id'];
                    $sacco_uuid = $sacco['uuid'];
                    $sessionData = array(
                        'sacco_id' => $sacco_id,
                        'currentLoggedInSacco' => $sacco_uuid,
                        'name' => $sacco['name'],
                    );

                    session()->set($sessionData);

                    return redirect()->to('admin/dashboard');
                }
            }

        }
        return view('Modules\Admin\Views\login', $data);
    }

    public function changePassword()
    {
        $data = [
            'changePasswordTitle' => 'Change Password',
        ];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'oldPassword' => [
                    'rules' => 'required|min_length[5]|max_length[20]',
                    'errors' => [
                        'required' => 'Old password field is required',
                        'min_length' => 'Old password must be more than five',
                        'max_length' => 'Old password must be less than twenty',
                    ]
                ],
                'newPassword' => [
                    'rules' => 'required|min_length[5]|max_length[20]',
                    'errors' => [
                        'required' => 'New password field is required',
                        'min_length' => 'New password must be more than five',
                        'max_length' => 'New password must be less than twenty',
                    ]
                ],
                'confPassword' => [
                    'rules' => 'required|min_length[5]|max_length[20]|matches[newPassword]',
                    'errors' => [
                        'required' => 'Confirm password field is required',
                        'min_length' => 'Confirm password must be more than five',
                        'max_length' => 'Confirm password must be less than twenty',
                        'matches' => 'Confirm password must match with new password',
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                $oldPassword = $this->request->getPost('oldPassword');
                $newPassword = $this->request->getPost('newPassword');
                $uuid = session()->get('currentLoggedInSacco');
                $sacco = $this->adminModel->getCurrentSaccoInformation($uuid);
                $passwordCheck = Hash::decrypt($oldPassword, $sacco['password']);

                if (!$passwordCheck) {
                    session()->setFlashdata('fail', 'Old password is incorrect');
                    return redirect()->to('admin/change-password');
                } else {
                    $newPassword = Hash::encrypt($newPassword);
                    if ($this->adminModel->updatePassword($uuid, $newPassword)) {
                        session()->setFlashdata('success', 'Password was updated successfully');
                        return redirect()->to('admin/dashboard');
                    } else {
                        session()->setFlashdata('fail', 'Password was not updated, please try again');
                        return redirect()->to('admin/change-password');
                    }
                }
            }
        }
        return view('Modules\Admin\Views\change-password', $data);

    }

    public function logout()
    {
        if (session()->has('currentLoggedInSacco')) {
            session()->remove('currentLoggedInSacco');
            return redirect()->to('admin/login');
        }

    }

    public function uploadAgreementFile()
    {
        return view('Modules\Admin\Views\upload-agreement-file');
    }

    public function uploadAgreementFilesDocument()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'agreementFile' => [
                    'rules' => 'uploaded[agreementFile]|max_size[agreementFile,1024]|ext_in[agreementFile,pdf]',
                    'errors' => [
                        'uploaded' => 'Please select a file to upload',
                        'max_size' => 'The file size must be less than 1MB',
                        'ext_in' => 'The file must be a pdf file',
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $file = $this->request->getFile('agreementFile');
                $file->move('uploads/agreement-files');
                $fileData = [
                    'sacco_id' => session()->get('sacco_id'),
                    'file' => $file->getName(),
                ];
                $save = $this->adminModel->saveAgreementFile($fileData);
                if ($save) {
                    return $this->response->setJSON(['success' => 'File uploaded successfully']);
                } else {
                    return $this->response->setJSON(['fail' => 'File upload failed']);
                }
            }
        }
    }

    public function reports()
    {
        $sacco_id = session()->get('sacco_id');
        $transactions = $this->adminModel->getTransactions($sacco_id);

        $data = [
            'reportsTitle' => 'Reports',
            'transactions' => $transactions,
        ];
        return view('Modules\Admin\Views\reports', $data);
    }

    public function viewReports()
    {

        $sacco_id = session()->get('sacco_id');
        $report_id = $this->request->getPost('report_id');
        $data['report'] = $this->adminModel->getReport($sacco_id, $report_id);
        return $this->response->setJSON($data);
    }

    public function text_msg($phone_no, $message)
    {
        $headers = array(
            "Content-Type: application/json"
        );

        $payload = array(
            "apikey" => getenv('MESSAGE_API_KEY'),
            "partnerID" => getenv('MESSAGE_PARTNER_ID'),
            'pass_type' => "plain",
            "shortcode" => getenv('MESSAGE_SHORT_CODE'),
            "mobile" => $phone_no,
            "message" => $message,
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://quicksms.advantasms.com/api/services/sendsms/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        try {
            $response = curl_exec($ch);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $this->adminModel->insertError($e->getMessage());
        }
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo "HTTP Status: " . $http_status;

        curl_close($ch);

        return json_decode($response);
    }


    public function markAsComplete($report_id)
    {
        $sacco_id = session()->get('sacco_id');
        $buyer_fname = '';
        $seller_fname = '';
        $buyer_phone = '';
        $seller_phone = '';

        try {
            $transaction_report = $this->adminModel->getReport($sacco_id, $report_id);
            $buyer_fname = $transaction_report[0]['buyer_fname'];
            $seller_fname = $transaction_report[0]['seller_fname'];
            $buyer_phone = $transaction_report[0]['buyer_phone'];
            $seller_phone = $transaction_report[0]['seller_phone'];

        } catch (\CodeIgniter\Database\Exceptions\DataBaseException $e) {
            $this->adminModel->insertError($e->getMessage());
        }

        try {
            $this->adminModel->updateTransactionStatus($report_id);
        } catch (\CodeIgniter\Database\Exceptions\DataBaseException $e) {
            $this->adminModel->insertError($e->getMessage());
        }
        $seller_text_message = "Congratulations " . $seller_fname . ", your shares has been sold successfully, please wait for payment within 24 hours";
        $buyer_text_message = "Congratulations " . $buyer_fname . ", you have successfully bought shares from " . $seller_fname . ", your shares has been added to your account";

        if ($this->text_msg($seller_phone, $seller_text_message) && $this->text_msg($buyer_phone, $buyer_text_message)) {
            session()->setFlashdata('success', 'Transaction is completed successfully');
            return redirect()->to(base_url('admin/reports'));
        } else {
            session()->setFlashdata('fail', 'The transaction has been completed, but the text messages were not sent');
            return redirect()->to(base_url('admin/reports'));
        }
    }

    public function pricePerShare()
    {

        $sacco_id = session()->get('sacco_id');
        $data = [
            'pricePerShare' => $this->adminModel->getAllRecords($sacco_id),
        ];

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'pricePerShare' => 'required|numeric',
            ];
            if (!$this->validate($rules)) {
                session()->setFlashdata('fail', 'Please fill all the fields');
                return redirect()->back()->to(base_url('admin/price_per_share'));
            } else {


                $pricePerShare = $this->request->getVar('pricePerShare');


                $getAllRecords = $this->adminModel->getAllRecords($sacco_id);
                $countRecords = count($getAllRecords);


                $insertData = [
                    'sacco_id' => $sacco_id,
                    'price_per_share' => $pricePerShare,
                ];

                if ($countRecords == 1) {
                    $updatePricePerShare = $this->adminModel->updatePricePerShare($sacco_id, ['price_per_share' => $pricePerShare]);
                    if ($updatePricePerShare) {
                        session()->setFlashdata('success', 'Price per share updated successfully');
                        return redirect()->to(base_url('admin/price_per_share'));
                    } else {
                        session()->setFlashdata('fail', 'Price per share not updated, please check the logs for more information');
                        return redirect()->to(base_url('admin/price_per_share'));
                    }

                } else {
                    $insertPricePerShare = $this->adminModel->insertPricePerShare($insertData);
                    if ($insertPricePerShare) {
                        session()->setFlashdata('success', 'Price per share is set successfully');
                        return redirect()->to(base_url('admin/price_per_share'));
                    } else {
                        session()->setFlashdata('fail', 'Price per share not updated, please check the logs for more information');
                        return redirect()->to(base_url('admin/price_per_share'));
                    }
                }

            }


        }
        return view('Modules\Admin\Views\price_per_share', $data);
    }

    public function newUser()
    {
        return view('Modules\Admin\Views\new-user');
    }

    public function newUserPost()
    {
        if ($this->request->getMethod() == 'post') {

            $rules = [
                'fname' => 'required|min_length[3]|max_length[20]',
                'lname' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'phone' => 'required|is_unique[users.phone]',
            ];

            if (!$this->validate($rules)) {
                $response = [
                    'error' => true,
                    'messages' => $this->validator->getErrors()
                ];

                return $this->response->setJSON($response);

            } else {
                $fname = $this->request->getPost('fname');
                $lname = $this->request->getPost('lname');
                $email = $this->request->getPost('email');
                $phone = $this->request->getPost('phone');
                $password = random_string('alnum', 8);

                $data = [
                    'fname' => $fname,
                    'lname' => $lname,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'activation_status' => '1',
                    'uniid' => md5(str_shuffle('abcdefghijkmnopqstuvwxyz' . time())),
                    'activation_date' => date('Y-m-d H:i:s'),
                ];

                $message = "Hello " . $fname . ", your account has been created successfully, your password is " . $password . ", please login to your account and change your password";

                $sendEmail = $this->sendEmail($fname, $email, $message);

                if ($this->adminModel->saveUser($data)) {
                    if ($sendEmail) {
                        $response = [
                            'error' => false,
                            'status' => 200,
                            'messages' => 'User created successfully, and password has been shared through email'
                        ];
                        return $this->response->setJSON($response);
                    } else {
                        $response = [
                            'error' => false,
                            'status' => 201,
                            'messages' => 'User created successfully, but we were unable to send the password through email'
                        ];
                        return $this->response->setJSON($response);
                    }
                } else {
                    $response = [
                        'error' => true,
                        'status' => 500,
                        'messages' => 'User registration failed, please check the logs for more information'
                    ];
                    return $this->response->setJSON($response);
                }
            }
        }
    }

    public function newUserPostCsv()
    {


        if ($file = $this->request->getFile('file')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('./uploads/csv', $newName);
                $csvFile = './uploads/csv/' . $newName;
                $csvData = array_map('str_getcsv', file($csvFile));
                $csvData = array_slice($csvData, 1);
                $csvData = array_map(function ($csvData) {
                    return [
                        'fname' => $csvData[0],
                        'lname' => $csvData[1],
                        'email' => $csvData[2],
                        'phone' => $csvData[3],
                        'password' => password_hash($csvData[4], PASSWORD_DEFAULT),
                        'activation_status' => '1',
                        'uniid' => md5(str_shuffle('abcdefghijkmnopqstuvwxyz' . time())),
                        'activation_date' => date('Y-m-d H:i:s'),
                    ];
                }, $csvData);
//
                foreach ($csvData as $user) {
                    $findRecord = $this->adminModel->findRecord($user['email'], $user['phone']);
                    if ($findRecord === 0) {
                        try {
                            $insertData = $this->adminModel->insertCsvData($user);
                            if ($insertData) {
                                $response = [
                                    'error' => false,
                                    'status' => 200,
                                    'messages' => 'Users created successfully'
                                ];
                                return $this->response->setJSON($response);
                            }
                        } catch (\CodeIgniter\Database\Exceptions\DataBaseException $e) {
                            $data = [
                                'error' => $e->getMessage(),
                            ];
                            if ($this->adminModel->insertError($data)) {
                                $response = [
                                    'error' => true,
                                    'status' => 500,
                                    'messages' => 'Users registration failed, please check the logs for more information'
                                ];
                                return $this->response->setJSON($response);
                            }
                        }
                    }
                }

            }
        }
    }

    public function sendEmail($name, $email, $message)
    {
        $this->email->setFrom('billclintonogot88@gmail.com', 'Sacco Hisa Shares Portal');
        $this->email->setTo("$email");

        $this->email->setSubject('Login Password');

        $email_template = view('Modules\Admin\Views\email-template', [
            'name' => $name,
            'message' => $message
        ]);

        // Set email message
        $this->email->setMessage($email_template);
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }


    public function viewShareNotification()
    {
        $sacco_id = session()->get('sacco_id');
        $data = $this->adminModel->getShareNotification($sacco_id);
        return $this->response->setJSON($data);

    }

    public function viewEachShareNotification()
    {
        $share_id = $this->request->getPost('share_id');
        $data = $this->adminModel->getEachShareNotification($share_id);
        return $this->response->setJSON($data);
    }

    public function rejectShare()
    {
        $sacco_id = session()->get('sacco_id');
        $share_id = $this->request->getPost('share_id');
        $user_id = $this->request->getPost('user_id');
        $reason = $this->request->getPost('reason');
        $data = [
            'share_id' => $share_id,
            'user_id' => $user_id,
            'sacco_id' => $sacco_id,
            'reason' => $reason,
        ];
        $response = $this->adminModel->saveRejectedShare($data);
        if ($response) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'The shares has been rejected']);
        } else {
            return $this->response->setJSON(['status' => 'fail', 'message' => 'An error occurred, please try again']);
        }

    }

    public function approveShare()
    {
        $share_id = $this->request->getPost('share_id');
        $user_id = $this->request->getPost('user_id');
        $response = $this->adminModel->approveShare($share_id, $user_id);
        if ($response) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'The shares has been approved']);
        } else {
            return $this->response->setJSON(['status' => 'fail', 'message' => 'An error occurred, please try again']);
        }


    }

    public function updateRejectShares()
    {
        $share_id = $this->request->getPost('share_id');
        $user_id = $this->request->getPost('user_id');
        $response = $this->adminModel->updateRejectShares($share_id, $user_id);
        return $this->response->setJSON($response);
    }

    public function getAllAppUsers()
    {
        $search = $this->request->getVar('search');
        $data = $this->adminModel->getAllAppUsers($search);
        return $this->response->setJSON($data);
    }

    public function adminSellShares()
    {
        $rules = [
            'membershipNumber' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Membership number is required',
                ]
            ],
            'sharesAmount' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'The amount of share is required',
                    'numeric' => 'The amount of share must be a number',
                ]
            ],
            'total' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'The share cost is required',
                    'numeric' => 'The cost per share must be a number',
                ]
            ],
        ];
        if ($this->validate($rules)) {
            $shareData = [

                'uuid' => uniqid(),
                'user_id' => $this->request->getPost('user_id'),
                'sacco_id' => $this->request->getPost('sacco_id'),
                'membership_number' => $this->request->getPost('membershipNumber'),
                'shares_on_sale' => $this->request->getPost('sharesAmount'),
                'total' => $this->request->getPost('total'),
                'is_verified' => 1,

            ];
            try {
                $save = $this->adminModel->createShare($shareData);
                if ($save) {
                    $response = [
                        'error' => false,
                        'status' => 200,
                        'messages' => 'Shares created successfully'
                    ];
                    return $this->response->setJSON($response);
                }
            } catch (\CodeIgniter\Database\Exceptions\DataBaseException $e) {
                $data = [
                    'error' => $e->getMessage(),
                ];
                if ($this->adminModel->insertError($data)) {
                    $response = [
                        'error' => true,
                        'status' => 500,
                        'messages' => 'Shares registration failed, please check the logs for more information'
                    ];
                    return $this->response->setJSON($response);
                }
            }
        } else {
            $response = [
                'error' => true,
                'status' => 500,
                'messages' => $this->validator->getErrors()
            ];
            return $this->response->setJSON($response);
        }
    }

    public function UpdateAccount()
    {

        return view('Modules\Admin\Views\update-account');

    }

    public function UpdateAccountPost()
    {
        $contactPhone = $this->request->getPost('contactPersonPhone');
        $contactEmail = $this->request->getPost('contactPersonEmail');
        $saccoHeadquarter = $this->request->getPost('saccoHeadquarter');
        $website = $this->request->getPost('website');
        $saccoLogo = $this->request->getFile('saccoLogo');


        $currentLoggedSacco = session()->get('currentLoggedInSacco');

        if($saccoLogo && $saccoLogo->isValid() && !$saccoLogo->hasMoved()){
            $newName = $saccoLogo->getRandomName();
            $saccoLogo->move('uploads/sacco-logo', $newName);
            $this->adminModel->updateSaccoLogo($newName, $currentLoggedSacco);
        }

        if($this->adminModel->updateSaccoProfile($contactPhone, $contactEmail, $saccoHeadquarter, $website, $currentLoggedSacco)){

            $response = [
                'error' => false,
                'status' => 201,
                'messages' => 'Sacco profile has been updated successfully'
            ];
            return $this->response->setJSON($response);
        }
        $response = [
            'error' => true,
            'status' => 500,
            'messages' => 'There was an error updating the account, please try again later'
        ];
        return $this->response->setJSON($response);
    }

    public function getUpdatedProfile(){
        $currentLoggedSacco = session()->get('currentLoggedInSacco');
        $data = $this->adminModel->getUpdatedProfile($currentLoggedSacco);
        $response =[
            'status' => 200,
            'data' => $data
        ];
        return $this->response->setJSON($response);
    }

    public function getSaccoImage(){
        $currentLoggedSacco = session()->get('currentLoggedInSacco');
        $data = $this->adminModel->getSaccoImage($currentLoggedSacco);
        $response =[
            'status' => 200,
            'data' => $data
        ];
        return $this->response->setJSON($response);
    }
}