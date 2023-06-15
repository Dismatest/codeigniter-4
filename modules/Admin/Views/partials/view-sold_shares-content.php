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
                    <span></span>Admin/Shares Sold <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="set-buyer-commission-container">
            <h5 class="buyer-commission-container"><i class="mdi mdi-table-large buyer-commission"></i> View Sold Shares <span style="margin-left: 20px;"><a href="<?= base_url('admin/view-statistics')?>">view sold shares statistics</a></span></h5>
        </div>
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="manage-shares" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th> Owner </th>
                                <th> Phone Number </th>
                                <th> Member Number </th>
                                <th> Sacco </th>
                                <td> Shares Amount </td>
                                <td> Value </td>
                                <td> Date </td>
                                <td> Status </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($shares)): ?>
                                <?php foreach ($shares as $share): ?>
                                    <tr>
                                        <td><?= $share['fname'] .' '. $share['lname'] ?></td>
                                        <td><?= $share['phone'] ?></td>
                                        <td><?= $share['membership_number'] ?></td>
                                        <td><?= $share['name'] ?></td>
                                        <td><?= $share['shares_on_sale'] ?></td>
                                        <td>Ksh: <?= $share['total'] ?></td>
                                        <?php if(!empty($time)): ?>
                                            <td><?= $time ?></td>
                                        <?php endif; ?>
                                        <?php if ($share['is_verified'] == 3): ?>
                                            <td><label class="badge badge-gradient-success">sold</label></td>
                                        <?php else: ?>
                                            <td></td>
                                        <?php endif; ?>
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

