<?php $this->extend("login_base/base.php");?>
<?php $this->section('login');?>

    <div class="load"></div>
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
                            <h4>Hello, <?= $user['fname'] ?>, please submit your request to join a new sacco in this form.</h4>
                            <form class="pt-3" method="post" action="">
                                <?= csrf_field()?>
                                <div class="form-group">
                                    <label for="selectInput" class="form-label">Your First Name</label>
                                    <input type="text" class="form-control form-control-lg" placeholder="First Name" name="fname" value="<?= $user['fname']?>">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('fname')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('fname') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="selectInput" class="form-label">Your Last Name</label>
                                    <input type="text" class="form-control form-control-lg" placeholder="Last Name" name="lname" value="<?= $user['lname']?>">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('lname')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('lname') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="selectInput" class="form-label">Your Phone Number</label>
                                    <input type="text" class="form-control form-control-lg" id="phoneNumber" placeholder="Phone" value="<?= $user['phone']?>">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('phone')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('phone') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="selectInput" class="form-label">Your Email Address</label>
                                    <input type="text" class="form-control form-control-lg" id="email" placeholder="Email" name="email" value="<?= $user['email']?>">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('email')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('email') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="selectInput" class="form-label">Your ID Number</label>
                                    <input type="text" class="form-control form-control-lg" id="identification" placeholder="ID Number" name="identification" value="">
                                    <?php if(isset($validation)) : ?>
                                        <?php if($validation->hasError('identification')) :?>
                                            <span class="text-danger text-sm"><?= $validation->getError('identification') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                <label for="selectInput" class="form-label">Select Sacco</label>
                                <select class="form-select form-control form-control-lg" id="selectInput" name="selectName">
                                    <option value="">-- Select Sacco --</option>
                                    <?php if(isset($sacco)): ?>
                                    <?php foreach($sacco as $sac) : ?>
                                        <option value="<?= $sac['sacco_id'] ?>"><?= $sac['name'] ?></option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" id="terms-and-conditions"> I agree to all Terms & Conditions </label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" id="terms-of-use">SUBMIT</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> Back to <a href="<?= base_url('dashboard') ?>" class="text-primary">Dashboard</a>
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