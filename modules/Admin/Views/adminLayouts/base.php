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
        if(isset($adminLoginTitle)):
            echo $adminLoginTitle;
        elseif(isset($registerTitle)):
            echo $registerTitle;
        elseif(isset($adminDashboardTitle)):
            echo $adminDashboardTitle;
        elseif(isset($changePasswordTitle)):
            echo $changePasswordTitle;
        elseif(isset($notificationsTitle)):
            echo $notificationsTitle;
        else:
            echo 'Admin login';
        endif;
        ?>
    </title>
    <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body>

<?= $this->renderSection('content') ?>

<script src="<?= base_url('assets/js/jquery-3.6.3.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js')?>"></script>
<script src="<?= base_url('assets/vendors/chart.js/Chart.min.js')?>"></script>
<script src="<?= base_url('assets/js/jquery.cookie.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/off-canvas.js')?>"></script>
<script src="<?=base_url('assets/js/hoverable-collapse.js')?>"></script>
<script src="<?=base_url('assets/js/misc.js')?>"></script>
<script src="<?= base_url('assets/js/todolist.js')?>"></script>
<script src="<?= base_url('assets/js/sacco-admin.js')?>"></script>
</body>
</html>