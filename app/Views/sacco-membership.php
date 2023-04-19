<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>
<?= $this->include('includes/navbar.php'); ?>

    <div class="registration-container1">
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
            <div class="registration-title1">
                <span>Submit your request to join any of the bellow sacco</span>
            </div>
            <form action="" method="post">
                <div class="user-details">
                    <div class="registration-input">
                        <span class="registration-details">First Name</span>
                        <input type="text" placeholder="enter your first name" name="fname" value="<?= $user['fname']?>">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('fname')) :?>
                                <span class="text-danger text-sm"><?= $validation->getError('fname') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="registration-input">
                        <span class="registration-details">Last Name</span>
                        <input type="text" value="<?= $user['lname']?>">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('lname')) :?>
                                <span class="text-danger text-sm"><?= $validation->getError('lname') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="registration-input">
                        <span class="registration-details">Email</span>
                        <input type="text" name="email" value="<?= $user['email']?>">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('email')) :?>
                                <span class="text-danger text-sm"><?= $validation->getError('email') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="registration-input">
                        <span class="registration-details">Phone</span>
                        <input type="tel" name="phone" value="<?= $user['phone']?>">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('phone')) :?>
                                <span class="text-danger text-sm"><?= $validation->getError('phone') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="registration-input">
                        <span class="registration-details">ID Number</span>
                        <input type="number" name="identification" placeholder="ID number">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('identification')) :?>
                                <span class="text-danger text-sm"><?= $validation->getError('identification') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="registration-input">
                        <span class="registration-details">Select Sacco</span>
                        <select name="selectName" class="select-registration">
                            <option value="">Select Sacco</option>
                            <?php if(isset($sacco)): ?>
                                <?php foreach($sacco as $sac) : ?>
                                    <option value="<?= $sac['sacco_id'] ?>"><?= $sac['name'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="register-button">
                        <input type="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?= $this->include('includes/footer.php'); ?>
<?php $this->endSection();?>

