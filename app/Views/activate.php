<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container pt-4" style="width: 60rem;">
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <h6>Activate you Account</h6>
            <?php if(isset($error)) :?>
            <div class="alert alert-danger">
                <?= $error; ?>
            </div>
            <?php endif ?>
            <?php if(isset($success)) :?>
                <div class="alert alert-success">
                    <?= $success; ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>


