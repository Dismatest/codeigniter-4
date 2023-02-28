<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>
    <script>
        setTimeout(function (){
            $('#removeFlashMessage').hide();
        }, 3000);
    </script>
<!--In this page I am checking if there is errors, if so, i will display the error else the password input form-->
    <div class="container pt-4" style="width: 30rem;">
        <div class="row">
            <div class="col-md-12 col-sm-6">

                <?php if(isset($error)) :;?>
                <div class="alert alert-danger" id="removeFlashMessage"><?= $error ?></div>
                <?php else: ?>
                <?php if(isset($validation)) :?>
                <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                <?php endif; ?>
                <?php if(session()->getTempdata('error')) :?>
                    <div class="alert alert-danger"></div>
                <?php endif ?>
                    <form action="" method="post">
                        <?php csrf_token(); ?>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">New Password</label>
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
                            <label for="exampleInputPassword1" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" name="confPassword">
                            <?php if(isset($validation)):?>
                                <?php if($validation->hasError('confPassword')):?>
                                    <span class="text-center text-danger">
                            <?= $validation->getError() ?>
                        </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                <?php endif;?>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>