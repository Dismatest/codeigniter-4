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
                <span class="menu-title">Shares</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>

            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/create_share') ?>">Sell Shares</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/notifications') ?>">Pending Approval</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/manage-shares-on-sale') ?>">Shares on Sale</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/view-sold-shares') ?>">Shares sold</a></li>
                </ul>
            </div>

        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basics" aria-expanded="false" aria-controls="ui-basics">
                <span class="menu-title">Transactions</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>

            <div class="collapse" id="ui-basics">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/view-transactions') ?>"> View Transactions </a></li>
                </ul>
            </div>

        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basics1" aria-expanded="false" aria-controls="ui-basics1">
                <span class="menu-title">Report</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-convert menu-icon"></i>
            </a>

            <div class="collapse" id="ui-basics1">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/bids-report')?>"> Bids Report</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/members-report')?>"> Members Report </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/commission-report')?>"> Commission Report </a></li>
                </ul>
            </div>

        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Members</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/manage-new-users') ?>""> Manage Members </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= 'new_user' ?>">
                <span class="menu-title">Register member</span>
                <i class="mdi mdi-account-circle menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= 'upload_files'?>">
                <span class="menu-title">Terms & conditions</span>
                <i class="mdi mdi-arrange-bring-forward menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- partial -->