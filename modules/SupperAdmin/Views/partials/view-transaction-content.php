
<div class="content-wrapper">
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
                                        <?php if ($transaction['status'] == 0): ?>
                                            <td><label class="badge badge-gradient-warning">pending</label></td>
                                        <?php else: ?>
                                            <td><label class="badge badge-gradient-success">complete</label></td>
                                        <?php endif; ?>
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

