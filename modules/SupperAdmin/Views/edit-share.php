<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
<?php $this->section('content');?>

    <div class="container-scroller">

        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <h4>Edit Share</h4>
                            <form class="pt-3" method="post" action="">
                                <?= csrf_field()?>
                                <div class="form-group">
                                    <label class="text-primary">Cost Per Share:</label>
                                    <input type="text" class="form-control form-control-lg" id="cost" value="<?= $share['cost']?>" name="cost">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('cost')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('cost') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="text-primary">Verification:</label>
                                    <input type="text" class="form-control form-control-lg" id="is_verified" value="<?= $share['is_verified']?>" name="is_verified">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('is_verified')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('is_verified') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Update Share</button>
                                </div>
                                <div class="mt-4 font-weight-light"> Go Back to Admin <a href="<?= base_url('supperAdmin/manage-shares') ?>" class="text-primary">Admin</a>
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