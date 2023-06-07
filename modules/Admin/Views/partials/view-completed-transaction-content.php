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
                    <span>Admin/Completed Transactions</span> <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <h5 class="text-center pb-2">View CompletedTransaction Reports</h5>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="manage-transaction" class="table table-striped" style="width:100%;">
                            <thead>
                            <tr>
                                <th> Seller's Name </th>
                                <th> Buyer's Name </th>
                                <th> Shares </th>
                                <th> Value </th>
                                <th> Amount </th>
                                <th> Status </th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if  (!empty($transactions)): ?>
                            <?php foreach ($transactions as $transaction): ?>
                                    <tr>
                                                <td><?= $transaction['seller_fname'] .' '. $transaction['seller_lname']?></td>
                                                <td><?= $transaction['buyer_fname'] .' '. $transaction['buyer_lname']?></td>
                                                <td><?= $transaction['shares_on_sale'] ?></td>
                                                <td><?= $transaction['total'] ?></td>
                                                <td><?= $transaction['amount'] ?></td>
                                        <?php if ($transaction['status'] == '1'): ?>
                                            <td><label class="badge badge-gradient-success">complete</label></td>
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

