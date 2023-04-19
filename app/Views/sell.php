<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="load"></div>
<div class="container">
    <div class="row pt-5 pb-5">

        <div class="col-md-12">

            <div class="sell-main-section">

                <div class="sell-heading">
                    <h5>Sell Shares</h5>
                    <span id="error-message"></span>
                    <span>clear</span>
                </div>
                <div class="verify-account">
                    <span>Step 1: Verify your account</span>
                </div>
                    <form action="" method="post" class="verify-form">
                        <div class="verify-input">
                        <label for="verify">Membership number:</label>
                        <input type="text" name="verify" id="verify" placeholder="Enter membership number*">
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="submit" value="Submit" class="verify-input-button">
                        </div>
                    </form>
            </div>
        </div>

    </div>
</div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>
<?= $this->endSection(); ?>
