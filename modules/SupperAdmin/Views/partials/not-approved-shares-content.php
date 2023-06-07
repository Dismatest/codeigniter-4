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
                    <span></span>Dashboard/Pending Approval <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
            <h5 class="buyer-commission-container"><span><i class="mdi mdi-shield-outline buyer-commission"></i></span>Pending Approval</h5>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th> Posted By </th>
                                <th> Sacco </th>
                                <th> Membership Number </th>
                                <th> Shares </th>
                                <th> Date Created </th>
                                <th> Approval </th>
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
                                        <?php $time = date('d M Y', strtotime($user['created_at'])) ?>
                                        <td> <?= $time ?> </td>
                                        <td>
                                            <?php if($user['is_verified'] == 0): ?>
                                                <label class="badge badge-gradient-danger">NO</label>
                                            <?php endif; ?>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-danger text-center" role="alert">
                                        All Shears has Been Approved..
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

