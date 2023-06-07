
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
                    <span></span>SupperAdmin/Transaction Report <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                                <th> Seller's Name </th>
                                <th> Buyer's Name </th>
                                <th> Shares </th>
                                <th> Value </th>
                                <th> Amount </th>
                                <th> Status </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if  (isset($viewTransactions) && !empty($viewTransactions)): ?>
                                <?php foreach ($viewTransactions as $transaction): ?>
                                    <tr>
                                        <td><?= $transaction['seller_fname'] .' '. $transaction['seller_lname']?></td>
                                        <td><?= $transaction['buyer_fname'] .' '. $transaction['buyer_lname']?></td>
                                        <td><?= $transaction['shares_on_sale'] ?></td>
                                        <td><?= $transaction['total'] ?></td>
                                        <td><?= $transaction['amount'] ?></td>
                                        <td><label class="badge badge-gradient-success">complete</label></td>
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

    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

