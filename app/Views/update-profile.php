<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container personal-info-container" id="personal-info-main-section">

    <div class="row main-row-info">
            <h6 class="profile-image-heading text-center">Personal Information</h6>
        <?php if(session()->getTempdata('success')) :?>
            <div class="alert alert-success" role="alert">
                <?= session()->getTempdata('success') ?>
            </div>
        <?php elseif (session()->getTempdata('fail')) :?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getTempdata('fail') ?>
            </div>
        <?php endif ?>
        <div class="col col-md-4 col-12">
            <div class="profile-img-container">
                <?php if(isset($userData->profile)) :?>
                    <div class="profile-image-upload">
                        <img class="img-upload" src="<?= base_url().'/uploads/'.$userData->profile?>" alt="">
                    </div>
                <?php else :?>
                    <div class="profile-image-upload">
                        <img class="img-upload" src="https://images.unsplash.com/photo-1634034379073-f689b460a3fc?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=580&q=80" alt="">
                    </div>
                <?php endif; ?>
            </div>


        </div>

        <div class="col col-md-8 col-12">
            <div class="personal-info-input-fields">

                <form action="" method="post" enctype="multipart/form-data">
                    <?php csrf_token() ?>
                    <div>
                    <label for="First Name">First Name</label>
                    </div>
                    <input type="text" class="personal-information-edit" value="<?= $userData->fname ; ?>" name="fname">
                    <?php if(isset($validation)) :?>

                        <?php if($validation->hasError('fname')) :?>
                            <p class="text-danger"><?= $validation->getError('fname')?></p>
                        <?php endif;?>
                    <?php endif ?>

                    <div>
                    <label for="First Name">Last Name</label>

                    <input type="text" class="personal-information-edit" value="<?= $userData->lname ; ?>" name="lname">
                        <?php if(isset($validation)) :?>

                            <?php if($validation->hasError('lname')) :?>
                                <p class="text-danger"><?= $validation->getError('lname')?></p>
                            <?php endif;?>
                        <?php endif ?>
                        
                    </div>
                    <div>
                        <label for="">Phone Number</label>
                    </div>
                        <input type="tel" class="personal-information-edit" value="<?= $userData->phone ; ?>" name="phone">
                    <?php if(isset($validation)) :?>

                        <?php if($validation->hasError('phone')) :?>
                            <p class="text-danger"><?= $validation->getError('phone')?></p>
                        <?php endif;?>
                    <?php endif ?>

                    <div>
                        <label for="">Profile</label>
                    </div>
                        <input type="file" class="personal-information-edit" value="<?= $userData->profile ; ?>" name="avatar" required
                    
                    <div class="update-personal-info">
                        <button type="submit" class="update-personal-info-edit-button">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>
<?= $this->endSection(); ?>

