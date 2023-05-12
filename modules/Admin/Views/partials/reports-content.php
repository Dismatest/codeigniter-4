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
    <h5 class="text-center pb-2">Transaction Reports</h5>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th> Seller's Name </th>
                                <th> Buyer's Name </th>
                                <th> Shares </th>
                                <th> Value </th>
                                <th> Amount </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if  (isset($transactions) && !empty($transactions)): ?>
                            <?php foreach ($transactions as $transaction): ?>
                                    <tr>
                                                <td><?= $transaction['seller_fname'] .' '. $transaction['seller_lname']?></td>
                                                <td><?= $transaction['buyer_fname'] .' '. $transaction['buyer_lname']?></td>
                                                <td><?= $transaction['shares_on_sale'] ?></td>
                                                <td><?= $transaction['total'] ?></td>
                                                <td><?= $transaction['amount'] ?></td>
                                        <?php if ($transaction['status'] == 0): ?>
                                            <td><label class="badge badge-gradient-warning">pending</label></td>
                                        <?php else: ?>
                                            <td><label class="badge badge-gradient-success">complete</label></td>
                                        <?php endif; ?>
                                                <td>
                                                    <label class="badge badge-gradient-success view-btn" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $transaction['transaction_id'] ?>">View</label>
                                                    <a href="<?= 'reports/mark_as_complete/'.$transaction['transaction_id'] ?>" class="badge badge-gradient-primary" style="cursor: pointer">mark as complete</a>
                                                </td>
                                    </tr>
                                            <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" class="text-center">No transactions found</td>
                                </tr>
                                        <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

<!--    modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Transaction Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="border: 1px solid black; border-radius: 5px; padding: 10px;">
                        <table style="border-collapse: collapse; width: 100%;">
                            <tr>
                                <th style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;"></th>
                                <th style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;"></th>
                            </tr>
                            <tr>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;">Seller's Name</td>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;" id="seller-name"></td>
                            </tr>
                            <tr>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;">Buyer's Name</td>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;" id="buyer-name"></td>
                            </tr>
                            <tr>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;">Shares Sold</td>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;" id="shares-sold"></td>
                            </tr>
                            <tr>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;">Shares Value</td>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;" id="share-value"></td>
                            </tr>
                            <tr>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;">Amount Paid</td>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;" id="amount"></td>
                            </tr>
                            <tr>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;">Mpesa Receipt Number</td>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;" id="mpesaReceiptNumber"></td>
                            </tr>
                            <tr>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;">Date Paid</td>
                                <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;" id="date"></td>
                            </tr>
                        </table>

                    </div>
                </div>
        </div>
    </div>

<!--    end of modal-->

    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

