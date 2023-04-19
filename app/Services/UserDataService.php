<?php

namespace App\Services;

use App\Models\DisplayDashboardModel;
use CodeIgniter\Config\BaseService;
use App\Models\SaccoMembership;

class UserDataService extends BaseService
{
    protected $displayDashboardModel;
    protected $saccoMembershp;
    public function __construct()
    {
        $this->displayDashboardModel = new DisplayDashboardModel();
        $this->saccoMembershp = new SaccoMembership();
    }
    public function getUserData()
    {
        $uuid = session()->get('currentLoggedInUser');
        $data['userData'] = $this->displayDashboardModel->getCurrentUserInformation($uuid);
        return $data['userData'];
    }
}
