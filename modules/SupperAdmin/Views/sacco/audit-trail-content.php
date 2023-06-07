<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> SupperAdmin Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Dashboard/Audit Trail <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <h5 class="buyer-commission-container"><span><i class="mdi mdi-dice-d4 buyer-commission"></i></span>System Error Logs</h5>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th> Error </th>
                                <th> Level </th>
                                <th> Date </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if  (isset($auditTrails) && !empty($auditTrails)): ?>
                            <?php foreach ($auditTrails as $audit): ?>
                                <tr>
                                    <td><?= $audit['error'] ?></td>
                                    <td><?= $audit['level'] ?></td>
                                    <td><?= $audit['created_at'] ?></td>
                                    <td>
                                        <a href="<?= 'delete-audit-trail/'.$audit['error_id'] ?>" >
                                            <i class="mdi mdi-delete" style="font-size: 22px; color: grey;"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" class="text-center">No Trail Found</td>
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

