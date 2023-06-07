<?php $this->extend('Modules\Admin\Views\adminLayouts\base.php');?>
<?php $this->section('content');?>

    <div class="registration-container">
        <div class="logo-container">
            <!--            <img src="--><?php //= base_url('assets/images/logo-hisa.png') ?><!--" alt="sacco hisa logo">-->
            <span>Sign In To Your Account</span>
        </div>
        <div class="registration-container-2">
            <div class="registration-title">
                <span>Enter Your Email and Password</span>
            </div>
            <form method="post" action="">
                <?= csrf_field()?>
                <div class="user-details">
                    <div class="registration-input">
                        <span class="registration-details">Email Address*</span>
                        <input type="text" name="email">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('email')) : ?>
                                <span class="text-danger text-sm"><?= $validation->getError('email') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="registration-input">
                        <span class="registration-details">Password*</span>
                        <input type="password" name="password">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('password')) : ?>
                                <span class="text-danger text-sm"><?= $validation->getError('password') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="register-button">
                        <input type="submit" value="Login">
                    </div>
                    <div class="terms-and-conditions">
                        <span><a href="<?= base_url('admin/forgot-password') ?>">Forgot Password?</a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $this->endSection();?>