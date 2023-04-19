<?php

namespace App\Services;

use App\Models\DisplayDashboardModel;
use CodeIgniter\Config\BaseService;

class IsApproved extends BaseService
{
    protected $displayDashboard;
    public function __construct()
    {
        $this->displayDashboard = new DisplayDashboardModel();
    }
    public function getIsApprovedShares()
    {
        return $this->displayDashboard->is_Verified();
    }
}
