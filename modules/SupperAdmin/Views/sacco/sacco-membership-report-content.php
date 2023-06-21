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
                    <span>Dashboard/Membership Reports <i
                                class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i></span>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <h5 class="buyer-commission-container"><i class="mdi mdi-apps buyer-commission"></i>Membership Reports</h5>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-sm" style="width:100%">
                            <thead>
                            <tr>
                                <th> Name</th>
                                <th> Email</th>
                                <th> Phone</th>
                                <th> Sacco</th>
                                <th> ID Number</th>
                                <th> Status</th>
                                <th> Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if (!empty($saccoMembers)): ?>
                                <?php foreach ($saccoMembers as $membershipReport): ?>
                                    <tr>
                                        <td> <?= ucfirst($membershipReport['fname']) . ' ' . ucfirst($membershipReport['lname']) ?> </td>
                                        <td> <?= $membershipReport['email'] ?> </td>
                                        <td> <?= $membershipReport['phone'] ?> </td>
                                        <td> <?= ucfirst($membershipReport['name']) ?> </td>
                                        <td> <?= $membershipReport['id_number'] ?> </td>
                                        <td>

                                            <?php if ($membershipReport['status'] == 0): ?>
                                                <span class="badge badge-gradient-danger">Pending</span>
                                            <?php elseif ($membershipReport['status'] == 1): ?>
                                                <span class="badge badge-gradient-success">Approved</span>
                                            <?php endif; ?>
                                        </td>
                                        <td> <?= date('d M Y', strtotime($membershipReport['created_at'])) ?> </td>
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

