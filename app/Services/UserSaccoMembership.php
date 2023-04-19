<?php

namespace App\Services;

use CodeIgniter\Config\BaseService;
use App\Models\SaccoMembership;

class UserSaccoMembership extends BaseService
{
    protected $saccoMembershp;
    protected $userDataService;
    public function __construct()
    {
        $this->saccoMembershp = new SaccoMembership();
        $this->userDataService = new UserDataService();
    }

    public function getUserRegistration(){
        $requested_sacco_id = session()->get('request_joining_sacco_id');
        return $this->saccoMembershp->where('user_id', $this->userDataService->getUserData()->user_id)
                ->where('sacco_id', $requested_sacco_id)
                ->countAllResults() == 1;
    }
}
