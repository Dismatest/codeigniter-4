<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
<?php $this->section('content');?>
    <div class="registration-container">
        <div class="logo-container">
<!--            <img src="--><?php //= base_url('assets/images/logo-hisa.png') ?><!--" alt="sacco hisa logo">-->
            <span>Forgot Your Password?</span>
        </div>
        <div class="registration-container-2">
            <div class="registration-title">
                <span>Enter your email address</span>
            </div>
            <form method="post" action="">
                <?= csrf_field()?>
                <div class="user-details">
                    <div class="registration-input">
                        <span class="registration-details">Email</span>
                        <input type="text" name="email">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('email')) : ?>
                                <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('email') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="register-button">
                        <input type="submit" value="Request Password Reset Link">
                    </div>
                </div>
            </form>
            <a href="<?= base_url('supperAdmin/login') ?>"> Go back to <span>Login</span></a>
        </div>
    </div>
<?php $this->endSection();?>