<?= $this->extend("client_base/base.php"); ?>
<?= $this->section('content'); ?>

<?= $this->include('includes/navbar.php'); ?>

    <div class="load"></div>
    <div class="main-container">
        <div class="description-section">
            <div class="content-section">
                <h5>Welcome to the Sacco Hisa Shares Portal</h5>
                <p>The platform that allow you sell and buy shares from different sacco within kenya.
                </p>
                <div class="top-button">
                    <a href="<?= 'index' ?>">Buy Shares <i class="fa-solid fa-arrow-right arrow-icon2"></i></a>

                    <a href="<?= 'index' ?>">Sell Shares <i class="fa-solid fa-arrow-right arrow-icon2"></i></a>
                </div>

            </div>
        </div>
        <div class="container scroll-btn-main-container">
            <a href="#scroll-btn">
                <button type="button" class="welcome-scroll-btn">Scroll <i
                        class="fa-solid fa-arrow-down arrow-icon-down"></i></button>
            </a>
        </div>
    </div>
    <div class="moving-text-container">
        <div class="moving-text">

            <?php if (!empty($activeShares)) : ?>
                <?php foreach ($activeShares as $activeShare) : ?>
                    <span class="moving-text-name"><?= $activeShare['name'] ?> <i class="fa-solid fa-arrow-up moving-text-icon"></i></span>
                    <span class="moving-text-shares"><?= $activeShare['shares_on_sale'] ?></span>
                <?php endforeach; ?>
            <?php endif; ?>


        </div>
    </div>
    <div class="container">
        <div class="onboarded-sacco-container">
            <h5>Saccos actively selling share capital</h5>
        </div>

        <div class="slider-main-container pb-5">
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
<?= $this->include('includes/small-footer.php'); ?>

<?= $this->endSection(); ?>