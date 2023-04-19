<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
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
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-email-outline" style="position: relative;"></i>
                    <span class="bg-warning" style="font-size: 12px; height: 20px; width: 20px; display: grid; place-items: center; border-radius: 50%; position: absolute; top: 10px; left: 16px;">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                    <h6 class="p-3 mb-0">Messages</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                            <p class="text-gray mb-0"> 1 Minutes ago </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>

                    <div class="dropdown-divider"></div>
                    <div class="dropdown-divider"></div>
                    <h6 class="p-3 mb-0 text-center">2 new messages</h6>
                </div>
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

                        <div class="nav-profile-text">
                            <p class="mb-1 text-black"><strong>Sacco </strong><?= session()->get('name'); ?></p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
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