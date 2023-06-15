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
                    <span>Dashboard/Email Audit Trail <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i></span>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <h5 class="buyer-commission-container"><i class="mdi mdi-dice-d4 buyer-commission"></i>Email Logs</h5>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-sm" style="width:100%">
                            <thead>
                            <tr>
                                <th> Recipient Name</th>
                                <th> Recipient Email</th>
                                <th> Title</th>
                                <th>Role</th>
                                <th> Status</th>
                                <th> Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($email_logs)): ?>
                            <?php foreach ($email_logs as $email_log): ?>
                                <tr>
                                    <td><?= $email_log['fname'] ?></td>
                                    <td><?= $email_log['email'] ?></td>
                                    <td><?= $email_log['message_title'] ?></td>
                                    <td><?= $email_log['role'] ?></td>
                                    <td>
                                        <?php if($email_log['status'] == 1): ?>
                                            <span class="badge badge-success">Sent</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Failed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('Y-m-d', strtotime($email_log['created_at'])) ?></td>
                                </tr>
                               <?php endforeach; ?>
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

