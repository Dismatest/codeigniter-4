<?php $this->extend("login_base/base.php");?>
<?php $this->section('login');?>

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
                <h4>Hello, Sign Up Here</h4> 
                <form class="pt-3" method="post" action="">
                  <?= csrf_field()?>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="First Name" name="fname">
                    <?php if(isset($validation)) : ?>
                    <?php if($validation->hasError('fname')) :?>
                    <span class="text-danger text-sm"><?= $validation->getError('fname') ?></span>
                    <?php endif; ?>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Last Name" name="lname">
                    <?php if(isset($validation)) : ?>
                    <?php if($validation->hasError('lname')) :?>
                    <span class="text-danger text-sm"><?= $validation->getError('lname') ?></span>
                    <?php endif; ?>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="phoneNumber" placeholder="Phone Number" name="phone">
                    <?php if(isset($validation)) : ?>
                    <?php if($validation->hasError('phone')) :?>
                    <span class="text-danger text-sm"><?= $validation->getError('phone') ?></span>
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
                    <input type="password" class="form-control form-control-lg" id="password1" placeholder="Password" name="password">
                    <?php if(isset($validation)) : ?>
                    <?php if($validation->hasError('password')) :?>
                    <span class="text-danger text-sm"><?= $validation->getError('password') ?></span>
                    <?php endif; ?>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="password2" placeholder="Confirm Pass" name="confirm-password">
                    <?php if(isset($validation)) : ?>
                    <?php if($validation->hasError('confirm-password')) :?>
                    <span class="text-danger text-sm"><?= $validation->getError('confirm-password') ?></span>
                    <?php endif; ?>
                    <?php endif; ?>
                  </div>
                  <div class="mb-4">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" id="terms-and-conditions"> I agree to all Terms & Conditions </label>
                    </div>
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" id="terms-of-use">SIGNUP</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="<?= base_url('login') ?>" class="text-primary">Login</a>
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