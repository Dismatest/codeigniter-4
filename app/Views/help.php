<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container">
    <div class="row settings-top">

        <?= $this->include('includes/saved-sidebar.php'); ?>

        <div class="col-md-7 settings-top-social-media">
            <div class="main-saved-container">
                <div class="contact-us-form">
                    <form method="post" action="" class="contact-us-form">
                       <div class="contact-section-box">
                           <span>Your Name</span>
                           <input type="text" name="name" value="Kimangoto">
                       </div>
                        <div class="contact-section-box">
                            <span>Your Message</span>
                            <textarea name="message" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="contact-section-box">
                            <input type="submit" name="name" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>
<?= $this->endSection(); ?>
