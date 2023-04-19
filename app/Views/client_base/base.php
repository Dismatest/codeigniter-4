<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php 
        if(isset($indexTitle)){
            echo $indexTitle;
        }elseif(isset($dashboardTitle)){
            echo $dashboardTitle;
        }elseif(isset($loginTitle)){
            echo $loginTitle;
        }
        elseif(isset($registerTitle)){
            echo $registerTitle;
        }
        else{
            echo "Share Market";
        }
        ?>
    </title>
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
    />
    <link href="<?= base_url('assets/css/mdb.min.css'); ?>" rel="stylesheet">
    <!-- dataTables link -->
    <link href="<?= base_url('assets/css/dataTables.min.css'); ?>" rel="stylesheet">
    <!-- end of dataTables link -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/navbar.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/footer.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/app.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/dashboard.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/personal-info.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/index.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/list-shares.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/loader.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/saved.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/stepper.css'); ?>" rel="stylesheet">
</head>
<body>

<?= $this->renderSection('content') ?>


<script src="<?= base_url('assets/js/jquery-3.6.3.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/mdb.min.js'); ?>"></script>
<!-- dataDatable links -->
<script src="<?= base_url('assets/js/dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/vfs_fonts.js'); ?>"></script>
<!-- end of dataDatable links -->
<script src="<?= base_url('assets/js/navbar.js'); ?>"></script>
<script src="<?= base_url('assets/js/app.js'); ?>"></script>
<script src="<?= base_url('assets/js/loader.js'); ?>"></script>
<script src="<?= base_url('assets/js/stepper.js'); ?>"></script>
<script src="<?= base_url('assets/js/user-dashboard.js'); ?>"></script>
</body>
</html>