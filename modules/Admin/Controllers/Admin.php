<?php
namespace Modules\Admin\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use Modules\Admin\Models\SaccoModels;
use App\Models\Notification;

class Admin extends BaseController
{
    public $adminModel;
    public $notificationModel;
    public function __construct()
    {
        $this->adminModel = new SaccoModels();
        $this->notificationModel = new Notification();
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
   public function manageShares()

    {
        $shares = $this->adminModel->manageShares();
        $data = [
            'manageShearsTitle' => 'Manage Shares',
            'users' => $shares,
        ];
        dd($shares);
        return view('Modules\Admin\Views\manage-shears', $data);
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