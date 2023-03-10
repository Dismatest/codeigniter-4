<?php
namespace Modules\Admin\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use Modules\Admin\Models\SaccoModels;
use App\Models\Notification;
use App\Models\Users;

class Admin extends BaseController
{
    public $adminModel;
    public $notificationModel;
    public $userModel;
    public function __construct()
    {
        $this->adminModel = new SaccoModels();
        $this->notificationModel = new Notification();
        $this->userModel = new Users();
    }

    public function dashboard()
    {
        $data['dashboardTitle'] = 'Admin Dashboard';
        $uuid = session()->get('currentLoggedInSacco');
        $data['saccoData'] = $this->adminModel->getCurrentSaccoInformation($uuid);
        return view('Modules\Admin\Views\dashboard', $data);
    }

    public function notifications()
    {
        $userID = session()->get('currentLoggedInSacco');
        $sacco_id = $this->adminModel->getCurrentSaccoInformation($userID);
        $allNotifications = $this->notificationModel->where('sacco_id', $sacco_id['sacco_id'])
            ->where('read_status', 0)
            ->findAll();

        session()->set('notifications', $allNotifications);
        $data = [
            'notificationsTitle' => 'Notifications',
            'notifications' => $allNotifications,
        ];
        return view('Modules\Admin\Views\notifications', $data);
    }

    public function deleteNotification($id)
    {
        $this->notificationModel->delete($id);
        return redirect()->to('admin/notifications');
    }

    public function readNotification($id)
    {
        $data = [
            'read_status' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->notificationModel->update($id, $data);
        return redirect()->to('admin/notifications');
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

    public function verifyShares($id=null){
        $shares = $this->adminModel->verifyShares($id);
        if($shares){
            return redirect()->to('admin/manage-shares')->with('success', 'Shares verified successfully');
        }else{
           return redirect()->to('admin/manage-shares')->with('fail', 'Shares verification failed');
        }
    }
    public function deleteShares($id=null){
        $shares = $this->adminModel->deleteShares($id);
        if($shares){
            return redirect()->to('admin/manage-shares')->with('success', 'Shares deleted successfully');
        }else{
           return redirect()->to('admin/manage-shares')->with('fail', 'Shares deletion failed');
        }
    }

    // all the sacco admin users methods
    public function manageUsers(){
        $data = [];
        $users = $this->adminModel->manageUsers();
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

    public function updateUserShares($id){
        if($this->request->getMethod() == 'post'){
            $data = [
                'shares_amount' => $this->request->getPost('sharesAmount'),
            ];
            $save = $this->adminModel->updateUserShares($id, $data);
            if($save){
                return redirect()->to('admin/manage-users')->with('success', 'Shares updated successfully');
            }else{
                return redirect()->to('admin/manage-users')->with('fail', 'Shares update failed');
            }
        }
        $this->adminModel->updateUserShares($id);
    }
    public function deleteUserShares($id){
        $shares = $this->adminModel->deleteUserShares($id);
        if($shares){
            return redirect()->to('admin/manage-users')->with('success', 'Shares deleted successfully');
        }else{
           return redirect()->to('admin/manage-users')->with('fail', 'Shares deletion failed');
        }
    }

    public function addUserShares(){
        $data = [];
        $users = $this->userModel->select('users.*, sacco_membership.is_approved')
            ->join('sacco_membership', 'sacco_membership.user_id = users.user_id')
            ->where('sacco_membership.is_approved', 1)
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
        if(!$this->validate($rules)) {
            $data['validation'] = $this->validator;
        }else{
            $data = [
                'user_id' => $this->request->getPost('selectCustomerName'),
                'sacco_id' => $sacco['sacco_id'],
                'membership_number' => $this->request->getPost('membershipNumber'),
                'shares_amount' => $this->request->getPost('sharesAmount'),
                'cost_per_share' => $this->request->getPost('cost'),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $save = $this->adminModel->addUserShares($data);
            if($save){
                return redirect()->to('admin/add-user-shares')->with('success', 'Shares added successfully');
            }else{
                return redirect()->to('admin/add-user-shares')->with('fail', 'Shares addition failed');
            }
        }
        $data = [
            'users' => $users,
            'sacco' => $sacco['name'],
        ];
        return view('Modules\Admin\Views\add-user-shares', $data);
    }
    public function newMembers(){
        $newMembers = $this->adminModel->findAllNewMembers();
        $data = [
            'newMembers' => $newMembers,
        ];
        return view('Modules\Admin\Views\new-members', $data);
    }

    public function approveMemberRequest($id){
        $approve = $this->adminModel->approveMemberRequest($id);
        if($approve){
            return redirect()->to('admin/new-members')->with('success', 'Member approved successfully');
        }else{
            return redirect()->to('admin/new-members')->with('fail', 'Member approval failed');
        }
    }

    public function deleteMemberRequest($id){
        $delete = $this->adminModel->deleteMemberRequest($id);
        if($delete){
            return redirect()->to('admin/new-members')->with('success', 'Request deleted successfully');
        }else{
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
                    $saccoId = $sacco['uuid'];
                    $sessionData = array(
                        'name' => $sacco['name'],
                        'currentLoggedInSacco' => $saccoId,
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
        if(session()->has('currentLoggedInSacco')) {
            session()->remove('currentLoggedInSacco');
            return redirect()->to('admin/login');
        }

    }
}