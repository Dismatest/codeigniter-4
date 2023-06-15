<?php

namespace Modules\SupperAdmin\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use Modules\SupperAdmin\Models\SupperAdmins;
use Ramsey\Uuid\Uuid;
use App\Models\LoginActivityModel;

class SupperAdminAuth extends BaseController
{
    protected $loginActivityModel;
    protected $email;

    public function __construct()
    {
        helper(['form', 'url', 'text', 'date']);
        $this->loginActivityModel = new LoginActivityModel();
        $this->email = \Config\Services::email();
    }

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
                    session()->setFlashdata('error', 'Incorrect email or password, please try again');
                    return redirect()->to(base_url('/supperAdmin/login'));
                }

                $passwordCheck = Hash::decrypt($password, $user['password']);
                if (!$passwordCheck) {
                    session()->setFlashdata('error', 'Incorrect password or email, please try again');
                    return redirect()->to(base_url('/supperAdmin/login'));
                } else {
                    $userId = $user['admin_id'];
                    $sessionData = array(
                        'fname' => $user['fname'],
                        'lname' => $user['lname'],
                        'email' => $user['email'],
                        'currentLoggedInUser' => $userId,
                    );
                    session()->set($sessionData);

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
                'email' => [
                    'rules' => 'required|valid_email|is_unique[supperAdmins.email]',
                    'errors' => [
                        'required' => 'Your email is required',
                        'valid_email' => 'A valid email address is required',
                        'is_unique' => 'Email already exists',
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
                $fname = $this->request->getPost('fname');
                $lname = $this->request->getPost('lname');
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $usersData = [
                    'uuid' => Uuid::uuid4()->toString(),
                    'fname' => $fname,
                    'lname' => $lname,
                    'email' => $email,
                    'password' => Hash::encrypt($password),
                ];

                $supperAdminModel = new SupperAdmins();
                $query = $supperAdminModel->insert($usersData);
                if ($query) {
                    return redirect()->to(base_url('supperAdmin/login'))->with('success', 'Registration Success');
                } else {
                    return redirect()->back()->with('fail', 'Registration Failed');
                }

            }
        }
        return view('Modules\SupperAdmin\Views\register', $data);
    }

    public function forgetPassword()
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
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $email = $this->request->getPost('email');
                $validateEmail = $this->loginActivityModel->checkAdminEmail($email);
                if (!empty($validateEmail)) {
                    $updateResetTime = $this->loginActivityModel->updateResetTime($validateEmail['uuid']);
                    if ($updateResetTime) {
                        $subject = 'Password Reset Link';
                        $message = "<br/>This email contains your password reset link. click the link now to change your password, the link expires within 39min " . anchor(base_url('supperAdmin/password-reset-link/' . $validateEmail['uuid']), ' reset password link');
                        if (service('sendEmail')->send_email($validateEmail['fname'], $validateEmail['email'], $subject, $message)) {
                            $email_logs = [
                                'uuid' => Uuid::uuid4()->toString(),
                                'fname' => $validateEmail['fname'] . ' ' . $validateEmail['lname'],
                                'email' => $validateEmail['email'],
                                'message_title' => $subject,
                                'role' => 'supperAdmin',
                                'status' => '1',
                            ];

                            $this->loginActivityModel->insertEmailLogs($email_logs);
                            session()->setFlashdata('success', 'Password reset link has been sent to your email');
                            return redirect()->to(base_url('supperAdmin/forget-password'));
                        } else {
                            $email_logs = [
                                'uuid' => Uuid::uuid4()->toString(),
                                'fname' => $validateEmail['fname'] . ' ' . $validateEmail['lname'],
                                'email' => $validateEmail['email'],
                                'message_title' => $subject,
                                'role' => 'supperAdmin',
                                'status' => '0',
                            ];

                            $this->loginActivityModel->insertEmailLogs($email_logs);
                            session()->setFlashdata('error', 'Failed to send password reset link');
                            return redirect()->to(base_url('supperAdmin/forget-password'));
                        }
                    } else {
                        session()->setFlashdata('error', 'We could not update your reset time, please try again');
                        return redirect()->to(base_url('supperAdmin/forget-password'));
                    }
                } else {
                    session()->setFlashdata('error', 'Email does not exist');
                    return redirect()->to(base_url('supperAdmin/forget-password'));
                }
            }
        }
        return view('Modules\SupperAdmin\Views\forget-password', $data);
    }

    public function resetPassword($uuid = null)
    {
        $data = [];
        if (!empty($uuid)) {
            $verifyUuid = $this->loginActivityModel->verifyUuid($uuid);
            if ($verifyUuid) {
                if ($this->expiryTime($verifyUuid['updated_at'])) {
                    if ($this->request->getMethod() == 'post') {
                        $rules = [
                            'password' => [
                                'rules' => 'required|min_length[5]|max_length[20]',
                                'errors' => [
                                    'required' => 'Your password is required',
                                    'min_length' => 'The length of password must be more than five',
                                    'max_length' => 'The maximum password length must be less than twenty',
                                ]
                            ],
                            'conf-password' => [
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
                            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
                            $updatePassword = $this->loginActivityModel->updateAdminPassword($uuid, $password);
                            if ($updatePassword) {
                                session()->setFlashdata('success', 'Password reset successfully');
                                return redirect()->to(base_url('supperAdmin/login'));
                            } else {
                                session()->setFlashdata('error', 'Failed to reset password');
                                return redirect()->to(base_url('supperAdmin/reset-password/' . $uuid));
                            }
                        }
                    }
                }
            }
        }
        return view('Modules\SupperAdmin\Views\reset-password', $data);
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

    public function logout()
    {
        if (session()->has('currentLoggedInUser')) {
            session()->remove('currentLoggedInUser');
            return redirect()->to('supperAdmin/login')->with('success', 'You have logged out');
        }
    }

}