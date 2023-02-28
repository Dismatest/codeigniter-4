<?php $this->extend('Modules\Admin\Views\adminLayouts\base.php');?>
<?php $this->section('content');?>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
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
                            <h4>Admin Change Password Form</h4>
                            <form class="pt-3" method="post" action="">
                                <?= csrf_field()?>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Old Password" name="oldPassword">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('oldPassword')) : ?>
                                            <span class="text-danger text-sm"><?= $validation->getError('oldPassword') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="New Password" name="newPassword">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('newPassword')) : ?>
                                            <span class="text-danger text-sm"><?= $validation->getError('newPassword') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Confirm Password" name="confPassword">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('confPassword')) : ?>
                                            <span class="text-danger text-sm"><?= $validation->getError('confPassword') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="">UPDATE</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

<?php $this->endSection();?>