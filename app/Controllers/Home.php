<?php

namespace App\Controllers;
use App\Libraries\Hash;
use App\Models\DisplayDashboardModel;
use App\Models\Users;
use App\Models\Shares;
use App\Models\Sacco;
use App\Models\SaccoMembership;
use App\Models\Notification;
use CodeIgniter\I18n\Time;


class Home extends BaseController


{
    public $displayDashboard;
    public $email;
    public $shares;
    public $users;
    public $sacco;
    public $saccoMembershp;
    public $notification;

    public function __construct(){

        $this->displayDashboard = new DisplayDashboardModel();
        $this->email = \Config\Services::email();
        $this->shares = new Shares();
        $this->users = new Users();
        $this->sacco = new Sacco();
        $this->saccoMembershp = new SaccoMembership();
        $this->notification = new Notification();

    }

    public function index() {

        $pager = \Config\Services::pager();
        $globalTime = [];
        $shares = $this->shares->select('shares.*, users.fname, users.lname')
            ->join('users', 'users.user_id = shares.user_id', 'left')
            ->orderBy('shares.created_at', 'DESC')
            ->paginate(10);


        foreach ($shares as $share) {
            $time = $share['created_at'];
            $parse = Time::parse($time);
            $time = $parse->humanize();
            $globalTime = $time;
        }
        $data = [
            'indexTitle' => 'welcome to our platform',
            'shares' => $shares,
            'time' => $globalTime,
            'pager' => $this->shares->pager,
        ];

        return view('index', $data);
    }
    public function dashboard() {

        $data['dashboardTitle'] = 'Dashboard';
        $uniid = session()->get('currentLoggedInUser');
        $data['userData'] = $this->displayDashboard->getCurrentUserInformation($uniid);

        if($this->request->getMethod() == 'post'){
            $shares = $this->request->getVar('shares', FILTER_SANITIZE_STRING);
            $price = $this->request->getVar('price', FILTER_SANITIZE_STRING);
            $total = $this->request->getVar('total', FILTER_SANITIZE_STRING);

            $shareData = [

                'user_id'     => $data['userData']->user_id,
                'uuid'   => md5(str_shuffle('abcdefghijklmnopqrstuvwxyz1234567890'.time())),
                'sacco' => 'Hisa',
                'membership_number' => '123456789',
                'shares_amount' => $shares,
                'cost'  => $price,
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

        return view('dashboard', $data);
    }

    public function changePassword(){
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
                        $message = "Hello ".$userData['lname']. "Your your password reset link has been sent successfully, click the link now to change your password".anchor(base_url('password-reset/'.$userData['uniid']),' reset password link','');
                        $this->email->setFrom('billclintonogot88@.com', 'Saaco Product Application');
                        $this->email->setTo("$email");

                        $this->email->setSubject('Email Password Reset Link');
                        $this->email->setMessage($message);

                        if($this->email->send()){
                            session()->setTempdata('success', 'An email with the password reset link has been sent to your email, change your password within 39 min', 3);
                            return redirect()->to(base_url('reset-password'));
                        }else{
                            return redirect()->to(base_url('reset-password'))->with('fail', 'we can not send an activation email now');
                        }

                    }else{
                        session()->setTempdata('fail', 'We can not update your password right now', 3);
                        return redirect()->to(base_url('reset-password'));
                    }
                }else{
                    session()->setTempdata('fail', 'Your details were not found', 3);
                    return redirect()->to(base_url('reset-password'));
                }

            }
        }
        return view('reset-password', $data);
}

public function verifyEmail($uniid=null){
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
                                return redirect()->to(base_url('login'));
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
        return view('verify-email', $data);
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
        $uuid = session()->get('currentLoggedInUser');
        $user = $this->users->where('uniid', $uuid)->first();
        $shares = $this->shares->select('shares.*, users.fname, users.lname')
            ->join('users', 'users.user_id = shares.user_id', 'left')
            ->where('shares.uuid', $id)
            ->first();

        //retrieving the users who are already registered to the sacco they want to buy shares from
        $registered = $this->shares->where('user_id', $user['user_id'])
                ->where('sacco', $shares['sacco'])
                ->countAllResults() > 0;

        $data = [
            'share' => $shares,
            'is_registered' => $registered,
        ];

        return view('share', $data);
    }

    public function payment(){
        return view('payment');
    }

    public function saccoMembership($id = null){

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


                $membership = [
                    'user_id' => $user['user_id'],
                    'id_number' => $identification,
                    'sacco_id' => $sacco_id,
                ];

                //checking if the user has already requested to join the sacco
                $is_requested = $this->saccoMembershp->where('user_id', $user['user_id'])
                    ->where('sacco_id', $sacco_id)
                    ->countAllResults() > 1;
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
    public function messages(){
        return view('messages');
    }
    public function message($id = null){
        return view('message');
    }

}
