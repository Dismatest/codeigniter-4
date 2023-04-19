<?php $this->extend("client_base/base.php");?>
<?php $this->section('content');?>
    <script>
        setTimeout(function (){
            $('#hideTempMessage').hide();
        }, 3000)
    </script>
    <section>
        <div class="imgBx">
            <img src="https://images.unsplash.com/photo-1524508762098-fd966ffb6ef9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" alt="">
        </div>
        <div class="contentBx">
            <div class="formBx">
                <?php
                if(!empty(session()->getTempdata('success'))){
                    ?>
                    <div class="alert alert-success" id="hideTempMessage"><?= session()->getTempData('success') ?></div>
                    <?php
                }elseif(!empty(session()->getTempdata('fail'))){
                    ?>
                    <div class="alert alert-danger" id="hideTempMessage"><?= session()->getTempdata('fail') ?></div>
                    <?php
                }
                ?>
                <h2>Login</h2>
                <form method="post" action="">
                    <?= csrf_field()?>
                    <div class="inputBx">
                        <span>Email</span>
                        <input type="email" placeholder="enter your email" name="email">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('email')) : ?>
                                <span class="text-danger text-sm"><?= $validation->getError('email') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="inputBx">
                        <span>Password</span>
                        <input type="password" placeholder="enter your password" name="password">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('password')) : ?>
                                <span class="text-danger text-sm"><?= $validation->getError('password') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="remember-me">
                        <label><input type="checkbox" name="remember"> Remember me</label>
                    </div>
                    <div class="inputBx">
                        <input type="submit" value="Sign In">
                    </div>
                    <div class="inputBx">
                        <p>Don`t have an account? <a href="<?= base_url('register') ?>">Sign Up</a></p>
                    </div>
                    <div class="inputBx">
                        <p>Forgot password? <a href="<?= base_url('forgot-password')?>">Reset Password</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php $this->endSection();?>