<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container pt-5 pb-5">

    <?php if(!empty(session()->getFlashdata('success'))) : ?>
    <div class="custom-alert2">
        <div class="d-flex justify-content-around">
            <span><i class="fas fa-circle-check verified-budge check-icon-saved"></i></span>
            <span class="saved-message"><?= session()->getFlashdata('success') ?></span>
            <span><i class="fa-solid fa-xmark close-icon-saved"></i></span>
        </div>
    </div>
    <?php endif; ?>
    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
    <div class="custom-alert2-error">
        <div class="d-flex justify-content-around">
            <span><i class="fas fa-circle-check verified-budge check-icon-saved2"></i></span>
            <span class="saved-message2"><?= session()->getFlashdata('fail') ?></span>
            <span><i class="fa-solid fa-xmark close-icon-saved2"></i></span>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <?= $this->include('includes/saved-sidebar.php'); ?>

        <div class="col-md-7 settings-top-social-media">
            <div class="main-saved-container">


                    <div class="my-accordion">
                        <div class="my-accordion-item">
                            <div class="my-accordion-header">
                                <h3>(<span id="number-of-shares">
                                        <i class="fa-solid fa-circle-notch fa-spin active-shares-icon"></i>
                                    </span>) Active Shares</h3>
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
<?php $this->section('active-shares-script');?>
<script>
    $(document).ready(function(){
        $('.close-icon-saved').on('click', function(){
            $('.custom-alert2').hide();
        });

        $('.close-icon-saved2').on('click', function(){
            $('.custom-alert2-error').hide();
        });
    });
</script>
<?php $this->endSection(); ?>
