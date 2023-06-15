
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
                    <span></span>SupperAdmin/Transaction Report <i class="mdi mdi-table-large icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="set-buyer-commission-container">
                <h5 class="buyer-commission-container"><span><i class="mdi mdi-table-large buyer-commission"></i></span> View Transactions</h5>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th> Seller's Membership </th>
                                <th> Buyer's Membership </th>
                                <th> Buyer's Phone </th>
                                <th> Sellers's Phone </th>
                                <th> Shares </th>
                                <th> Sacco </th>
                                <th> Value </th>
                                <th> Bid Amount </th>
                                <th> Status </th>
                                <th> Date </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($viewTransactions)): ?>
                            <?php foreach ($viewTransactions as $transaction): ?>
                                <tr>
                                    <td><?= $transaction['seller_membership_number'] ?></td>
                                    <td><?= $transaction['buyer_membership_number'] ?></td>
                                    <td><?= $transaction['buyer_phone'] ?></td>
                                    <td><?= $transaction['seller_phone'] ?></td>
                                    <td><?= $transaction['shares_on_sale'] ?></td>
                                    <td><?= $transaction['name'] ?></td>
                                    <td><?= $transaction['shares_on_sale'] ?></td>
                                    <td><?= $transaction['bid_amount'] ?></td>
                                    <?php if($transaction['bid_amount'] == $transaction['amount']): ?>
                                        <td><span class="badge badge-success" style="border-radius: 50%; width: 30px; height: 30px; display: grid; place-items: center"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></td>
                                    <?php else: ?>
                                        <td><span class="badge badge-danger" style="border-radius: 50%; width: 30px; height: 30px; display: grid; place-items: center"><i class="mdi mdi-close-circle-outline"></i></span></td>
                                    <?php endif; ?>
                                    <td><?= $transaction['transactionDate'] ?></td>
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

