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
                    <span></span>Dashboard/Approved Shares <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
            <h5 class="buyer-commission-container"><span><i class="mdi mdi-close-circle buyer-commission"></i></span>Rejected Shares</h5>
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
                                <th> Reason </th>
                                <th> Date Created </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($rejectedShares)): ?>
                                <?php foreach($rejectedShares as $rejectedShare): ?>
                                    <tr>
                                        <td>
                                            <?= ucfirst($rejectedShare['fname'] ). ' ' . ucfirst($rejectedShare['lname']) ?>
                                        </td>
                                        <td> <?= ucfirst($rejectedShare['name']) ?> </td>
                                        <td> <?= $rejectedShare['membership_number'] ?> </td>
                                        <td> <?= $rejectedShare['shares_on_sale'] ?> </td>
                                        <td> <?= $rejectedShare['reason'] ?> </td>
                                        <?php $time = date('d M Y', strtotime($rejectedShare['created_at'])) ?>
                                        <td> <?= $time ?> </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-danger text-center" role="alert">
                                        No Rejected Shares..
                                    </div>
                                </td>
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

