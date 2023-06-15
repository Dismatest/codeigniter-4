<!--sidebar partials -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url().'/supperAdmin/dashboard' ?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basics" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Sacco's</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basics">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/register-sacco' ?>">Onboard sacco</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/manage-sacco' ?>">Manage Sacco</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basics1" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Shares</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-code-string menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basics1">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/view-shares' ?>"> View Shares</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/view-sold-shares' ?>"> View sold Shares</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/shares-history/statistics' ?>"> Shares History statistics</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#general-pagess" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Transactions</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-table-large menu-icon menu-icon"></i>
            </a>
            <div class="collapse" id="general-pagess">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/view-transactions' ?>"> View Transactions </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-card-details menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/shares-report' ?>"> Shares Report </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/bids-report' ?>"> Bids Report </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/transactions-report' ?>"> Transactions Report </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#general-pages-commission" aria-expanded="false" aria-controls="general-pages-commission">
                <span class="menu-title">Set Commission</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi mdi-cash-multiple menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages-commission">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/set_buyer_commission' ?>"> Buyer's Commission </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/set_seller_commission' ?>"> Seller's Commission </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/set_sacco_commission' ?>"> Sacco's Commission </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#audit_trail" aria-expanded="false" aria-controls="audit_trail">
                <span class="menu-title">Audit Trail</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi mdi-alert-outline menu-icon"></i>
            </a>
            <div class="collapse" id="audit_trail">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/email-audit' ?>"> Email </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/sms-audit' ?>"> SMS </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/user-log-in-activities' ?>"> User's Login Activities </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url().'/supperAdmin/register-new_admin' ?>">
                <span class="menu-title">New Admin</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-settings menu-icon"></i>
            </a>
            <div class="collapse" id="settings">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url().'/supperAdmin/change-password' ?>"> Change Password </a></li>
                    <li class="nav-item"> <a class="nav-link" href=""> Cookies Settings </a></li>
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
                </ul>
            </div>
        </li>
    </ul>
</nav>
<!-- partial -->