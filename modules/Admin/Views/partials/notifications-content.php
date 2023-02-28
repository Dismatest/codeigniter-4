<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Notifications
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th> Id </th>
                                <th> Notification </th>
                                <th> Date </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($notifications) && !empty($notifications)) : ?>
                            <?php foreach ($notifications as $notification) : ?>
                                <tr>
                                    <td><?= $notification['notification_id']; ?></td>
                                    <td><?= $notification['message']; ?></td>
                                    <td><?= $notification['created_at']; ?></td>
                                    <td class="d-flex">
                                        <a href="<?= base_url('admin/read-notification/' . $notification['notification_id']); ?>"
                                           class="btn btn-gradient-success btn-rounded btn-icon" style="width: 20px; height: 20px; display: grid; place-items: center">
                                            <i class="mdi mdi-check"></i>
                                        </a>
                                        <a href="<?= base_url('admin/delete-notification/' . $notification['notification_id']); ?>"
                                           class="btn btn-gradient-success btn-rounded btn-icon" style="width: 20px; height: 20px; display: grid; place-items: center; margin: 0 0 0 4px;">
                                            <i class="mdi mdi-delete-forever"></i>
                                        </a>
                                    </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No notifications received yet!!</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

