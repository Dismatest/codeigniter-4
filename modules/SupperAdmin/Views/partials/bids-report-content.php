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
                    <span></span>Dashboard/bids report <i class="mdi mdi-apps icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
            <h5 class="buyer-commission-container"><span><i class="mdi mdi-apps buyer-commission"></i></span>Bids Report
            </h5>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th> Seller Name</th>
                                <th> Member Number</th>
                                <th> Sacco</th>
                                <th> Shares</th>
                                <th> Value</th>
                                <th> Bidders</th>
                                <th> Action</th>
                                <th> Date Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($bidsReports)): ?>
                                <?php foreach ($bidsReports as $bidsReport): ?>
                                    <tr>
                                        <td>
                                            <?= ucfirst($bidsReport['fname']) . ' ' . ucfirst($bidsReport['lname']) ?>
                                        </td>
                                        <td> <?= ucfirst($bidsReport['name']) ?> </td>
                                        <td> <?= $bidsReport['membership_number'] ?> </td>
                                        <td> <?= $bidsReport['shares_on_sale'] ?> </td>
                                        <td> <?= 'Ksh ' . $bidsReport['total'] ?> </td>
                                        <td><span class="badge-gradient-success"
                                                  style="width: 20px; height: 20px; border-radius: 50%; display: grid; place-items: center"><?= $bidsReport['bidders_count'] ?></span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm view-bids" data-bs-toggle="modal"
                                               data-bs-target="#confirmDelete"
                                               data-id="<?= $bidsReport['uuid'] ?>">View</a>
                                        </td>
                                        <td> <?= date('d M Y', strtotime($bidsReport['created_at'])) ?> </td>
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

<div class="modal fade" id="confirmDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-12 grid-margin">
                        <h5 class="buyer-commission-container"><span><i
                                        class="mdi mdi-apps buyer-commission"></i></span>View Bids Report</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="bidsReport">
                                        <thead>
                                        <tr>
                                            <th> Buyer Name</th>
                                            <th> Member Number</th>
                                            <th> Shares</th>
                                            <th> Value</th>
                                            <th> Bid Amount</th>
                                            <th> Status</th>
                                            <th> Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

