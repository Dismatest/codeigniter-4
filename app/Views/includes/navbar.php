<nav class="navbar navbar-expand-lg pb-5 pt-5">
    <header>
        <a href="<?= base_url('/') ?>" class='logo'>
            <img src="<?= base_url('assets/images/logo-hisa.png') ?>" alt="Hisa Logo" style="height: 50px;">
        </a>
        <nav class="navbar2">
            <div class="btn1">
                <i class="fas fa-circle-xmark close-btn-x"></i>
            </div>

            <?php if (session()->has('currentLoggedInUser')) : ?>
                <a href="<?= base_url('notifications') ?>"><i class="fas fa-bell fa-fw fa-sm m-2"></i>Notifications</a>
                <a href="<?= base_url('sell-now') ?>"><i class="fas fa-circle-plus fa-fw fa-sm m-2"></i>Sell Shares</a>
                <a href="<?= base_url('index') ?>"><i class="fas fa-hand-holding-dollar fa-fw fa-sm m-2"></i>Buy Shares</a>
                <a href="<?= base_url('my_bids') ?>" style="position: relative;"><i
                        class="fas fa-chess-king fa-fw fa-sm m-2"></i>My Bids

                    <?php if (session()->has('sellers_received_bids')) : ?>

                            <?php if (session()->get('sellers_received_bids') > 0) : ?>
                            <span class="bg-warning nav-my-bids">
                                <?= session()->get('sellers_received_bids') ?>
                                   </span>
                            <?php endif; ?>

                    <?php endif; ?>
                    <?php if (session()->has('buyers_received_bids')) : ?>

                        <?php if (session()->get('buyers_received_bids') > 0) : ?>
                            <span class="bg-warning nav-my-bids">
                            <?= session()->get('buyers_received_bids') ?>
                            </span>
                        <?php endif; ?>

                    <?php endif; ?>

                </a>
                <a href="<?= base_url('profile') ?>"><i class="fas fa-user fa-fw fa-sm m-2"></i>My Account</a>

            <?php else: ?>
                <a href="<?= base_url('register') ?>"><i class="fas fa-grip fa-fw fa-sm m-2"></i>About Us</a>
                <a href="<?= base_url('register') ?>"><i class="fas fa-circle-user fa-fw fa-sm m-2"></i>Register</a>
                <a href="<?= base_url('login') ?>"><i class="fas fa-arrow-right-from-bracket fa-fw fa-sm m-2"></i>Login</a>
            <?php endif; ?>
        </nav>
        <div class="btn1">
            <i class="fas fa-bars menu-btn"></i>
        </div>
    </header>
</nav>