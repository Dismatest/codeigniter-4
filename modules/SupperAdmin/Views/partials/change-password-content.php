
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
                    <span></span>Dashboard/Change Password <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h5 class="buyer-commission-container"><span><i class="mdi mdi-account-multiple-plus buyer-commission"></i></span> Change Password</h5>

                        <div class="form-group">
                            <label for="old-pass" class="form-label">Old Password*</label>
                            <input type="password" class="form-control form-control-sm" id="old-pass" placeholder="old password" name="old-pass">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('old-pass')) :?>
                                    <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('old-pass') ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="new-pass" class="form-label">New Password*</label>
                            <input type="password" class="form-control form-control-sm" id="new-pass" placeholder="new password" name="new-pass">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('new-pass')) :?>
                                    <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('new-pass') ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="conf-new-pass" class="form-label">Confirm New Password*</label>
                            <input type="password" class="form-control form-control-sm" id="conf-new-pass" placeholder="new password" name="conf-new-pass">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('conf-new-pass')) :?>
                                    <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('conf-new-pass') ?></span>
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
