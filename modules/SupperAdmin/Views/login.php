<?php $this->extend('Modules\SupperAdmin\Views\adminLayouts\base.php');?>
<?php $this->section('content');?>

    <div class="registration-container">
        <div class="logo-container">
            <!--            <img src="--><?php //= base_url('assets/images/logo-hisa.png') ?><!--" alt="sacco hisa logo">-->
            <span>Sign In To Your Account</span>
        </div>
        <div class="registration-container-2">
            <div class="registration-title">
                <span>Enter your email and password</span>
                <span><a href="<?= base_url('supperAdmin/register') ?>">Register</a></span>
            </div>
            <form method="post" action="">
                <?= csrf_field()?>
                <div class="user-details">
                    <div class="registration-input">
                        <span class="registration-details">Email</span>
                        <input type="text" name="email" value="<?= set_value('email')?>">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('email')) : ?>
                                <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('email') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="registration-input">
                        <span class="registration-details">Password</span>
                        <input type="password" name="password">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('password')) : ?>
                                <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('password') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="register-button">
                        <input type="submit" value="Sign In">
                    </div>
                    <div class="terms-and-conditions">
                        <span><a href="<?= base_url('supperAdmin/forget-password') ?>">Forgot Password?</a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $this->endSection();?>