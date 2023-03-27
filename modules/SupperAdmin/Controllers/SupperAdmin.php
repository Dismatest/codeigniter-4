<?php
namespace Modules\SupperAdmin\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use CodeIgniter\I18n\Time;
use App\Models\loginActivityModel;

class SupperAdmin extends BaseController
{
    protected $userModel;
    protected $loginActivityModel;
    protected $email;
    public function __construct()
    {
        helper('text');
        $this->userModel = new Users();
        $this->loginActivityModel = new loginActivityModel();
        $this->email = \Config\Services::email();
    }
    public function dashboard()
    {
        $allUsers = $this->loginActivityModel->findAllUsers();
        $allSacco = $this->loginActivityModel->findAllSaccoCount();

        $data = [
            'dashboardTitle' => 'Dashboard',
            'allUsers' => $allUsers,
            'allSacco' => $allSacco,

        ];
        return view('Modules\SupperAdmin\Views\dashboard', $data);
    }

    //sacco methods
    public function registerSacco()
    {
        $data = [
            'registerSaccoTitle' => 'Register Sacco',
        ];

        if($this->request->getMethod() == 'post') {

            $rules = [
                'name' => [
                    'rules' => 'required|is_unique[sacco.name]',
                    'errors' => [
                        'required' => 'Sacco name is required',
                        'is_unique' => 'Sacco name already exists',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[sacco.email]',
                    'errors' => [
                        'required' => 'Email field is required',
                        'valid_email' => 'A valid email address is required',
                        'is_unique' => 'Email already exists',
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $name = $this->request->getVar('name');
                $email = $this->request->getVar('email');
                $uuid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz1234567890' . time()));
                $password = random_string('alnum', 8);
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $saveSacco = [
                    'uuid' => $uuid,
                    'name' => $name,
                    'email' => $email,
                    'password' => $hashedPassword,
                ];
                $message = "<br/> The sacco account was created successfully, please find your default password bellow, and please ensure you updated the password through the sacco admin dashboard.<br/><br/>" . $password;

                $insert = $this->loginActivityModel->registerSacco($saveSacco);
                if ($insert) {
                    if($this->sendEmail($name, $email, $message)){
                        return redirect()->to('supperAdmin/dashboard')->with('success', 'The login password has been sent to the sacco through email');
                    }else{
                        return redirect()->to('supperAdmin/dashboard')->with('error', 'There was an error sending the password to the sacco');
                    }
                }else{
                    return redirect()->to('supperAdmin/dashboard')->with('error', 'Sacco was registered, however, password was not sent');
                }
            }

        }
        return view('Modules\SupperAdmin\Views\register-sacco', $data);
    }

    public function sendEmail($name, $email, $message)
    {
        $this->email->setFrom('billclintonogot88@gmail.com', 'Sacco Product Application');
        $this->email->setTo("$email");

        $this->email->setSubject('Login Password');

        $email_template = view('Modules\SupperAdmin\Views\sacco\email-template', [
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

    public function manageSacco()
    {
        $data = [
            'manageSaccoTitle' => 'Manage Sacco',
            'sacco' => $this->loginActivityModel->findAllSacco(),

        ];
        return view('Modules\SupperAdmin\Views\manage-sacco', $data);
    }

    public function manageSaccoDelete($uuid){
        $sacco = $this->loginActivityModel->deleteSacco($uuid);
        if($sacco){
            return redirect()->to('supperAdmin/manage-sacco')->with('success', 'Sacco deleted successfully');
        }else{
            return redirect()->to('supperAdmin/manage-sacco')->with('error', 'Sacco not deleted');
        }
    }

    public function manageSaccoEdit($uuid){
        $data = [
            'manageSaccoTitle' => 'Manage Sacco',
            'sacco' => $this->loginActivityModel->findSacco($uuid),
        ];

        if($this->request->getMethod() == 'post') {
            $rules = [
                'phone' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Phone number is required',
                        'numeric' => 'Phone number should be numeric',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email field is required',
                        'valid_email' => 'A valid email address is required',
                    ]
                ],
                'office' => [
                    'rules' => 'required|max_length[50]',
                    'errors' => [
                        'required' => 'Office is required',
                        'min_length' => 'The maximum length should be 50',
                    ]
                ],
                'website' => [
                    'rules' => 'required|max_length[50]',
                    'errors' => [
                        'required' => 'Website is required',
                        'min_length' => 'The maximum length should be 50',
                    ]
                ],
                'till' => [
                    'rules' => 'required|max_length[10]|numeric',
                    'errors' => [
                        'required' => 'Till number is required',
                        'min_length' => 'The maximum length should be 10',
                        'numeric' => 'Till number should be numeric',
                    ]
                ],
                'commission' => [
                    'rules' => 'required|max_length[2]|numeric',
                    'errors' => [
                        'required' => 'Commission is required',
                        'min_length' => 'The maximum length should be 2',
                        'numeric' => 'Commission should be numeric',
                    ]
                ],
            ];
            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else {

                $phone = $this->request->getVar('phone');
                $email = $this->request->getVar('email');
                $location = $this->request->getVar('office');
                $website = $this->request->getVar('website');
                $till = $this->request->getVar('till');
                $commission = $this->request->getVar('commission');

                $updateSacco = [
                    'contact_phone' => $phone,
                    'contact_email' => $email,
                    'location' => $location,
                    'website' => $website,
                    'till' => $till,
                    'commission' => $commission,
                ];

                $sacco = $this->loginActivityModel->updateSacco($uuid, $updateSacco);
                if($sacco){
                    return redirect()->to('supperAdmin/manage-sacco')->with('success', 'Sacco updated successfully');
                }else{
                    return redirect()->to('supperAdmin/manage-sacco')->with('error', 'There was an error in updating sacco');
                }

            }

        }
        return view('Modules\SupperAdmin\Views\edit_sacco', $data);
    }
    //user methods

    public function listUsers()
    {
        $globalTime = [];
        $users = $this->userModel->findAll();
        foreach ($users as $user) {
            $time = $user['created_at'];
            $parse = Time::parse($time);
            $time = $parse->humanize();
            $globalTime = $time;
        }

        $data = [
            'listUserTitle' => 'List Users',
            'users' => $users,
            'time' => $globalTime,
        ];
        return view('Modules\SupperAdmin\Views\list-users', $data);
    }

    public function manageUsers(){
        $data = [
            'users' => $this->userModel->findAll(),
        ];

        return view('Modules\SupperAdmin\Views\manage-users', $data);
    }

    public function manageUsersDelete($uniid){
     $user = $this->userModel->where('uniid', $uniid)->delete();
        if($user){
            return redirect()->to('supperAdmin/manage-users')->with('success', 'User deleted successfully');
        }else{
            return redirect()->to('supperAdmin/manage-users')->with('error', 'User not deleted');
        }
    }

    public function manageUsersEdit($uniid){

        $data = [
            'editUserTitle' => 'Edit User',
            'users' => $this->userModel->where('uniid', $uniid)->first(),
        ];

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
                    'rules' => 'required|regex_match[/^\d{10}$|^\d{3} \d{3} \d{4}$/]',
                    'errors' => [
                        'required' => 'Your phone number is required',
                        'regex_match' => 'Your phone number is not valid',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Your email is required',
                        'valid_email' => 'A valid email address is required',
                    ]
                ],
                'activation_status' => [
                    'rules' => 'required|min_length[1]',
                    'errors' => [
                        'required' => 'Your password is required',
                        'min_length' => 'The length of password must be more than five',
                    ]
                ],
            ];
            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{

                $userInfo = [
                    'fname' => $this->request->getVar('fname'),
                    'lname' => $this->request->getVar('lname'),
                    'phone' => $this->request->getVar('phone'),
                    'email' => $this->request->getVar('email'),
                    'activation_status' => $this->request->getVar('activation_status'),
                ];
                $user = $this->userModel->where('uniid', $uniid)->set($userInfo)->update();
                if($user) {
                    return redirect()->to('supperAdmin/manage-users')->with('success', 'User updated successfully');
                }else{
                    return redirect()->to('supperAdmin/manage-users')->with('error', 'User not updated');
                }
            }

        }
        return view('Modules\SupperAdmin\Views\manage-users-edit', $data);
    }

    public function userLogInActivities(){
        $data = [
            'userLogInActivitiesTitle' => 'User Log In Activities',
            'users' =>  $this->loginActivityModel->getAllLoginActivities(),
        ];

        return view ('Modules\SupperAdmin\Views\user-log-in-activities', $data);
    }

    public function userLogInActivitiesDelete($id){
        $this->loginActivityModel->deleteActivity($id);
        return redirect()->to('supperAdmin/user-log-in-activities')->with('success', 'User log deleted successfully');
    }


    //shares methods
    public function approvedShares(){

        $globalTime = [];
        $users = $this->loginActivityModel->findAllAprovedShares();
        foreach ($users as $user) {
            $time = $user['created_at'];
            $parse = Time::parse($time);
            $time = $parse->humanize();
            $globalTime = $time;
        }

        $data = [
            'approvedSharesTitle' => 'Approved Shares',
            'time' => $globalTime,
            'users' => $users,
        ];
        return view('Modules\SupperAdmin\Views\approved-shares', $data);
    }

    public function notApprovedShares(){
        $globalTime = [];
        $users = $this->loginActivityModel->findAllNotAprovedShares();
        foreach ($users as $user) {
            $time = $user['created_at'];
            $parse = Time::parse($time);
            $time = $parse->humanize();
            $globalTime = $time;
        }

        $data = [
            'notApprovedSharesTitle' => 'Not Approved Shares',
            'time' => $globalTime,
            'users' => $users,
        ];
        return view('Modules\SupperAdmin\Views\not-approved-shares', $data);
    }

    public function approveShare($uuid){
        $this->loginActivityModel->approveShare($uuid);
        return redirect()->to('supperAdmin/approved-shares')->with('success', 'Share approved successfully');
    }

    public function manageShares(){
        $globalTime = [];
        $shares = $this->loginActivityModel->findAllAllShares();
        foreach ($shares as $share) {
            $time = $share['created_at'];
            $parse = Time::parse($time);
            $time = $parse->humanize();
            $globalTime = $time;
        }

        $data = [
            'manageSharesTitle' => 'Manage Shares',
            'time' => $globalTime,
            'shares' => $shares,
        ];
        return view ('Modules\SupperAdmin\Views\manage-shares', $data);
    }

    public function manageSharesDelete($uuid){
        $this->loginActivityModel->deleteShare($uuid);
        return redirect()->to('supperAdmin/manage-shares')->with('success', 'Share deleted successfully');
    }
    public function manageSharesEdit($uuid){
        if ($this->request->getMethod() == 'post') {
            $data = [
                'cost' => $this->request->getVar('cost'),
                'is_verified' => $this->request->getVar('is_verified'),
            ];
            $this->loginActivityModel->updateShare($uuid, $data);
            return redirect()->to('supperAdmin/manage-shares')->with('success', 'Share updated successfully');
        }
        $data = [
            'manageSharesEditTitle' => 'Edit Share',
            'share' => $this->loginActivityModel->getShare($uuid),
        ];
        return view('Modules\SupperAdmin\Views\edit-share', $data);
    }

    public function setCommission(){
        $data = [
            'setCommissionTitle' => 'Set Commission',
            'commissions' => $this->loginActivityModel->findAllRecords(),
        ];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'commission' => [
                    'rules' => 'required|max_length[2]|numeric',
                    'errors' => [
                        'required' => 'Commission is required',
                        'min_length' => 'Commission must be more than 2',
                        'numeric' => 'Commission must be a number',
                    ]
                ],
            ];
            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{

                $commissionData = [
                    'commission' => $this->request->getVar('commission'),
                ];
                $getAllRecords = $this->loginActivityModel->findAllRecords();
                $countRecords = count($getAllRecords);

                if($countRecords == 1){
                    $updateCommission = $this->loginActivityModel->updateCommission($getAllRecords[0]['commission_id'],$commissionData);
                    if($updateCommission) {
                        return redirect()->to('supperAdmin/set_commission')->with('success', 'Commission updated successfully');
                    }else{
                        return redirect()->to('supperAdmin/set_commission')->with('error', 'Commission not updated');
                    }

                }else{
                    $insertCommission = $this->loginActivityModel->insertCommission($commissionData);
                    if($insertCommission) {
                        return redirect()->to('supperAdmin/set_commission')->with('success', 'Commission is set successfully');
                    }else{
                        return redirect()->to('supperAdmin/set_commission')->with('error', 'Commission not set');
                    }
                }
            }
            return redirect()->to('supperAdmin/set_commission')->with('success', 'Commission updated successfully');
        }
        return view('Modules\SupperAdmin\Views\set-commission', $data);
    }

}