<?php $this->extend("login_base/base.php");?>
<?php $this->section('login');?>
<script>
    setTimeout(function (){
        $('#hideTempMessage').hide();
    }, 3000)
</script>
<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
              <?php 
                if(!empty(session()->getFlashData('success'))){
                    ?>
                    <div class="alert alert-success" id="hideTempMessage"><?= session()->getFlashData('success') ?></div>
                    <?php
                }else if(!empty(session()->getTempdata('fail'))){
                    ?>
                    <div class="alert alert-danger" id="hideTempMessage"><?= session()->getTempdata('fail') ?></div>
                    <?php
                }
                ?>
                  <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                      <img src="<?= base_url().'/assets/images/img.png'?>" alt="img" style="object-fit: cover; height: 9.5em;">
                      <h4>Hello! login to continue</h4>
                  </div>
                <form class="pt-3" method="post" action="">
                  <?= csrf_field()?>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email">
                    <?php if(isset($validation)) : ?>
                    <?php if($validation->hasError('email')) : ?>
                    <span class="text-danger text-sm"><?= $validation->getError('email') ?></span>
                    <?php endif; ?>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
                    <?php if(isset($validation)) : ?>
                    <?php if($validation->hasError('password')) : ?>
                    <span class="text-danger text-sm"><?= $validation->getError('password') ?></span>
                    <?php endif; ?>
                    <?php endif; ?>
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" name="remember"> Keep me signed in </label>
                    </div>
                    <a href="<?= base_url('change-password')?>" class="auth-link text-black">Forgot password?</a>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="<?= base_url('register') ?>" class="text-primary">Create</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

<?php $this->endSection();?>