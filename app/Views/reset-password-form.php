<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>
<script>
    setTimeout(function (){
        $('#removeFlashMessage').hide();
    }, 3000);
</script>
<section>
    <div class="imgBx">
        <img src="https://images.unsplash.com/photo-1524508762098-fd966ffb6ef9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" alt="">
    </div>
    <div class="contentBx">
        <div class="formBx">
            <?php if(session()->getTempdata('success')):?>
                <div class="alert alert-success"  id="removeFlashMessage"><?= session()->getTempdata('success')?></div>
            <?php endif ?>
            <?php if(session()->getTempdata('fail')):?>
                <div class="alert alert-success" id="removeFlashMessage"><?= session()->getTempdata('fail')?></div>
            <?php endif ?>
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
            <h2>Reset Password</h2>
            <form method="post" action="">
                <div class="inputBx">
                    <span>New password</span>
                    <input type="password" name="newPassword">
                    <?php if(isset($validation)):?>
                        <?php if($validation->hasError('newPassword')):?>
                            <span class="text-center text-danger">
                            <?= $validation->getError() ?>
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="inputBx">
                    <span>Confirm new password</span>
                    <input type="password" name="confPassword">
                    <?php if(isset($validation)):?>
                        <?php if($validation->hasError('confPassword')):?>
                            <span class="text-center text-danger">
                            <?= $validation->getError() ?>
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="inputBx">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>