<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container">
    <div class="row pt-5 pb-5">

        <?= $this->include('includes/saved-sidebar.php'); ?>

        <div class="col-md-7">
            <div class="main-saved-container">
                <div class="my-accordion-item">
                    <div class="my-accordion-header">
                        <h3>Your Membership</h3>
                        <button class="my-accordion-toggle"></button>
                    </div>

                    <?php if (isset($membership_status) && !empty($membership_status)) :?>
                        <div class="my-accordion-content1">
                            <div class="shares-on-share-active">
                                <div class="my-accordion-sacco-info">
                                    <h5><?= $membership_status->name ?> Sacco</h5>

                                    <span>Approved Date: <?= $membership_status->approved_at ?></span>
                                </div>
                                <div class="my-accordion-sacco-share-value">
                                    <h5>Status</h5>
                                    <?php if ($membership_status->is_approved == '1') :?>
                                    <span class="share-status">Approved</span>
                                    <?php else: ?>
                                        <span class="share-status-pending">Pending</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                    <p class="text-center">You have not request joining any sacco</p>
                    <?php endif ?>
                </div>

                <hr>
            </div>
        </div>
    </div>
</div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->endSection(); ?>
