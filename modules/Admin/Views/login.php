<?php $this->extend('Modules\Admin\Views\adminLayouts\base.php');?>
<?php $this->section('content');?>

    <div class="registration-container">
        <div class="registration-container-2">
            <div class="registration-title">
                <span>Admin Login</span>
            </div>
            <form method="post" action="">
                <?= csrf_field()?>
                <div class="user-details">
                    <div class="registration-input">
                        <span class="registration-details">Email Address*</span>
                        <input type="text" placeholder="enter your email" name="email">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('email')) : ?>
                                <span class="text-danger text-sm"><?= $validation->getError('email') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="registration-input">
                        <span class="registration-details">Password*</span>
                        <input type="password" placeholder="enter your password" name="password">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('password')) : ?>
                                <span class="text-danger text-sm"><?= $validation->getError('password') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="register-button">
                        <input type="submit" value="Login">
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $this->endSection();?>