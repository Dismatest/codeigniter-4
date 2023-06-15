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
                    <span></span>Dashboard/shares report <i
                            class="mdi mdi-marker-check icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
            <h5 class="buyer-commission-container"><span><i class="mdi mdi-pocket buyer-commission"></i></span>Shares
                Report</h5>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th> Owner</th>
                                <th> Member Number</th>
                                <th> Sacco</th>
                                <th> Shares</th>
                                <th> Value</th>
                                <th> Bid Amount</th>
                                <th> Transactions Status</th>
                                <th> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($shares)): ?>
                                <?php foreach ($shares as $share): ?>
                                    <tr>
                                        <td>
                                            <?= ucfirst($share['fname']) . ' ' . ucfirst($share['lname']) ?>
                                        </td>
                                        <td> <?= $share['membership_number'] ?> </td>
                                        <td> <?= ucfirst($share['name']) ?> </td>
                                        <td> <?= $share['shares_on_sale'] ?> </td>
                                        <td> ksh <?= $share['total'] ?> </td>
                                        <td> ksh <?= $share['bid_amount'] ?> </td>
                                            <?php if ($share['bid_amount'] == $share['amount']): ?>
                                            <td>
                                            <span class="badge badge-success"
                                                  style="border-radius: 50%; width: 30px; height: 30px; display: grid; place-items: center"><i
                                                        class="mdi mdi-checkbox-marked-circle-outline"></i></span>
                                            </td>
                                            <?php else: ?>
                                            <td>
                                                <span class="badge badge-danger"
                                                      style="border-radius: 50%; width: 30px; height: 30px; display: grid; place-items: center"><i
                                                            class="mdi mdi-close-circle-outline"></i></span>
                                            </td>
                                            <?php endif; ?>

                                            <?php if ($share['bid_amount'] == $share['amount']): ?>
                                            <td>
                                                <a style="text-decoration: none; font-size: 12px;" class="badge-success p-1" href="<?= base_url() .'/supperAdmin/shares-report/mark-sold/' .$share['uuid'] ?>">Mark as sold</a>
                                            </td>
                                          <?php else: ?>
                                          <td></td>
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

