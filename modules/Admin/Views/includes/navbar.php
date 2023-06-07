<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a href="#"><img style="height: 50px;" src="<?= base_url('assets/images/logo-hisa.png')  ?>" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="<?= 'notifications' ?>">
                    <i class="mdi mdi-bell-outline" style="position: relative;"></i>
                    <span class="bg-danger" id="notification-count" style="font-size: 12px; height: 20px; width: 20px; display: grid; place-items: center; border-radius: 50%; position: absolute; top: 10px; left: 10px;"></span>
                </a>
            </li>
            <?php if (session()->has('currentLoggedInSacco')): ?>

                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-img">
                            <img src="" alt="image" id="profile-image-go">
                            <span class="availability-status online"></span>
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black"><strong>Sacco </strong><?= session()->get('name'); ?></p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="<?= 'update-account' ?>">
                            <i class="mdi mdi-account-box-outline me-2 text-success"></i> Update Account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= 'change-password' ?>">
                            <i class="mdi mdi-cached me-2 text-success"></i> Change Password </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= 'logout' ?>">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Signout
                        </a>
                    </div>
                </li>
            <?php endif ?>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<!-- partial -->