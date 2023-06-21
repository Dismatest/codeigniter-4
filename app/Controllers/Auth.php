<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\Users;
use App\Models\LoginActivityModel;
use App\Models\DisplayDashboardModel;
use Config\Services;
use Config\Session;
use Ramsey\Uuid\Uuid;

class Auth extends BaseController

{
    // loading the text helper that contains random_string function, available to the Auth class
    public $userModel;
    public $loginActivityModel;
    public $getCurrntLoggedInUser;
    public $email;

    public function __construct()
    {
        helper(['form', 'url', 'text', 'date']);
        $this->userModel = new Users();
        $this->loginActivityModel = new LoginActivityModel();
        $this->getCurrntLoggedInUser = new DisplayDashboardModel();
        $this->email = \Config\Services::email();
    }

    public function login()
    {
        $data = [];
        $data['loginTitle'] = 'Login';
        $session = \CodeIgniter\Config\Services::session();
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

                $user = $this->userModel->where('email', $email)->first();
                if ($user) {
                    if (Hash::decrypt($password, $user['password'])) {
                        if ($user['activation_status'] == 1) {

                            //getting the user agent

                            $loginInfo = [
                                'uniid' => $user['uniid'],
                                'ip' => $this->request->getIPAddress(),
                                'agent' => $this->getUserAgentInfo(),
                                'login_time' => date('Y-m-d h:i:s'),
                            ];


                            //saving the data into the login_activity model and getting the id of the last inserted data
                            $login_activity_id = $this->loginActivityModel->saveLoginActivityInfo($loginInfo);

                            if ($login_activity_id) {
                                session()->set('logged_in_info', $login_activity_id);
                            }
                            $sessionData = [
                                'user_id' => $user['user_id'],
                                'currentLoggedInUser' => $user['uniid'],
                                'email' => $user['email'],
                                'fname' => $user['fname'],
                                'lname' => $user['lname'],
                                'phone' => $user['phone'],
                            ];
                            session()->set($sessionData);
                            return redirect()->to('/explore');
                        } else {
                            session()->setFlashdata('fail', 'Please activate your account or contact the admin');
                            return redirect()->to(base_url('login'));
                        }
                    } else {
                        session()->setFlashdata('fail', 'Password is incorrect');
                        return redirect()->to(base_url('login'));
                    }
                } else {
                    session()->setFlashdata('fail', 'Can`t find the user with that email');
                    return redirect()->to(base_url('login'));
                }
            }

        }
        return view('login', $data);
    }

    public function register()
    {
        $data = [];
        $data['registerTitle'] = 'Register';
        if ($this->request->getMethod() == 'post') {

            $rules = [
                'fname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Your first name is required',
                    ]
                ],
                'lname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Your last name is required',
                    ]
                ],
                'phone' => [
                    'rules' => 'required|regex_match[/^\d{10}$|^\d{3} \d{3} \d{4}$/]|is_unique[users.phone]',
                    'errors' => [
                        'required' => 'Your phone number is required',
                        'regex_match' => 'Your phone number is not valid',
                        'is_unique' => 'The phone number is already taken',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required' => 'Your email is required',
                        'valid_email' => 'A valid email address is required',
                        'is_unique' => 'The email is already in use',
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
                'confirm-password' => [
                    'rules' => 'required|min_length[5]|max_length[20]|matches[password]',
                    'errors' => [
                        'required' => 'Password is required',
                        'min_length' => 'The length of password must be more than five',
                        'max_length' => 'The maximum password length must be less than twenty',
                        'matches' => 'The two password must match',
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $fname = strtolower($this->request->getPost('fname'));
                $sanitizeFname = filter_var($fname, FILTER_SANITIZE_STRING);
                $lname = strtolower($this->request->getPost('lname'));
                $sanitizelname = filter_var($lname, FILTER_SANITIZE_STRING);
                $phone = $this->request->getPost('phone');
                $sanitizePhone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
                $email = $this->request->getPost('email');
                $sanitizeEmail = filter_var($email, FILTER_SANITIZE_STRING);
                $password = $this->request->getPost('password');

                $usersData = [
                    'fname' => $sanitizeFname,
                    'lname' => $sanitizelname,
                    'phone' => $sanitizePhone,
                    'email' => $sanitizeEmail,
                    'password' => Hash::encrypt($password),
                    'uniid' => Uuid::uuid4()->toString(),
                ];
                $query = $this->userModel->insert($usersData);

                try {
                    $query_result = $this->userModel->where('uniid', $usersData['uniid'])->find();
                    $user_id = $query_result[0]['user_id'];
                }catch (\Exception $e){
                    die($e->getMessage());
                }

                $message = "<br/><br/>Dear " . ucfirst($sanitizeFname) . "\n Your account was created successfully, please activate your account using the following link within 39 minutes\n" . anchor(base_url('activate/' . $usersData['uniid']), '<br/></br/> Activate your account', '');
                $subject = ucfirst($fname) . ', Account activation';
                if ($query) {
                    if (service('sendEmail')->send_email($fname, $email, $subject, $message)) {
                        $email_logs = [
                            'uuid' => Uuid::uuid4()->toString(),
                            'fname' => $sanitizeFname .' ' .$sanitizelname,
                            'email' => $sanitizeEmail,
                            'message_title' => $subject,
                            'role' => 'user',
                            'status' => '1',
                        ];

                        $this->loginActivityModel->insertEmailLogs($email_logs);
                        session()->setFlashdata('success', 'An activation email has been sent to your email, please activate your account within 39 minutes');
                        return redirect()->to(base_url('login'));
                    } else {
                        $email_logs = [
                            'uuid' => Uuid::uuid4()->toString(),
                            'fname' => $sanitizeFname .' ' .$sanitizelname,
                            'email' => $sanitizeEmail,
                            'message_title' => $subject,
                            'role' => 'user',
                            'status' => '0',
                        ];
                        $this->loginActivityModel->insertEmailLogs($email_logs);
                        session()->setFlashdata('fail', 'There was an error sending activation email');
                        return redirect()->to(base_url('register'));
                    }
                } else {
                    session()->setFlashdata('fail', 'Registration has failed, please try again latter');
                    return redirect()->back(base_url('register'));
                }

            }
        }
        return view('register', $data);
    }

    public function activate($uuid = null)
    {

        if (!empty($uuid)) {

            $checkLink = $this->userModel->where('uniid', $uuid)->findAll();
            if ($checkLink) {

                if ($this->expiry_date($checkLink[0]['created_at'])) {

                    if ($checkLink[0]['activation_status'] == 0) {
                        $updatedData = [
                            'activation_status' => 1,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];
                        $activated = $this->userModel->update($checkLink[0]['user_id'], $updatedData);
                        if ($activated) {
                            session()->setFlashdata('success', 'Account has been activated successfully, you can now log in to your account');
                            return redirect()->to(base_url('login'));
                        }
                    } else {
                        session()->setFlashdata('fail', 'The account has already been activated go back to login');
                        return redirect()->to(base_url('login'));
                    }

                } else {
                    session()->setFlashdata('fail', 'The activation link has expired');
                    return redirect()->to(base_url('login'));
                }
            } else {
                session()->setFlashdata('fail', 'We are not able to find records requested');
                return redirect()->to(base_url('login'));
            }

        } else {
            session()->setFlashdata('fail', 'We are not able to process your request now');
            return redirect()->to(base_url('login'));
        }

        return view('login');
    }

//    public function expiry_date($date_created)
//    {
//
//        $updated_time = strtotime($date_created);
//        $currentTime = time();
//        $difference_time = ($currentTime - $updated_time) / 60;
//        dd($difference_time);
//        if ($difference_time < 3600) {
//            return true;
//        } else {
//            return false;
//        }
//    }

    public function expiry_date($date_created)
    {
        $updated_time = strtotime($date_created);
        $current_time = time();
        $difference_time = ($current_time - $updated_time) / 3600;
        if ($difference_time < 3600) {
            return true;
        } else {
            return false;
        }
    }


//the second function for expiry date

    public function checkExpiry($date)
    {
        $current_time = now();
        $reg_time = strtotime($current_time);
        $difference_in_time = (int)$date - (int)$reg_time;
        if (3600 < $difference_in_time) {
            return true;
        } else {
            return false;
        }
    }

//the function that is user to get user agent detail
    public function getUserAgentInfo()
    {
        $agent = $this->request->getUserAgent();
        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser();
        } elseif ($agent->isRobot()) {
            $currentAgent = $this->agent->robot();
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
        } else {
            $currentAgent = 'Unidentified User Agent';
        }
        return $currentAgent;
    }

    public function changePassword()
    {
        $data = [];
        $data['user'] = $this->getCurrntLoggedInUser->getCurrentUserInformation(session()->get('currentLoggedInUser')); //this return an object so we can assess it as $data['user]->password
        $rules = [
            'oldPassword' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Your password is required',
                ]
            ],
            'newPassword' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Your password is required',
                ]
            ],
            'confPassword' => [
                'rules' => 'required|matches[newPassword]',
                'errors' => [
                    'required' => 'Your password is required',
                ]
            ],
        ];
        if (!$this->validate($rules)) {

            $data['validation'] = $this->validator;

        } else {
            if ($this->request->getMethod() == 'post') {

                $old_password = $this->request->getPost('oldPassword');
                $new_password = password_hash($this->request->getPost('newPassword'), PASSWORD_DEFAULT);
                if (Hash::decrypt($old_password, $data['user']->password)) {
                    if ($this->getCurrntLoggedInUser->updatePassword($new_password, session()->get('currentLoggedInUser'))) {
                        session()->setFlashdata('success', 'You have changed your password');
                        return redirect()->to(base_url('/change-password'));
                    } else {
                        session()->setFlashdata('fail', 'We can not update your password now');
                        return redirect()->to(base_url('/change-password'));
                    }
                } else {
                    session()->setFlashdata('fail', 'Your old password is incorrect, try again');
                    return redirect()->to(base_url('/change-password'));
                }
            }
        }
        return view('change-password', $data);
    }

    public function logout()
    {
        if (session()->has('currentLoggedInUser')) {
            $loggedIn_info_id = session()->get('currentLoggedInUser'); //getting the id of the loggedIn info set in the session
            $this->loginActivityModel->updateLogoutActivity($loggedIn_info_id);
        }
        if (session()->has('currentLoggedInUser')) {
            session()->remove('currentLoggedInUser');
//            return redirect()->to(base_url(' /login'))->with('success', 'You have logged out');
            return $this->response->setJSON([
                'success' => true,
                'message' => 'You have logged out'
            ]);
        }
    }
}





