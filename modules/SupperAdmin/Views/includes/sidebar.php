<!--sidebar partials -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url().'/dashboard' ?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Saccos</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/register-sacco' ?>">Onboard sacco</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/manage-sacco' ?>">Manage Sacco</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/list-users' ?>">List Users</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Register User</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/manage-users' ?>">Manage Users</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/user-log-in-activities' ?>">User Login Activities</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="">
                <span class="menu-title">Notifications</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">
                <span class="menu-title">Transactions</span>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Shares Report</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-card-details menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/approved-shares' ?>"> Approved Shares </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/not-approved-shares' ?>"> Not Approved Shares </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url()."/supperAdmin/set_commission"?>">
                <span class="menu-title">Set Commission</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">
                <span class="menu-title">New Admin</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
        </li>

    </ul>
</nav>
<!-- partial -->