<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="load"></div>
<div class="container">
    <div class="row pt-5 pb-5">

        <div class="col-md-12">


            <div class="sell-main-section1">
                <div class="alert alert-success" role="alert" id="success" style="display:none;">
                    <p id="success-message"></p>
                </div>
                <div class="sell-heading">
                    <h5>Sell Shares</h5>
                    <span id="error-message"></span>
                    <span id="clear">clear</span>
                </div>
                <div class="verify-account">
                    <span>Sell Your Shares Here</span>
                </div>
                <form action="" method="post" class="verify-form-2" id="form">
                    <div class="verify-input">
                        <label for="verify">Select sacco*</label>
                        <div class="custom-select">
                            <input type="text" class="select-input" placeholder="Select sacco" name="sacco_id" id="sell-shares-input">
                            <ul class="select-options">
                                <?php if(!empty($saccos)): ?>
                                    <?php foreach ($saccos as $sacco): ?>
                                        <li data-value="<?= $sacco['sacco_id'] ?>"><?= $sacco['name'] ?></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="verify-input-1">
                        <label for="verify">Member Number*</label>
                        <input type="text" name="member_number" placeholder="Enter member number" id="memberNumber">
                    </div>

                    <div class="verify-input-1">
                        <label for="verify">Shares*</label>
                        <input type="number" name="share" placeholder="Enter the amount of shares" id="shares-for-sale-input-1">
                    </div>
                    <div class="verify-terms">
                        <label for="terms">I agree to the terms and conditions*</label>
                        <input type="checkbox" name="terms" id="sell-shares-terms">
                    </div>
                    <div class="hidden">
                        <?php if(!empty($member_commission)): ?>
                            <input type="hidden" name="commission" value="<?= $member_commission ?>" id="member-commission">
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-center">
                        <input type="submit" value="Submit" class="verify-input-button" id="sell-now-btn">
                    </div>


                </form>
            </div>

        </div>

    </div>
</div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->endSection(); ?>
