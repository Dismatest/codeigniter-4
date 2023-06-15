<?= $this->extend("client_base/base.php"); ?>
<?= $this->section('content'); ?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container">

    <div class="row settings-top">

        <div class="col-md-7 settings-top-social-media">
            <div class="main-saved-container">
                <div class="update-email-container">
                    <h6 style="font-size: 15px; color: #1bcfb4; padding: 15px 0; font-weight: 600">Account Settings</h6>
                    <hr>
                    <div class="update-email">
                        <h5>Update Email</h5>
                        <form>
                            <div class="verify-input-1">
                                <input type="text" name="update-email" id="update-email">
                            </div>
                            <button disabled type="submit" class="update-email-button">Update Email</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="main-saved-container py-3 mt-3">
                <div class="update-email-container">

                    <div class="update-email">
                        <h5>Change Password</h5>
                        <form>
                            <div class="verify-input-1">
                                <input type="password" name="password" id="password" placeholder="New password">
                            </div>
                            <div class="verify-input-1">
                                <input type="password" name="password1" id="password1"
                                       placeholder="Confirm New Password">
                            </div>
                            <button disabled type="submit" class="update-email-button">Update Password</button>
                        </form>
                    </div>

                </div>
            </div>


            <div class="main-saved-container py-3 mt-3">
                <div class="update-email-container">

                    <div class="update-email">
                        <h5 style="color: orangered">Delete Account</h5>
                        <form>
                            <button disabled type="submit" class="delete-account">Delete Account</button>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>
<?= $this->endSection(); ?>
