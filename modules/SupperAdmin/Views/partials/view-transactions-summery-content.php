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
                    <span></span>Dashboard/Transactions Report <i class="mdi mdi-table-large icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
            <h5 class="buyer-commission-container"><span><i class="mdi mdi-table-large buyer-commission"></i></span>Transactions Summery</h5>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="transaction-history-main-table">
                            <thead>
                            <tr>
                                <th> Sacco </th>
                                <th> Total Amount (ksh) </th>
                                <th> History </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($transactionsSummery)): ?>
                            <?php foreach ($transactionsSummery as $transaction): ?>
                                <tr>
                                    <td><?= $transaction['name'] ?></td>
                                    <td><?= 'Ksh '.$transaction['total_amount'] ?></td>
                                    <td><button class="btn btn-success btn-sm transaction-history" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $transaction['sacco_id']?>">View Transaction History</button></td>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Transaction History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" id="view-transaction-history">
                    <thead>
                    <tr>
                        <th scope="col">Sacco</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Transaction Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
