<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container">
    <div class="row pt-5 pb-5">

        <?= $this->include('includes/saved-sidebar.php'); ?>

        <div class="col-md-7">
            <div class="main-saved-container">


                    <div class="my-accordion">
                        <div class="my-accordion-item">
                            <div class="my-accordion-header">
                                <h3>(<span id="number-of-shares"></span>) Active Shares</h3>
                                <button class="my-accordion-toggle"></button>
                            </div>
                            <div class="my-accordion-content">

                        </div>
                    </div>

                    <hr>
                    <div class="share-view-status">
                        <h5 class="share-status-heading">Share Impression</h5>
                        <div class="viewers-status">
                            <h5>Viewers</h5>
                            <span>180 People</span>
                        </div>
                    </div>

        </div>
    </div>
    </div>
</div>
</div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->endSection(); ?>
