<?php

namespace Modules\SupperAdmin\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\Users;
use CodeIgniter\I18n\Time;
use App\Models\LoginActivityModel;
use App\Models\DisplayDashboardModel;
use Ramsey\Uuid\Uuid;

class SupperAdmin extends BaseController
{

    protected $userModel;
    protected $loginActivityModel;
    protected $displayDashboardModel;
    protected $email;

    public function __construct()
    {
        helper(['form', 'url', 'text', 'date']);
        $this->userModel = new Users();
        $this->loginActivityModel = new LoginActivityModel();
        $this->displayDashboardModel = new DisplayDashboardModel();
        $this->email = \Config\Services::email();
    }

    public function dashboard()
    {
        $allUsers = $this->loginActivityModel->findAllUsers();
        $allSacco = $this->loginActivityModel->findAllSaccoCount();
        $allTransactions = $this->loginActivityModel->findAllTransactions();

        $data = [
            'dashboardTitle' => 'Dashboard',
            'allUsers' => $allUsers,
            'allSacco' => $allSacco,
            'allTransactions' => $allTransactions,

        ];
        return view('Modules\SupperAdmin\Views\dashboard', $data);
    }

    //sacco methods
    public function registerSacco()
    {
        $data = [
            'registerSaccoTitle' => 'Register Sacco',
        ];

        if ($this->request->getMethod() == 'post') {

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
                'office' => [
                    'rules' => 'required|max_length[50]',
                    'errors' => [
                        'required' => 'Office is required',
                        'min_length' => 'The maximum length should be 50',
                    ]
                ],
                'website' => [
                    'rules' => 'required|valid_url|max_length[100]',
                    'errors' => [
                        'required' => 'Website is required',
                        'url' => 'A valid url is required',
                        'min_length' => 'The maximum length should be 100',
                    ]
                ],

                'till' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Till number is required',
                        'numeric' => 'Till number should be numeric',
                    ]
                ],

                'phone' => [
                    'rules' => 'required|numeric|max_length[10]',
                    'errors' => [
                        'required' => 'Phone number is required',
                        'numeric' => 'Phone number should be numeric',
                        'min_length' => 'The maximum length should be 10',
                    ]
                ],

            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $name = $this->request->getVar('name');
                $email = $this->request->getVar('email');
                $office = $this->request->getVar('office');
                $website = $this->request->getVar('website');
                $till = $this->request->getVar('till');
                $phone = $this->request->getVar('phone');
                $password = random_string('alnum', 8);
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $saveSacco = [
                    'uuid' => Uuid::uuid4()->toString(),
                    'name' => $name,
                    'email' => $email,
                    'location' => $office,
                    'contact_phone' => $phone,
                    'till' => $till,
                    'website' => $website,
                    'password' => $hashedPassword,
                ];
                $message = "<br/> The sacco account was created successfully, please find your default password bellow, and please ensure you updated the password through the sacco admin dashboard.<br/><br/>" . $password;

