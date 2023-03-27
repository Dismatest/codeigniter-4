<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

    <div class="load"></div>
<div class="main-container">
    <div class="description-section">
        <div class="content-section">
            <h5>Welcome to the Sacco Hisa Shares Portal</h5>
            <p>The platform allow you sell and buy shares from different sacco within kenya.
            </p>
            <a href="<?= 'index' ?>">Go to shares <i class="fa-solid fa-arrow-right arrow-icon2"></i></a>
        </div>
    </div>
    <div class="container scroll-btn-main-container">
        <a href="#scroll-btn">
        <button type="button" class="welcome-scroll-btn">Scroll <i class="fa-solid fa-arrow-down arrow-icon-down"></i></button>
        </a>
    </div>
</div>
<div class="moving-text-container">
    <div class="moving-text">

        <span class="moving-text-name">Hisa <i class="fa-solid fa-arrow-up moving-text-icon"></i></span>
        <span class="moving-text-shares">200</span>

        <span class="moving-text-name">Hisa <i class="fa-solid fa-arrow-up moving-text-icon"></i></span>
        <span class="moving-text-shares">200</span>

    </div>
</div>
<div class="container">
    <div class="onboarded-sacco-container">
        <h5>Sacco onboarded</h5>
    </div>
    <div class="row main-row-container pb-4">
        <div class="col-md-3">
            <div class="card card-hover-container">
                <img src="<?= 'assets/images/image.png'?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">About Sacco HS</h5>
                    <p class="card-text">The sacco was established in 1996 and today is the leading sacco with a share capital ...</p>
                    <a href="#" class="sacco-read-more" id="scroll-btn">Read More <i class="fa-solid fa-arrow-right arrow-icon2"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card  card-hover-container">
                <img src="<?= 'assets/images/image.png'?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">About Sacco HS</h5>
                    <p class="card-text">The sacco was established in 1996 and today is the leading sacco with a share capital ...</p>
                    <a href="#" class="sacco-read-more">Read More <i class="fa-solid fa-arrow-right arrow-icon2"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-hover-container">
                <img src="<?= 'assets/images/image.png'?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">About Sacco HS</h5>
                    <p class="card-text">The sacco was established in 1996 and today is the leading sacco with a share capital ....</p>
                    <a href="#" class="sacco-read-more">Read More <i class="fa-solid fa-arrow-right arrow-icon2"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-hover-container">
                <img src="<?= 'assets/images/image.png'?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">About Sacco HS</h5>
                    <p class="card-text">The sacco was established in 1996 and today is the leading sacco with a share capital ...</p>
                    <a href="#" class="sacco-read-more">Read More <i class="fa-solid fa-arrow-right arrow-icon2"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('includes/footer.php'); ?>

<?= $this->endSection();?>