<?php $this->extend("Modules\Admin\Views\adminLayouts\base");?>
<?php $this->section('content');?>
<div class="container-scroller">
    <!--    the start of the admin navbar component -->
    <?= $this->include('Modules\Admin\Views\includes\navbar'); ?>
    <!--    end of the admin navbar component -->
    <div class="container-fluid page-body-wrapper">
        <?= $this->include('Modules\Admin\Views\includes\sidebar');?>
        <div class="main-panel">
            <?= $this->include('Modules\Admin\Views\partials\reports-content');?>
        </div>
    </div>
</div>
<?php $this->endSection();?>

