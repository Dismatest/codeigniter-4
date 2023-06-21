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
    <h5 class="text-center p-2">Members Report</h5>
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
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($members)): ?>
                                <?php foreach ($members as $member): ?>
                                    <tr>
                                        <td><?= ucfirst($member['fname']) . ' ' . ucfirst($member['lname']) ?></td>
                                        <td><?= $member['phone'] ?></td>
                                        <td><?= $member['id_number'] ?></td>
                                        <td><?= date('d M Y', strtotime($member['updated_at'])) ?></td>

                                        <td>
                                            <button class="btn btn-success btn-sm">Approved</button>
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
            <div class="modal-body">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary approve-membership"
                >Approve Member
                </button>

            </div>
        </div>
    </div>
</div>

