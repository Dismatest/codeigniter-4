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
                    <span></span>Dashboard/Approved Shares <i class="mdi mdi-marker-check icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
            <h5 class="buyer-commission-container"><span><i class="mdi mdi-pocket buyer-commission"></i></span>Approved Shares</h5>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th> Posted By </th>
                                <th> Sacco </th>
                                <th> Member Number </th>
                                <th> Shares </th>
                                <th> Approval </th>
                                <th> Date Created </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($users) && !empty($users)): ?>
                                <?php foreach($users as $user): ?>
                                    <tr>
                                        <td>
                                            <?= ucfirst($user['fname'] ). ' ' . ucfirst($user['lname']) ?>
                                        </td>
                                        <td> <?= ucfirst($user['name']) ?> </td>
                                        <td> <?= $user['membership_number'] ?> </td>
                                        <td> <?= $user['shares_on_sale'] ?> </td>
                                        <td>
                                            <?php if($user['is_verified'] == 1): ?>
                                                <label class="badge badge-gradient-success">YES</label>
                                            <?php endif; ?>
                                        </td>
                                        <?php $time = date('d M Y', strtotime($user['created_at'])) ?>
                                        <td> <?= $time ?> </td>

                                    </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger text-center" role="alert">
                                            No Approved Shares Found Yet..
                                        </div>
                                    </td>
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

