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

                        <table id="manage-transaction" class="table table-striped" style="width:100%;">
                            <thead>
                            <tr>
                                <th> Seller's Name </th>
                                <th> Shares </th>
                                <th> Value </th>
                                <th> Bid Amount </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if  (!empty($bids)): ?>
                            <?php foreach ($bids as $bid): ?>
                                    <tr>
                                                <td><?= $bid['seller_fname'] .' '. $bid['seller_lname']?></td>
                                                <td><?= $bid['shares_on_sale'] ?></td>
                                                <td><?= $bid['total'] ?></td>
                                                <td><?= $bid['bid_amount'] ?></td>
                                                <td>
                                                    <a href="<?= 'reports/mark_as_complete/'.$bid['bid_id'] ?>" class="badge badge-gradient-primary" style="cursor: pointer">view</a>
                                                </td>
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

