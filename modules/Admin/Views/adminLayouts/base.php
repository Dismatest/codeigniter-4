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
    <link rel="icon" type="image/png" href="<?= base_url('favicon.PNG') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css')?>">
    <!-- dataTables link -->
    <link href="<?= base_url('assets/css/dataTables.min.css'); ?>" rel="stylesheet">
    <!-- end of dataTables link -->
    <link rel="stylesheet" href="<?= base_url('assets/css/select2.min.css')?>">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/sacco.css') ?>">
</head>
<body>

<?= $this->renderSection('content') ?>

<script src="<?= base_url('assets/js/jquery-3.6.3.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js')?>"></script>
<script src="<?= base_url('assets/vendors/chart.js/Chart.min.js')?>"></script>
<script src="<?= base_url('assets/js/jquery.cookie.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/off-canvas.js')?>"></script>
<script src="<?=base_url('assets/js/hoverable-collapse.js')?>"></script>
<script src="<?=base_url('assets/js/jq.validation.js')?>"></script>
<script src="<?=base_url('assets/js/select2.min.js')?>"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script src="<?= base_url('assets/js/dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/vfs_fonts.js'); ?>"></script>

<script src="<?=base_url('assets/js/misc.js')?>"></script>
<script src="<?= base_url('assets/js/todolist.js')?>"></script>
<script src="<?= base_url('assets/js/sacco-admin.js')?>"></script>
<script>

    <?php if(session()->getFlashdata('success')) : ?>
    $(document).ready(function () {
        alertify.set('notifier','position', 'bottom-right');
        alertify.success("<?= session()->getFlashdata('success') ?>");
    });
    <?php elseif(session()->getFlashdata('fail')) : ?>
    $(document).ready(function () {
        alertify.set('notifier','position', 'bottom-right');
        alertify.error("<?= session()->getFlashdata('fail') ?>");
    });
    <?php endif; ?>

</script>
<?= $this->renderSection('admin-post-shares-script') ?>
<?= $this->renderSection('admin-update-profile-script') ?>
<?= $this->renderSection('manage-transaction-script') ?>
<?= $this->renderSection('completed-transactions-script') ?>
<?= $this->renderSection('view-pending-transaction-script') ?>
<?= $this->renderSection('bids-report-script') ?>
<?= $this->renderSection('view-admin-shares-sold-statistics-script') ?>
<?= $this->renderSection('sacco-membership-script') ?>
<?= $this->renderSection('members-report-script') ?>
</body>
</html>