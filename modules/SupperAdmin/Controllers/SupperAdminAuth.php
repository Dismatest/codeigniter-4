<?php

namespace Modules\SupperAdmin\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use Modules\SupperAdmin\Models\SupperAdmins;

class SupperAdminAuth extends BaseController
{
    public function login()
    {
        $data = [];
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

                $supperAdminModel = new SupperAdmins();
                $user = $supperAdminModel->where('email', $email)->first();

                if (!$user) {
                    session()->setFlashdata('fail', 'Can`t find the user with that email');
                    return redirect()->to(base_url('supperAdmin/login'));
                }

                $passwordCheck = Hash::decrypt($password, $user['password']);
                if (!$passwordCheck) {
                    session()->setFlashdata('fail', 'Password is incorrect');
                    return redirect()->to(base_url('supperAdmin/login'));
                } else {
                    $userId = $user['admin_id'];
                    $sessionData = array(
                        'fname' => $user['fname'],
                        'lname' => $user['lname'],
                        'currentLoggedInUser' => $userId,
                    );
                    session()->set($sessionData);
                    if ($this->request->getPost('remember') == 'on') {
                        setcookie("userId", $userId, time() + (86400 * 30), "/");
                    }
                    return redirect()->to(base_url('supperAdmin/dashboard'));
                }

            }

        }
        return view('Modules\SupperAdmin\Views\login', $data);
    }

    public function register()
    {
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
                $fname = $this->request->getPost('fname');
                $lname = $this->request->getPost('lname');
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $usersData = [
                    'fname' => $fname,
                    'lname' => $lname,
                    'email' => $email,
                    'password' => Hash::encrypt($password)
                ];

                $supperAdminModel = new SupperAdmins();
                $query = $supperAdminModel->insert($usersData);
                if($query){
                    return redirect()->to(base_url('supperAdmin/login'))->with('success', 'Registration Success');
                }else{
                    return redirect()->back()->with('fail', 'Registration Failed');
                }

            }
        }
        return view('Modules\SupperAdmin\Views\register', $data);
    }
    public function logout(){
        if(session()->has('currentLoggedInUser')){
            session()->remove('currentLoggedInUser');
            return redirect()->to('supperAdmin/login')->with('success', 'You have logged out');
        }
    }

}