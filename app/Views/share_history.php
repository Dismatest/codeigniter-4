<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container">
    <div class="row pt-5 pb-5">

        <?= $this->include('includes/saved-sidebar.php'); ?>

        <div class="col-md-7">
            <div class="main-saved-container">
                <div style="padding-bottom: 10px;">
                <div class="profile-container-content">
                    <h6 class="selling-history">Shares History</h6>
                    <span id="example"></span>
                </div>
                <div class="dashboardDataTable table-responsive-sm">

                    <table id="dashboardDataTable" class="table table-responsive{-sm|-xl}">
                        <thead>
                        <tr>
                            <th>Buyer Name</th>
                            <th>Shares sold</th>
                            <th>Cost per share</th>
                            <th>Total share value</th>
                            <th>Sacco</th>
                        </tr>
                        </thead>
                        <tbody>

                            <?php if(isset($user_share_history) && !empty($user_share_history)): ?>
                            <?php foreach ($user_share_history as $share): ?>
                        <tr>
                            <td><?= $share['buyer_fname'] .' '. $share['buyer_lname'] ?></td>
                            <td><?= $share['shares_on_sale'] ?></td>
                            <td><?= $share['cost_per_share'] ?></td>
                            <td><?= $share['total'] ?></td>
                            <td><?= $share['name'] ?></td>
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
</div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>
<?= $this->endSection(); ?>
