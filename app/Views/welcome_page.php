<?= $this->extend("client_base/base.php"); ?>
<?= $this->section('content'); ?>

    <div class="load"></div>
    <div class="main-container">
    <div class="welcome-navbar">
    <img src="<?= 'assets/images/logo-hisa.png' ?>" class="logo">
    <div>
<?php if (session()->has('currentLoggedInUser')) : ?>
    <a class="welcome-button" href="<?= 'login' ?>">LogOut</a>
<?php else : ?>
    <a class="welcome-button" href="<?= 'login' ?>">Login</a>
    <a class="welcome-button" href="<?= 'register' ?>">Sign Up</a>
<?php endif; ?>
    </div>
    </div>
    <div class="content">
        <small>Welcome to our,</small>
        <h1 class="welcome-heading">Sacco <br>Hisa Shares Portal</h1>
        <p class="welcome-description">We help you buy or sell your share capital at the comfort of our phone</p>
        <a class="welcome-button" href="<?= 'index' ?>">Buy Shares</>
        <a class="welcome-button" href="<?= 'sell-now' ?>">Sell Shares</a>
    </div>

    <div class="side-bar">
        <img src="<?= 'assets/images/logo-hisa.png' ?>" alt="" class="menu">
    </div>

    <div class="bubbles">
        <img src="<?= 'assets/images/R.png' ?>">
        <img src="<?= 'assets/images/R.png' ?>">
        <img src="<?= 'assets/images/R.png' ?>">
        <img src="<?= 'assets/images/R.png' ?>">
        <img src="<?= 'assets/images/R.png' ?>">
        <img src="<?= 'assets/images/R.png' ?>">
        <img src="<?= 'assets/images/R.png' ?>">
    </div>

    </div>
    <div class="moving-text-container">
        <div class="moving-text">

            <?php if (!empty($activeShares)) : ?>
                <?php foreach ($activeShares as $activeShare) : ?>
                    <span class="moving-text-name"><?= $activeShare['name'] ?> <i
                            class="fa-solid fa-arrow-up moving-text-icon"></i></span>
                    <span class="moving-text-shares"><?= $activeShare['shares_on_sale'] ?></span>
                <?php endforeach; ?>
            <?php endif; ?>


        </div>
    </div>
    <div class="container">
        <div class="onboarded-sacco-container">
            <h5>Saccos actively selling share capital</h5>
        </div>

        <div class="slider-main-container">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper" id="swiper-wrapper">


                    <div class="swiper-wrapper sacco-shares-skeleton">

                        <div class="swiper-slide">
                            <div class="card" style="padding: 15px;">
                                <span class="placeholder col-12 btn " style="border-radius: 5px;"></span>
                                <div class="card-body">
                                    <span class="placeholder col-12 placeholder-lg" style="border-radius: 5px;"></span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="swiper-wrapper sacco-shares-skeleton">

                        <div class="swiper-slide">
                            <div class="card" style="padding: 15px;">
                                <span class="placeholder col-12 btn " style="border-radius: 5px;"></span>
                                <div class="card-body">
                                    <span class="placeholder col-12 placeholder-lg" style="border-radius: 5px;"></span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="card" style="padding: 15px;">
                                <span class="placeholder col-12 btn " style="border-radius: 5px;"></span>
                                <div class="card-body">
                                    <span class="placeholder col-12 placeholder-lg" style="border-radius: 5px;"></span>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>


    </div>

    <?= $this->include('includes/footer.php'); ?>

    <?= $this->endSection(); ?>