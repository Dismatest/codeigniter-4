<?php $this->extend("login_base/base.php");?>
<?php $this->section('login');?>

<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <h4>Hello, Sign Up Here</h4> 
                <form class="pt-3" method="post" action="">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="userName" placeholder="Full Name" name="name">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="phoneNumber" placeholder="Phone Number" name="number">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="email" placeholder="Email" name="">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="password1" placeholder="Password" name="password">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="password2" placeholder="Confirm Pass" name="password">
                  </div>
                  <div class="mb-4">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions </label>
                    </div>
                  </div>
                  <div class="mt-3">
                    <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">SIGN UP</a>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login.html" class="text-primary">Login</a>
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