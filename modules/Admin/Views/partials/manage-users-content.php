<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Admin Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span>Admin/Manage New Members</span> <i
                            class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <h5 class="text-center p-2">Manage New Members</h5>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th> Name</th>
                                <th> Phone Number</th>
                                <th> ID Number</th>
                                <td> Date</td>
                                <td> Status</td>
                                <td> Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= ucfirst($user['fname']) . ' ' . ucfirst($user['lname']) ?></td>
                                        <td><?= $user['phone'] ?></td>
                                        <td><?= $user['id_number'] ?></td>
                                        <?php if (!empty($date_created)) : ?>
                                            <td><?= $date_created ?></td>
                                            <td> <button class="btn btn-warning btn-sm">Pending</button></td>
                                        <?php endif; ?>
                                        <td>
                                            <button class="btn btn-success btn-sm approve-btn" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop" data-id="<?= $user['membership_id'] ?>">
                                                Approve
                                            </button>
                                            <a class="text-danger"
                                               href="<?= 'delete-user-shares/' . $user['membership_id'] ?>"
                                               style="font-size: 20px;">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
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

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Approve New Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <span class="text-success" id="member-success" style="padding-left: 20px; display: none;"></span>
            <span class="text-danger" id="member-error" style="padding-left: 20px; display: none;"></span>
            <div class="modal-body">
                <table class="table table-striped" id="membership-data">
                    <thead>
                    <tr>
                        <th> Name</th>
                        <th> Phone Number</th>
                        <th> ID Number</th>
                    </thead>
                    <tbody>
                    <tr>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <?php if(!empty($user['membership_id'])): ?>
                <button type="button" class="btn btn-primary approve-membership" data-id="<?= $user['membership_id'] ?>">Approve Member</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

