<!--sidebar partials -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?= 'dashboard' ?>">
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
                    <li class="nav-item"> <a class="nav-link" href="<?= 'register-sacco' ?>">Register Sacco</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= 'manage-sacco' ?>">Manage Saccos</a></li>
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
                    <li class="nav-item"> <a class="nav-link" href="<?= 'list-users' ?>">List Users</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Register User</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= 'manage-users' ?>">Manage Users</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= 'user-log-in-activities' ?>">User Login Activities</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Messages</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
                <span class="menu-title">Notifications</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-title">Transactions</span>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Shares</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-card-details menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= 'approved-shares' ?>"> Approved Shares </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= 'not-approved-shares' ?>"> Not Approved Shares </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= 'manage-shares' ?>"> Manage Shares </a></li>
                </ul>
            </div>
        </li>

    </ul>
</nav>
<!-- partial -->