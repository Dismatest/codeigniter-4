<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container">

    <div class="row settings-top">

        <?= $this->include('includes/saved-sidebar.php'); ?>

        <div class="col-md-7 settings-top-social-media">
            <div class="main-saved-container">
                <div class="connect-social-media">
                    <h6 style="font-size: 15px; color: #1bcfb4; padding: 15px 0; font-weight: 600">Connect Social Media for a great experiences</h6>
                    <hr>
                    <div class="connect-social-media-icons">
                        <a href=""><i class="fa-brands fa-facebook"></i></a>
                        <div class="switch">
                            <input type="checkbox" id="toggle">
                            <label for="toggle" class="slider">
                                <span class="on">ON</span>
                                <span class="off">OFF</span>
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="connect-social-media-icons">
                        <a href=""><i class="fa-brands fa-twitter"></i></a>
                        <div class="switch">
                            <input type="checkbox" id="toggle1">
                            <label for="toggle1" class="slider">
                                <span class="on2">ON</span>
                                <span class="off2">OFF</span>
                            </label>
                        </div>
                    </div>

                </div>

            </div>

            <div class="main-saved-container mt-3">
                <div class="connect-social-media">
                    <h6 style="font-size: 15px; color: #1bcfb4; padding: 15px 0; font-weight: 600">Logo Out</h6>
                    <hr>
                    <div class="social-media-icons">
                        <a href="<?= base_url().'/logout'?>" id="logout"><i class="fas fa-arrow-right-from-bracket m-2"></i>Logout</a>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>
<?= $this->endSection(); ?>
