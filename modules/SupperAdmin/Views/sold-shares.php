<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
<?php $this->section('content');?>
    <div class="container-scroller">
        <!--    the start of the admin navbar component -->
        <?= $this->include('Modules\SupperAdmin\Views\includes\navbar.php'); ?>
        <!--    end of the admin navbar component -->
        <div class="container-fluid page-body-wrapper">
            <?= $this->include('Modules\SupperAdmin\Views\includes\sidebar.php');?>
            <div class="main-panel">
                <?= $this->include('Modules\SupperAdmin\Views\partials\view-shares-sold-content.php');?>
            </div>
        </div>
    </div>
<?php $this->endSection();?>
<?php $this->section('manage-transaction-script');?>
<script>
    $(document).ready(function(){
        $('#manage-shares').DataTable();
    });
</script>
<?php $this->endSection();?>
