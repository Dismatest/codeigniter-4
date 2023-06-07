
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
                    <span></span>Dashboard/Onboard Sacco <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h5 class="buyer-commission-container"><span><i class="mdi mdi-account-multiple-plus buyer-commission"></i></span>Sacco Details</h5>
                        <div class="form-group">
                            <label for="registerSaccoName" class="form-label">Sacco Name*</label>
                            <input type="text" id="registerSaccoName" class="form-control form-control-sm" placeholder="enter sacco name" name="name" value="<?= set_value('name')?>">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('name')) :?>
                                    <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('name') ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="saccoEmail" class="form-label">Sacco Email Address*</label>
                            <input type="text" class="form-control form-control-sm" id="saccoEmail" placeholder="enter sacco Email" name="email" value="<?= set_value('email')?>">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('email')) :?>
                                    <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('email') ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="saccoHeadOffice" class="form-label">Sacco Head Office*</label>
                            <input type="text" class="form-control form-control-sm" id="saccoHeadOffice" placeholder="enter head's office" name="office" value="<?= set_value('office')?>">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('office')) :?>
                                    <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('office') ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="website" class="form-label">Sacco Website Url*</label>
                            <input type="text" class="form-control form-control-sm" id="website" placeholder="enter sacco website" name="website" value="<?= set_value('website')?>">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('website')) :?>
                                    <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('website') ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <h5 class="buyer-commission-container"><span><i class="mdi mdi-currency-usd buyer-commission"></i></span>Payment Details</h5>
                        <div class="form-group">
                            <label for="website" class="form-label">Sacco Till Number*</label>
                            <input type="number" class="form-control form-control-sm" id="website" placeholder="enter sacco till" name="till" value="<?= set_value('till')?>">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('till')) :?>
                                    <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('till') ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <h5 class="buyer-commission-container"><span><i class="mdi mdi-account-multiple-plus buyer-commission"></i></span>Contact Person Details</h5>
                        <div class="form-group">
                            <label for="phone" class="form-label">Contact Person Phone*</label>
                            <input type="tel" class="form-control form-control-sm" id="phone" placeholder="enter sacco contact person phone" name="phone" value="<?= set_value('phone')?>">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('phone')) :?>
                                    <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('phone') ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="mt-3 d-flex">
                            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">ONBOARD</button>
                        </div>

                </form>
                </div>
                </div>
            </div>
        </div><!-- page-body -->
