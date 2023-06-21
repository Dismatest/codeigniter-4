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
                    <span>Admin/Transaction Reports</span> <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <h5 class="text-center pb-2">View Seller's Bids Report Reports</h5>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="bidsReport" class="table table-striped" style="width:100%;">
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

                            <?php if (!empty($bids)): ?>
                                <?php foreach ($bids as $bidsReport): ?>
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
                                               data-bs-target="#displayBidsModal"
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

<div class="modal fade" id="displayBidsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-12 grid-margin">
                        <h5 class="buyer-commission-container">
                            <span><i class="mdi mdi-apps buyer-commission"></i></span>View Bids Report
                            <span class="p-5" style="color: green; display: none;" id="success">approved</span>
                            <span class="p-5" style="color: red; display: none;" id="error"></span>
                        </h5>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="bidsReportModal">
                                        <thead>
                                        <tr>
                                            <th> Buyer Name</th>
                                            <th> Member Number</th>
                                            <th> Shares</th>
                                            <th> Value</th>
                                            <th> Bid Amount</th>
                                            <th> Status</th>
                                            <th> Action</th>
                                            <th> Date </th>
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
