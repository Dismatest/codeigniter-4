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
                    <li class="nav-item"> <a class="nav-link" href="<?= 'price_per_share' ?>">Set Price Per Share</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= 'manage-shares' ?>">Shares on Sale</a></li>
                </ul>
            </div>

        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= 'reports' ?>">
                <span class="menu-title">Reports</span>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Members</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= 'new-members' ?>">Approve New Members </a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= 'manage-users' ?>""> Manage Members </a></li>
                </ul>
            </div>
        </li>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= 'upload_files'?>">
                <span class="menu-title">Legal files</span>
                <i class="mdi mdi-arrange-bring-forward menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= 'new_user' ?>">
                <span class="menu-title">New User</span>
                <i class="mdi mdi-account-circle menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- partial -->