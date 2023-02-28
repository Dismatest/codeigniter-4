<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
<?php $this->section('content');?>

    <div class="container-scroller">

        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <h4>Edit Sacco</h4>
                            <form class="pt-3" method="post" action="">
                                <?= csrf_field()?>
                                <div class="form-group">
                                    <label class="text-primary">Sacco Name:</label>
                                    <input type="text" class="form-control form-control-lg" id="name" value="<?= $sacco['name']?>" name="name">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('name')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('name') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="text-primary">Email Address:</label>
                                    <input type="text" class="form-control form-control-lg" id="email" value="<?= $sacco['email']?>" name="email">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('email')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('email') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="text-primary">Head Office:</label>
                                    <input type="text" class="form-control form-control-lg" id="location" value="<?= $sacco['location']?>" name="location">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('location')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('location') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="text-primary">Website url:</label>
                                    <input type="url" class="form-control form-control-lg" id="website" value="<?= $sacco['website']?>" name="website">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('website')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('website') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Update Sacco</button>
                                </div>
                                <div class="mt-4 font-weight-light"> Go Back to Admin <a href="<?= base_url('supperAdmin/manage-sacco') ?>" class="text-primary">Admin</a>
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