<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>
<script>
    setTimeout(function (){
        $('#removeFlashMessage').hide();
    }, 3000);
</script>
    <div class="container pt-4" style="width: 30rem;">
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <?php if(session()->getTempdata('success')):?>
                    <div class="alert alert-success"  id="removeFlashMessage"><?= session()->getTempdata('success')?></div>
                <?php endif ?>
                <?php if(session()->getTempdata('fail')):?>
                    <div class="alert alert-success" id="removeFlashMessage"><?= session()->getTempdata('fail')?></div>
                <?php endif ?>
                <h6 class="text-center">Reset Password Form, Please Reset Your Password Here,</h6>
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
                <form action="" method="post">
                    <?php csrf_token(); ?>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Old Password</label>
                        <input type="password" class="form-control" name="oldPassword">
                        <?php if(isset($validation)):?>
                        <?php if($validation->hasError('oldPassword')):?>
                        <span class="text-center text-danger">
                            <?= $validation->getError() ?>
                        </span>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Current Password</label>
                        <input type="password" class="form-control" name="newPassword">
                        <?php if(isset($validation)):?>
                            <?php if($validation->hasError('newPassword')):?>
                                <span class="text-center text-danger">
                            <?= $validation->getError() ?>
                        </span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirm Current Password</label>
                        <input type="password" class="form-control" name="confPassword">
                        <?php if(isset($validation)):?>
                            <?php if($validation->hasError('confPassword')):?>
                                <span class="text-center text-danger">
                            <?= $validation->getError() ?>
                        </span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>