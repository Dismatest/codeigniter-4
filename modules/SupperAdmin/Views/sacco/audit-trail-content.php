<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
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

