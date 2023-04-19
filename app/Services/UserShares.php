<?php

namespace App\Services;

use CodeIgniter\Config\BaseService;
use App\Models\DisplayDashboardModel;

class UserShares extends BaseService
{
    protected $displayDashboardModel;

    public function __construct()
    {
        $this->displayDashboardModel = new DisplayDashboardModel();
    }

    public function getUserShares(){
        $sacco_id = '';
        $membership_number = '';
        $userShares = $this->displayDashboardModel->getUserShares();
        if($userShares) {

            foreach ($userShares as $share) {
                $sacco_id = $share['sacco_id'];
                $membership_number = $share['membership_number'];
            }

            return array(
                'sacco_id' => $sacco_id,
                'membership_number' => $membership_number
            );
        }else{
            return array();
        }

    }
}
