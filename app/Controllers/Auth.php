<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\Users;
use App\Models\LoginActivityModel;
use App\Models\DisplayDashboardModel;
use Config\Services;
use Config\Session;

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

    public function login(){
        $data = [];
        $data['loginTitle'] = 'Login';
        $session = \CodeIgniter\Config\Services::session();
        if($this->request->getMethod() == 'post'){
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
            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;


            }else{
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $user = $this->userModel->where('email', $email)->first();
                if($user){
                    if(Hash::decrypt($password, $user['password'])){
                        if($user['activation_status'] == 1){

                            //getting the user agent

                            $loginInfo = [
                                'uniid' => $user['uniid'],
                                'ip'    => $this->request->getIPAddress(),
                                'agent' => $this->getUserAgentInfo(),
                                'login_time' => date('Y-m-d h:i:s'),
                            ];


                            //saving the data into the login_activity model and getting the id of the last inserted data
                            $login_activity_id = $this->loginActivityModel->saveLoginActivityInfo($loginInfo);

                            if($login_activity_id){
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
                        }else{
                            session()->setFlashdata('fail', 'Please activate your account or contact the admin');
                            return redirect()->to(base_url('login'));
                        }
                    }else{
                        session()->setFlashdata('fail', 'Password is incorrect');
                        return redirect()->to(base_url('login'));
                    }
                }else{
                    session()->setFlashdata('fail', 'Can`t find the user with that email');
                    return redirect()->to(base_url('login'));
                }
            }

        }
        return view('login', $data);
    }
    public function register(){
        $data = [];
        $data['registerTitle'] = 'Register';
        if($this->request->getMethod() == 'post'){

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
            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $fname = strtolower($this->request->getPost('fname'));
                $sanitizeFname = filter_var($fname, FILTER_SANITIZE_STRING);
                $lname = strtolower($this->request->getPost('lname'));
                $sanitizelname = filter_var($lname, FILTER_SANITIZE_STRING);
                $phone = $this->request->getPost('phone');
                $sanitizePhone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
                $email = $this->request->getPost('email');
                $sanitizeEmail = filter_var($email,FILTER_SANITIZE_STRING);
                $password = $this->request->getPost('password');

                //generating the unique id for the user
                $uniid = md5(str_shuffle('abcdefghijkmnopqstuvwxyz'.time()));
                $usersData = [
                    'fname' => $sanitizeFname,
                    'lname' => $sanitizelname,
                    'phone' => $sanitizePhone,
                    'email' => $sanitizeEmail,
//                    'activation_link' => random_string('alnum', 20), generating a random string for the activation link
                    'password' => Hash::encrypt($password),
                    'uniid' => $uniid,
                    'activation_date' => date('Y-m-d h:i:s') //update the activation_date each time the page is requested
                ];
                $query = $this->userModel->insert($usersData);
                if($query){
                    $message = "Hello".$sanitizeFname."\n Your account was created successfully, please activate your account using the following link \n".anchor(base_url('activate/'.$usersData['uniid']),' Activate now','');
                    $emailSubject = "Account Activation Link";
                    $setFrom = 'billclintonogot88@gmail.com';
                    $messageTitle = "Sacco Product Application";
                    if($this->sendEmail($fname, $email, $setFrom, $messageTitle, $emailSubject, $message)){
                        session()->setFlashdata('success', 'An activation email has been sent to your email, please activate your account');
                        return redirect()->to(base_url('login'));
                    }else{
                        session()->setFlashdata('fail', 'There was an error sending activation email');
                        return redirect()->to(base_url('register'));
                    }
                }else{
                    session()->setFlashdata('fail', 'Registration has failed, please try again latter');
                    return redirect()->back(base_url('register'));
                }

            }
        }
        return view('register', $data);
    }

    public function sendEmail($name, $email, $setFrom, $messageTitle, $emailSubject, $message)
    {
        $this->email->setFrom($setFrom, $messageTitle);
        $this->email->setTo("$email");

        $this->email->setSubject("$emailSubject");

        $email_template = view('email_template_account_creation', [
            'name' => $name,
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


public function activate($uuid = null){

        $data = [];
        if(!empty($uuid)){

            $checkLink = $this->userModel->where('uniid', $uuid)->findAll();
            if($checkLink){

                if($this->expiry_date($checkLink[0]['activation_date'])){

                    if($checkLink[0]['activation_status'] == 0){
                        $data['activation_status'] = 1;
                        $activated = $this->userModel->update($checkLink[0]['user_id'], $data);
                        if($activated){
                            $data['success'] = 'Account has been activated successfully';
                        }
                    }else{
                        $data['error'] = "The account has already been activated go back to login";
                    }

                }else{
                    $data['error'] = 'The activation link has expired';
                }
            }else{
                $data['error'] = 'We are not able to find records requested';
            }

        }else{

            $data['error'] = 'We are not able to process your request now';
        }

        return view('activate', $data);
}

public function expiry_date($expiry_date){

    $updated_time = strtotime($expiry_date);
    $currentTime = time();
    $difference_time = ($currentTime - $updated_time)/60;
    if($difference_time < 3600){
        return true;
    }else{
        return false;
    }
}

//the second function for expiry date

public function checkExpiry($date){
        $current_time = now();
        $reg_time = strtotime($current_time);
        $difference_in_time = (int)$date - (int)$reg_time;
        if(3600 < $difference_in_time){
            return true;
        }else{
            return false;
        }
    }

//the function that is user to get user agent detail
public function getUserAgentInfo(){
        $agent = $this->request->getUserAgent();
        if($agent->isBrowser()){
            $currentAgent = $agent->getBrowser();
        }elseif($agent->isRobot()){
            $currentAgent = $this->agent->robot();
        }elseif ($agent->isMobile()){
            $currentAgent = $agent->getMobile();
        }else{
            $currentAgent = 'Unidentified User Agent';
        }
        return $currentAgent;
     }
public function changePassword(){
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
        if(!$this->validate($rules)){

            $data['validation'] = $this->validator;

        }else{
            if($this->request->getMethod() == 'post'){

                $old_password = $this->request->getPost('oldPassword');
                $new_password = password_hash($this->request->getPost('newPassword'), PASSWORD_DEFAULT);
                if(Hash::decrypt($old_password, $data['user']->password)){
                   if($this->getCurrntLoggedInUser->updatePassword($new_password, session()->get('currentLoggedInUser')))
                    {
                        session()->setFlashdata('success', 'You have changed your password');
                        return redirect()->to(base_url('/change-password'));
                    }
                    else{
                        session()->setFlashdata('fail', 'We can not update your password now');
                        return redirect()->to(base_url('/change-password'));
                    }
                }else {
                    session()->setFlashdata('fail', 'Your old password is incorrect, try again');
                    return redirect()->to(base_url('/change-password'));
                }
            }
        }
        return view('change-password', $data);
}
    public function logout(){
        if(session()->has('currentLoggedInUser')){
            $loggedIn_info_id = session()->get('currentLoggedInUser'); //getting the id of the loggedIn info set in the session
            $this->loginActivityModel->updateLogoutActivity($loggedIn_info_id);
        }
        if(session()->has('currentLoggedInUser')){
            session()->remove('currentLoggedInUser');
//            return redirect()->to(base_url(' /login'))->with('success', 'You have logged out');
            return $this->response->setJSON([
                'success' => true,
                'message' => 'You have logged out'
            ]);
        }
    }
}

