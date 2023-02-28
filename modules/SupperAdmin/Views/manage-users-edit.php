<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
<?php $this->section('content');?>

    <div class="container-scroller">

        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <h4>Edit User</h4>
                            <form class="pt-3" method="post" action="">
                                <?= csrf_field()?>
                                <div class="form-group">
                                    <label class="text-primary">First Name:</label>
                                    <input type="text" class="form-control form-control-lg" id="cost" value="<?= $users['fname'] ?>" name="fname">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('fname')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('fname') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="text-primary">Last Name:</label>
                                    <input type="text" class="form-control form-control-lg" id="cost" value="<?= $users['lname'] ?>" name="lname">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('fname')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('lname') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="text-primary">Phone Number:</label>
                                    <input type="text" class="form-control form-control-lg" id="cost" value="<?= $users['phone'] ?>" name="phone">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('phone')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('phone') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="text-primary">Email Address:</label>
                                    <input type="text" class="form-control form-control-lg" id="cost" value="<?= $users['email'] ?>" name="email">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('email')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('email') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="text-primary">Activation Status:</label>
                                    <input type="text" class="form-control form-control-lg" id="is_verified" value="<?= $users['activation_status'] ?>" name="activation_status">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('activation_status')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('activation_status') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Update User</button>
                                </div>
                                <div class="mt-4 font-weight-light"> Go Back to Admin <a href="<?= base_url('supperAdmin/manage-users') ?>" class="text-primary">Admin</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div> <!-- page-body -->

<?php $this->endSection();?>