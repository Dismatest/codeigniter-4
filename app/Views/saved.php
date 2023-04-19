<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container">
    <div class="row settings-top">

        <?= $this->include('includes/saved-sidebar.php'); ?>

        <div class="col-md-7 settings-top-social-media">
            <div class="main-saved-container">
                <div class="save-title">
                    <h5>My Saved Shares</h5>
                    <button>Shares (5)</button>
                </div>
                <hr>
                <div class="saved-shares-content">
                    <div class="margin-content-section">
                        <div class="saved-shares-details">
                            <img src="https://th.bing.com/th/id/R.eb2b82c57dda81c9aa7546a27b8399c1?rik=qZimBfcY7PKHIA&pid=ImgRaw&r=0" alt="sacco-profile" >
                        </div>
                        <div class="saved-shares-more-details">
                            <h5>HS</h5>
                            <span>Kenya Police Sacco Ltd</span>
                        </div>
                        <div class="saved-shares-more-details">
                            <h5 class="shares-value">Shares: 100</h5>
                            <span>Value: 410</span>
                        </div>
                        <div class="close-saved-share"><i class="fa-solid fa-x"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>
<?= $this->endSection(); ?>
