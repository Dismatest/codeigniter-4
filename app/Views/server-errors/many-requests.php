<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

    <div class="container pt-4" style="width: 30rem;">
        <div class="row">
            <div class="alert alert-danger">
               <span>Hello, You have sent too many request to the server, please try again after some time, thank you.</span>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>