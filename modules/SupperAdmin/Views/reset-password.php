<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
<?php $this->section('content');?>
    <div class="registration-container">
        <div class="logo-container">
            <!--            <img src="--><?php //= base_url('assets/images/logo-hisa.png') ?><!--" alt="sacco hisa logo">-->
            <span>Forgot Your Password?</span>
        </div>
        <div class="registration-container-2">
            <div class="registration-title">
                <span>Enter Your New Password</span>
            </div>
            <form method="post" action="">
                <?= csrf_field()?>
                <div class="user-details">
                    <div class="registration-input">
                        <span class="registration-details">New Password</span>
                        <input type="password" name="password">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('password')) : ?>
                                <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('password') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="registration-input">
                        <span class="registration-details">Confirm New Password</span>
                        <input type="password" name="conf-password">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('conf-password')) : ?>
                                <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('conf-password') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="register-button">
                        <input type="submit" value="Reset Your Password">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $this->endSection();?>