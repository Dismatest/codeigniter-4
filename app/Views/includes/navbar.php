
<nav class="navbar navbar-expand-lg pb-5 pt-5">
    <header>
        <a href="<?= base_url().'/welcome_page' ?>" class='logo'>Shares</a>
        <nav class="navbar2">
            <div class="btn">
                <i class="fa fa-times close-btn"></i>
            </div>

            <?php if (session()->has('currentLoggedInUser')) : ?>
                <a href="<?= base_url().'/welcome_page' ?>"><i class="fas fa-bell fa-fw fa-sm m-2"></i>Notifications</a>
                <a href="<?= base_url().'/sell-now' ?>"><i class="fas fa-circle-plus fa-fw fa-sm m-2"></i>Sell</a>
                <a href="<?= base_url().'/my_bids' ?>"><i class="fas fa-chess-king fa-fw fa-sm m-2"></i>My Bids</a>
                <a href="<?= base_url().'/profile' ?>"><i class="fas fa-user fa-fw fa-sm m-2"></i>Profile</a>

            <?php else: ?>
                <a href="<?= base_url().'/register' ?>"><i class="fas fa-circle-user"></i>Register</a>
                <a href="<?= base_url('/') ?>"><i class="fas fa-arrow-right-from-bracket"></i>Login</a>
            <?php endif; ?>
        </nav>
        <div class="btn">
            <i class="fas fa-bars menu-btn"></i>
        </div>
    </header>
 </nav>