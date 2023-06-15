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
        elseif(isset($dashboardTitle)):
            echo $dashboardTitle;
        elseif(isset($registerSaccoTitle)):
            echo $registerSaccoTitle;
        elseif(isset($listUserTitle)):
            echo $listUserTitle;
        elseif(isset($userLogInActivitiesTitle)):
            echo $userLogInActivitiesTitle;
        elseif(isset($approvedSharesTitle)):
            echo $approvedSharesTitle;
        elseif(isset($notApprovedSharesTitle)):
            echo $notApprovedSharesTitle;
        elseif(isset($manageSharesTitle)):
            echo $manageSharesTitle;
        elseif(isset($editUserTitle)):
            echo $editUserTitle;
        else:
            echo 'admin';
        endif;
        ?>
    </title>
    <link rel="icon" type="image/png" href="<?= base_url('favicon.PNG') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css')?>">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link href="<?= base_url('assets/css/dataTables.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
    <link href="<?= base_url('assets/css/select2.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/supperAdmin.css') ?>">
</head>
<body>

<?= $this->renderSection('content') ?>

<script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js')?>"></script>
<script src="<?= base_url('assets/vendors/chart.js/Chart.min.js')?>"></script>
<script src="<?= base_url('assets/js/jquery.cookie.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/js/jq.validation.js')?>"></script>
<script src="<?= base_url('assets/js/off-canvas.js')?>"></script>
<script src="<?=base_url('assets/js/hoverable-collapse.js')?>"></script>
<script src="<?=base_url('assets/js/misc.js')?>"></script>
<script src="<?= base_url('assets/js/todolist.js')?>"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="<?= base_url('assets/js/dataTables.min.js'); ?>"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script src="<?= base_url('assets/js/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/vfs_fonts.js'); ?>"></script>
<script src="<?=base_url('assets/js/select2.min.js')?>"></script>
<script src="<?= base_url('assets/js/admin.js')?>"></script>
<script src="<?= base_url('assets/js/supperAdminStepper.js')?>"></script>
<?php $this->renderSection("set-buyer-commission") ?>
<?php $this->renderSection("set-sacco-commission") ?>
<?php $this->renderSection('set-seller-commission') ?>
<?php $this->renderSection('share-statistics') ?>
<?php $this->renderSection('manage-transaction-script') ?>
<script>
    <?php if(session()->getFlashdata('success')) : ?>
    $(document).ready(function () {
        alertify.set('notifier','position', 'bottom-right');
        alertify.success("<?= session()->getFlashdata('success') ?>");
    });
    <?php elseif(session()->getFlashdata('error')) : ?>
    $(document).ready(function () {
        alertify.set('notifier','position', 'bottom-right');
        alertify.error("<?= session()->getFlashdata('error') ?>");
    });
    <?php endif; ?>
</script>
</body>
</html>