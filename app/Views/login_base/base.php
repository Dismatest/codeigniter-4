<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css')?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>" />
    <title>login</title>
</head>
<body>

    <?= $this->renderSection('login') ?>

<script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js')?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url('assets/vendors/chart.js/Chart.min.js')?>"></script>
    <script src="<?= base_url('assets/js/jquery.cookie.js')?>" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url('assets/js/off-canvas.js')?>"></script>
    <script src="<?=base_url('assets/js/hoverable-collapse.js')?>"></script>
    <script src="<?=base_url('assets/js/misc.js')?>"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="<?= base_url('assets/js/dashboard.js')?>"></script>
    <script src="<?= base_url('assets/js/todolist.js')?>"></script>
    <!-- End custom js for this page -->
</body>
</html>