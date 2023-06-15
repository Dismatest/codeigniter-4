<?php $this->extend("client_base/base.php"); ?>
<?php $this->section('content'); ?>

    <div class="load"></div>
    <section>
        <div class="imgBx">
        </div>
        <div class="contentBx">
            <div class="formBx">
                <?php
                if (!empty(session()->getFlashdata('success'))) {
                    ?>
                    <div class="alert alert-success mb-2"><?= session()->getFlashdata('success') ?></div>
                    <?php
                } elseif (!empty(session()->getFlashdata('fail'))) {
                    ?>
                    <div class="alert alert-danger mb-2"><?= session()->getFlashdata('fail') ?></div>
                    <?php
                }
                ?>
                <h2>Login to your account</h2>
                <form method="post" action="">
                    <?= csrf_field() ?>
                    <div class="inputBx">
                        <span>Email</span>
                        <input type="email" placeholder="enter your email" name="email"
                               value="<?= set_value('email') ?>">
                        <?php if (isset($validation)) : ?>
                            <?php if ($validation->hasError('email')) : ?>
                                <span class="text-danger text-sm"><?= $validation->getError('email') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="inputBx">
                        <span>Password</span>
                        <input type="password" placeholder="enter your password" name="password">
                        <?php if (isset($validation)) : ?>
                            <?php if ($validation->hasError('password')) : ?>
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
                        <p>Forgot password? <a href="<?= base_url('forgot-password') ?>">Reset Password</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php $this->endSection(); ?>