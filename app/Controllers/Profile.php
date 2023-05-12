<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\DisplayDashboardModel;

class Profile extends BaseController
{
    public $displayDashboard;
    public function __construct(){
        $this->displayDashboard = new DisplayDashboardModel();
    }
    public function updateProfile()
    {

        $uniid = session()->get('currentLoggedInUser');
        $data['userData'] = $this->displayDashboard->getCurrentUserInformation($uniid);

        if($this->request->getMethod() == 'post'){
            $rules = [
                'fname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required',
                    ]
                ],
                'lname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required',
                    ]
                ],

                'phone' => [
                    'rules' => 'required|regex_match[/^\d{10}$|^\d{3} \d{3} \d{4}$/]',
                    'errors' => [
                        'required' => 'Your phone number is required',
                        'regex_match' => 'Your phone number is not valid',
                    ]
                ],
            ];

            if($this->validate($rules)){
                $fname = $this->request->getVar('fname', FILTER_SANITIZE_STRING);
                $lname = $this->request->getVar('lname', FILTER_SANITIZE_STRING);
                $phone = $this->request->getVar('phone', FILTER_SANITIZE_NUMBER_INT);

                $avatar = $this->request->getFile('avatar');
                if($avatar->isValid() && !$avatar->hasMoved()){
                    $avatarName = $avatar->getRandomName();
                    $avatar->move('./uploads/profile', $avatarName);
                    if($this->displayDashboard->updateAvatar($avatarName, $uniid)){
                        session()->setTempdata('success', 'Profile image updated successfully', 3);
                        return redirect()->to(base_url('dashboard'));
                    }else{
                        session()->setTempdata('fail', 'Sorry, there was an error while updating your profile', 3);
                        return redirect()->to(base_url('dashboard'));
                    }
                }

                if($this->displayDashboard->updateProfile($fname, $lname, $phone, $uniid)){
                    session()->setTempdata('success', 'Profile updated successfully', 3);
                    return redirect()->to(base_url('dashboard'));
                }
                session()->setFlashdata('fail', 'Failed to update profile');
                return redirect()->to(base_url('dashboard'));
            }else{
//
                $data['validation'] = $this->validator;
            }
        }
       return view('update-profile', $data);
    }
}
