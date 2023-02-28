<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Manage Shares
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
                                <th> Name </th>
                                <th> Phone Number </th>
                                <th> Membership Number </th>
                                <td> Shares Amount </td>
                                <td> Cost </td>
                                <td> Total </td>
                                <td> Date </td>
                                <td> Status </td>
                                <td> Action </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($shares as $share): ?>
                                <tr>
                                    <td><?= $share['fname'] .' '. $share['lname'] ?></td>
                                    <td><?= $share['phone'] ?></td>
                                    <td><?= $share['membership_number'] ?></td>
                                    <td><?= $share['shares_amount'] ?></td>
                                    <td><?= $share['cost'] ?></td>
                                    <td><?= $share['total'] ?></td>
                                    <td><?= $share['created_at'] ?></td>
                                    <td><?= $share['is_verified'] ?></td>
                                    <td>
                                        <a href="<?= 'edit-share/' . $share['uuid'] ?>" class="btn btn-gradient-primary btn-rounded btn-icon">
                                            <i class="mdi mdi-tooltip-edit"></i>
                                        </a>
                                        <a href="<?= 'delete-share/' . $share['uuid'] ?>" class="btn btn-gradient-danger btn-rounded btn-icon">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

