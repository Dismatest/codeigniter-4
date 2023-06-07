
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> SupperAdmin Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Dashboard/New Admin <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>


    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card card-max-width">
                <div class="card-body">
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
                    <form class="pt-3" method="post" action="">
                        <?= csrf_field()?>
                        <h5 class="buyer-commission-container"><span><i class="mdi mdi-account-multiple-plus buyer-commission"></i></span> Register New Admin</h5>

                        <div class="form-group">
                            <label for="fname" class="form-label">Admin First Name*</label>
                            <input type="text" class="form-control form-control-sm" id="fname" placeholder="enter first name" name="fname" value="<?= set_value('fname')?>">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('fname')) :?>
                                    <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('fname') ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="lname" class="form-label">Admin Last Name*</label>
                            <input type="text" class="form-control form-control-sm" id="lname" placeholder="enter last name" name="lname" value="<?= set_value('lname')?>">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('lname')) :?>
                                    <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('lname') ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="saccoEmail" class="form-label">Admin Email Address*</label>
                            <input type="text" class="form-control form-control-sm" id="saccoEmail" placeholder="enter email" name="email" value="<?= set_value('email')?>">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('email')) :?>
                                    <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('email') ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="mt-3 d-flex">
                            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SUBMIT</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
    </div>
