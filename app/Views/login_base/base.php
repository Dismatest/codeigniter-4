<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
    <?php 
        if(isset($loginTitle)):
            echo $loginTitle;
        elseif(isset($registerTitle)):
            echo $registerTitle;
        endif;
    ?>
    </title>
    <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

    <?= $this->renderSection('login') ?>

    <script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js')?>"></script>
    <script src="<?= base_url('assets/vendors/chart.js/Chart.min.js')?>"></script>
    <script src="<?= base_url('assets/js/jquery.cookie.js')?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/jquery-3.6.3.min.js')?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/off-canvas.js')?>"></script>
    <script src="<?=base_url('assets/js/hoverable-collapse.js')?>"></script>
    <script src="<?=base_url('assets/js/misc.js')?>"></script>
    <script src="<?= base_url('assets/js/dashboard.js')?>"></script>
    <script src="<?= base_url('assets/js/todolist.js')?>"></script>
    <script src="<?= base_url('assets/js/register.js')?>"></script>
</body>
</html>