                $insert = $this->loginActivityModel->registerSacco($saveSacco);
                if ($insert) {
                    if ($this->sendEmail($name, $email, $message)) {
                        return redirect()->to('supperAdmin/dashboard')->with('success', 'The login password has been sent to the sacco through email');
                    } else {
                        return redirect()->to('supperAdmin/dashboard')->with('error', 'There was an error sending the password to the sacco');
                    }
                } else {
                    return redirect()->to('supperAdmin/dashboard')->with('error', 'Sacco was registered, however, password was not sent');
                }
            }

        }
        return view('Modules\SupperAdmin\Views\register-sacco', $data);
    }

    public function sendEmail($name, $email, $message)
    {
        $this->email->setFrom('billclintonogot88@gmail.com', 'Sacco Hisa Admin');
        $this->email->setTo("$email");

        $this->email->setSubject('Login Password');

        $email_template = view('Modules\SupperAdmin\Views\sacco\email-template', [
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

    public function manageSacco()
    {
        $data = [
            'manageSaccoTitle' => 'Manage Sacco',
            'sacco' => $this->loginActivityModel->findAllSacco(),

        ];
        return view('Modules\SupperAdmin\Views\manage-sacco', $data);
    }

    public function manageSaccoDelete($uuid)
    {
        $sacco = $this->loginActivityModel->deleteSacco($uuid);
        if ($sacco) {
            return redirect()->to('supperAdmin/manage-sacco')->with('success', 'Sacco deleted successfully');
        } else {
            return redirect()->to('supperAdmin/manage-sacco')->with('error', 'Sacco not deleted');
        }
    }

    public function manageSaccoEdit($uuid)
    {
        $data = [
            'manageSaccoTitle' => 'Manage Sacco',
            'sacco' => $this->loginActivityModel->findSacco($uuid),
        ];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'phone' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Phone number is required',
                        'numeric' => 'Phone number should be numeric',
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
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => 'Website is required',
                        'min_length' => 'The maximum length should be 100',
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
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                $phone = $this->request->getVar('phone');
                $location = $this->request->getVar('office');
                $website = $this->request->getVar('website');
                $till = $this->request->getVar('till');

                $updateSacco = [
                    'contact_phone' => $phone,
                    'location' => $location,
                    'website' => $website,
                    'till' => $till,
                ];

                $sacco = $this->loginActivityModel->updateSacco($uuid, $updateSacco);
                if ($sacco) {
                    session()->setFlashdata('success', 'Sacco updated successfully');
                    return redirect()->to('supperAdmin/manage-sacco');
                } else {
                    session()->setFlashdata('error', 'There was an error in updating sacco');
                    return redirect()->to('supperAdmin/manage-sacco');
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

    public function manageUsers()
    {
        $data = [
            'users' => $this->userModel->findAll(),
        ];

        return view('Modules\SupperAdmin\Views\manage-users', $data);
    }

    public function manageUsersDelete($uniid)
    {
        $user = $this->userModel->where('uniid', $uniid)->delete();
        if ($user) {
            return redirect()->to('supperAdmin/manage-users')->with('success', 'User deleted successfully');
        } else {
            return redirect()->to('supperAdmin/manage-users')->with('error', 'User not deleted');
        }
    }

    public function manageUsersEdit($uniid)
    {

        $data = [
            'editUserTitle' => 'Edit User',
            'users' => $this->userModel->where('uniid', $uniid)->first(),
        ];

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
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                $userInfo = [
                    'fname' => $this->request->getVar('fname'),
                    'lname' => $this->request->getVar('lname'),
                    'phone' => $this->request->getVar('phone'),
                    'email' => $this->request->getVar('email'),
                    'activation_status' => $this->request->getVar('activation_status'),
                ];
                $user = $this->userModel->where('uniid', $uniid)->set($userInfo)->update();
                if ($user) {
                    return redirect()->to('supperAdmin/manage-users')->with('success', 'User updated successfully');
                } else {
                    return redirect()->to('supperAdmin/manage-users')->with('error', 'User not updated');
                }
            }

        }
        return view('Modules\SupperAdmin\Views\manage-users-edit', $data);
    }

    public function userLogInActivities()
    {
        $data = [
            'userLogInActivitiesTitle' => 'User Log In Activities',
            'users' => $this->loginActivityModel->getAllLoginActivities(),
        ];

        return view('Modules\SupperAdmin\Views\user-log-in-activities', $data);
    }

    public function userLogInActivitiesDelete($id)
    {
        $this->loginActivityModel->deleteActivity($id);
        return redirect()->to('supperAdmin/user-log-in-activities')->with('success', 'User log deleted successfully');
    }


    //shares methods
    public function approvedShares()
    {

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

    public function notApprovedShares()
    {
        $users = $this->loginActivityModel->findAllNotAprovedShares();
        $data = [
            'notApprovedSharesTitle' => 'Not Approved Shares',
            'users' => $users,
        ];
        return view('Modules\SupperAdmin\Views\not-approved-shares', $data);
    }

    public function approveShare($uuid)
    {
        $this->loginActivityModel->approveShare($uuid);
        return redirect()->to('supperAdmin/approved-shares')->with('success', 'Share approved successfully');
    }

    public function rejectedShares(){
        $rejectedShares = $this->loginActivityModel->findAllRejectedShares();
        $data = [
            'rejectedSharesTitle' => 'Rejected Shares',
            'rejectedShares' => $rejectedShares,
        ];
        return view('Modules\SupperAdmin\Views\rejected-shares', $data);
    }

    public function manageShares()
    {
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
        return view('Modules\SupperAdmin\Views\manage-shares', $data);
    }

    public function manageSharesDelete($uuid)
    {
        $this->loginActivityModel->deleteShare($uuid);
        return redirect()->to('supperAdmin/manage-shares')->with('success', 'Share deleted successfully');
    }

    public function manageSharesEdit($uuid)
    {
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

    public function setCommissionAjax()
    {

        $commissionData = [
            'commission' => $this->request->getPost('buyerCommission'),
        ];
        $getAllRecords = $this->loginActivityModel->findAllRecords();
        $countRecords = count($getAllRecords);

        if ($countRecords == 1) {
            $updateCommission = $this->loginActivityModel->updateCommission($getAllRecords[0]['commission_id'], $commissionData);
            if ($updateCommission) {
                $response = [
                    'status' => 200,
                    'message' => 'Commission updated successfully',
                ];
                return $this->response->setJSON($response);
            } else {
                $response = [
                    'status' => 500,
                    'message' => 'Commission not updated',
                ];
                return $this->response->setJSON($response);
            }

        } else {
            $insertCommission = $this->loginActivityModel->insertCommission($commissionData);
            if ($insertCommission) {
                $response = [
                    'status' => 200,
                    'message' => 'Commission set successfully',
                ];
                return $this->response->setJSON($response);
            } else {
                $response = [
                    'status' => 500,
                    'message' => 'Commission not set, try again',
                ];
                return $this->response->setJSON($response);
            }
        }

    }

    public function getBuyerCommissionAjax()
    {
        $getAllRecords = $this->loginActivityModel->findAllRecords();
        $response = [
            'status' => 200,
            'data' => $getAllRecords,
        ];
        return $this->response->setJSON($response);
    }

    public function getBuyerCommissionByIdAjax()
    {
        $commission_id = $this->request->getVar('commission_id');
        $getCommission = $this->loginActivityModel->getCommissionById($commission_id);
        $response = [
            'status' => 200,
            'data' => $getCommission,
        ];
        return $this->response->setJSON($response);
    }

    public function updateBuyerCommissionByIdAjax()
    {

        $commission_id = $this->request->getPost('commissionId');
        $commission = $this->request->getPost('buyerCommission');
        $updateCommission = $this->loginActivityModel->updateCommission($commission_id, $commission);
        if ($updateCommission) {
            $response = [
                'status' => 200,
                'message' => 'Commission updated successfully',
            ];
            return $this->response->setJSON($response);
        } else {
            $response = [
                'status' => 500,
                'message' => 'An error has occurred, try again',
            ];
            return $this->response->setJSON($response);
        }
    }

    public function deleteBuyerCommissionByIdAjax()
    {
        $commission_id = $this->request->getPost('commission_id');
        $deleteCommission = $this->loginActivityModel->deleteCommission($commission_id);
        if ($deleteCommission) {
            $response = [
                'status' => 200,
                'message' => 'Commission deleted successfully',
            ];
            return $this->response->setJSON($response);
        } else {
            $response = [
                'status' => 500,
                'message' => 'An error has occurred, try again',
            ];
            return $this->response->setJSON($response);
        }
    }


//    setting commission

    public function setBuyerCommission(){
        $data = [
            'setBuyerCommissionTitle' => 'Set Buyer Commission',
            'commissions' => $this->loginActivityModel->findAllRecords(),
        ];
        return view('Modules\SupperAdmin\Views\set-buyer-commission', $data);
    }

    public function setSaccoCommission(){
        $data = [
            'setCommissionTitle' => 'Set Sacco Commission',
            'saccos' => $this->loginActivityModel->getAllSacco(),
        ];
        return view('Modules\SupperAdmin\Views\set-sacco-commission', $data);
    }

    public function auditTrail()
    {
        $data = [
            'auditTrailTitle' => 'Audit Trail',
            'auditTrails' => $this->loginActivityModel->findAllAuditTrail(),
        ];

        return view('Modules\SupperAdmin\Views\audit-trail', $data);
    }

    public function auditTrailDelete($error_id)
    {
        $error = $this->loginActivityModel->deleteAuditTrail($error_id);
        if ($error) {
            return redirect()->to('supperAdmin/audit_trail')->with('success', 'Audit trail deleted successfully');
        } else {
            return redirect()->to('supperAdmin/audit_trail')->with('fail', 'Audit trail not deleted');
        }
    }

    public function viewTransactions()
    {
        $supperAdmin_id = session()->get('currentLoggedInUser');
        $data = [
            'viewTransactionsTitle' => 'View Transactions',
            'viewTransactions' => $this->loginActivityModel->viewTransactions($supperAdmin_id),
        ];

        return view('Modules\SupperAdmin\Views\view-transactions', $data);
    }

    public function pendingTransactions()
    {
        $supperAdmin_id = session()->get('currentLoggedInUser');
        $data = [
            'viewTransactionsTitle' => 'View Transactions',
            'viewTransactions' => $this->loginActivityModel->pendingTransactions($supperAdmin_id),
        ];

        return view('Modules\SupperAdmin\Views\view-pending-transactions', $data);
    }

    public function setSaccoCommissionAjax()
    {
        $sacco_id = $this->request->getPost('saccoId');
        $commission = $this->request->getPost('saccoCommission');

        $setCommission = $this->loginActivityModel->insertSaccoCommission($sacco_id, $commission);
        if($setCommission) {
            $updateCommission = $this->loginActivityModel->updateSaccoCommission($sacco_id);
            if($updateCommission){
                $response = [
                    'status' => 200,
                    'message' => 'Commission set successfully',
                ];
                return $this->response->setJSON($response);
            }
        } else {
            $response = [
                'status' => 500,
                'message' => 'Commission not set, try again',
            ];
            return $this->response->setJSON($response);
        }
    }

    public function getSaccoCommissionAjax(){
        $getAllSaccoCommission = $this->loginActivityModel->getAllSaccoCommission();
        $response = [
            'status' => 200,
            'data' => $getAllSaccoCommission,
        ];
        return $this->response->setJSON($response);
    }

    public function getSaccoCommissionByIdAjax(){
        $sacco_id = $this->request->getVar('saccoCommissionId');
        $getSaccoCommission = $this->loginActivityModel->getSaccoCommissionById($sacco_id);
        $response = [
            'status' => 200,
            'data' => $getSaccoCommission,
        ];
        return $this->response->setJSON($response);
    }

    public function updateSaccoCommissionByIdAjax(){
        $sacco_id = $this->request->getPost('saccoCommissionId');
        $commission = $this->request->getPost('saccoCommission');

        $updateSaccoCommission = $this->loginActivityModel->updateSaccoCommissionById($sacco_id, $commission);
        log_message('info', $updateSaccoCommission);
        if($updateSaccoCommission){
            $response = [
                'status' => 200,
                'message' => 'Commission updated successfully',
            ];
            return $this->response->setJSON($response);
        } else {
            $response = [
                'status' => 500,
                'message' => 'An error has occurred, try again',
            ];
            return $this->response->setJSON($response);
        }

    }

    public function deleteSaccoCommissionByIdAjax(){
        $sacco_commission_id = $this->request->getPost('saccoCommissionId');
        $sacco_id = $this->request->getPost('saccoId');

        $deleteSaccoCommission = $this->loginActivityModel->deleteSaccoCommissionById($sacco_commission_id);
        if($deleteSaccoCommission){
            $updateSaccoCommission = $this->loginActivityModel->updateSaccoCommissionOnDeletion($sacco_id);
            if($updateSaccoCommission){
                $response = [
                    'status' => 200,
                    'message' => 'Commission deleted successfully',
                ];
                return $this->response->setJSON($response);
            }
        } else {
            $response = [
                'status' => 500,
                'message' => 'An error has occurred, try again',
            ];
            return $this->response->setJSON($response);
        }
    }

    public function setSellerCommission(){
        $data = [
            'setSellerCommission' => 'Set Seller Commission',
        ];
        return view('Modules\SupperAdmin\Views\set-seller-commission', $data);
    }

    public function registerNewAdmin(){
        $data = [];
        if ($this->request->getMethod() == 'post'){
            $rules = [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|valid_email|is_unique[users.email]',
            ];
            if (!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $fname = $this->request->getPost('fname');
                $lname = $this->request->getPost('lname');
                $email = $this->request->getPost('email');
                $password = $this->generateRandomPassword(8);
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $registrationData = [
                    'fname' => $fname,
                    'lname' => $lname,
                    'email' => $email,
                    'password' => $hashedPassword,
                ];

                $message = "<br/> The sacco account was created successfully, please find your default password bellow, and please ensure you updated the password through the sacco admin dashboard.<br/><br/>" . $password;
                $registerNewAdmin = $this->loginActivityModel->registerNewAdmin($registrationData);
                if($registerNewAdmin) {
                    if ($this->sendEmail($fname, $email, $message)) {
                        return redirect()->to('supperAdmin/dashboard')->with('success', 'The login password has been sent to the '. $fname .' through email');
                    } else {
                        return redirect()->to('supperAdmin/register-new_admin')->with('error', 'There was an error sending the password to the '. $fname .' through email');
                    }
                }
            }
        }

        return view('Modules\SupperAdmin\Views\register-new-admin', $data);
    }

    public function changePassword(){
        $data = [];
        if($this->request->getMethod() == 'post'){
            $rules = [
                'old-pass' => 'required',
                'new-pass' => 'required|min_length[8]',
                'conf-new-pass' => 'required|matches[new-pass]',
            ];
            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            } else {
               $oldPassword = $this->request->getPost('old-pass');
               $newPassword = $this->request->getPost('new-pass');

               $currentLoggedInUser = session()->get('currentLoggedInUser');
               $adminPassword = $this->loginActivityModel->getAdminPassword($currentLoggedInUser);
               $passwordCheck = Hash::decrypt($oldPassword, $adminPassword['password']);
               if($passwordCheck){
                   $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                   $updatePassword = $this->loginActivityModel->updatePassword($currentLoggedInUser, $hashedPassword);
                   if($updatePassword){
                       return redirect()->to('supperAdmin/dashboard')->with('success', 'Password updated successfully');
                   } else {
                       return redirect()->to('supperAdmin/change-password')->with('error', 'There was an error updating the password, try again');
                   }
               } else {
                   session()->setFlashdata('fail', 'Old password is incorrect');
                   return redirect()->to('supperAdmin/change-password');
               }
            }
        }
        return view('Modules\SupperAdmin\Views\change-password', $data);
    }

    public function generateRandomPassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+=-';
        $password = '';

        for ($i = 0; $i < $length; $i++) {
            $index = random_int(0, strlen($chars) - 1);
            $password .= $chars[$index];
        }

        return $password;
    }

}