<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
<?php $this->section('content');?>

    <div class="registration-container">
        <div class="registration-container-2">
            <?php
            if(!empty(session()->getFlashData('success'))){
                ?>
                <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
                <?php
            }else if(!empty(session()->getFlashData('fail'))){
                ?>
                <div class="alert alert-danger"><?= session()->getFlashData('fail') ?></div>
                <?php
            }
            ?>
            <div class="registration-title">
                <span>Admin Register</span>
                <span><a href="<?= base_url('supperAdmin/login') ?>">login</a></span>
            </div>
            <form method="post" action="">
                <?= csrf_field()?>
                <div class="user-details">
                    <div class="registration-input">
                        <span class="registration-details">First Name</span>
                        <input type="text" placeholder="enter your first name" name="fname">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('fname')) :?>
                                <span class="text-danger text-sm"><?= $validation->getError('fname') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="registration-input">
                        <span class="registration-details">Last Name</span>
                        <input type="text" placeholder="enter your last name" name="lname">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('lname')) :?>
                                <span class="text-danger text-sm"><?= $validation->getError('lname') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="registration-input">
                        <span class="registration-details">Email</span>
                        <input type="text" placeholder="enter your email" name="email">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('email')) :?>
                                <span class="text-danger text-sm"><?= $validation->getError('email') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="registration-input">
                        <span class="registration-details">Password</span>
                        <input type="password" placeholder="enter your password" name="password">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('password')) :?>
                                <span class="text-danger text-sm"><?= $validation->getError('password') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="registration-input">
                        <span class="registration-details">Confirm Password</span>
                        <input type="password" placeholder="confirm password" name="confirm-password">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('confirm-password')) :?>
                                <span class="text-danger text-sm"><?= $validation->getError('confirm-password') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="register-button">
                        <input type="submit" value="Register">
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $this->endSection();?>