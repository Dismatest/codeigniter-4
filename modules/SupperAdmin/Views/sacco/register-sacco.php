<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
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
                            <h4>Sacco Registration Form</h4>
                            <form class="pt-3" method="post" action="">
                                <?= csrf_field()?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" placeholder="Name of the Sacco" name="name">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('name')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('name') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="email" placeholder="Email" name="email">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('email')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('email') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="location" placeholder="Location of the head office" name="location">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('location')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('location') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <input type="url" class="form-control form-control-lg" id="website" placeholder="website url (optional)" name="website">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('website')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('website') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-3 d-flex justify-content-between">
                                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">REGISTER</button>
                                    <a class="text-decoration-none p-3" href="<?= 'dashboard' ?>">Cancel</a>
                                </div>
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