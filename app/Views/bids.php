<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>
<?= $this->include('includes/navbar.php'); ?>


<div class="container pt-5 pb-5">
    <div class="row">

        <?php if(!empty($accepted_bids)): ?>
            <div class="container mb-4" id="agreement-container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="alert alert-success" role="alert" id="success1" style="display:none;">
                            <p id="success-message1"></p>
                        </div>

                        <div class="agreement-title">
                            <h3 class="text-center">Agreement non-disclosure form: Agree to our terms and conditions before you hit buy now.</h3>
                            <div class="pdf-file">
                                <div style="display: flex; justify-content: center; align-items: center">
                                    <span class="download-agreement-form"><i class="fas fa-arrow-down"></i></span>
                                    <a href="<?= base_url().'/uploads/agreement-files/' .$pdf_view ?>" target="_blank">Download</a>
                                </div>

                                <div class="terms-of-use">
                                    <span>Terms and conditions</span>
                                    <input type="checkbox" id="terms-checkbox">
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>


        <div class="col-md-12">
            <div class="table-responsive-sm">
                <table id="dashboardDataTable" class="table-sm bid-table">
                    <thead>

                    <tr>
                        <th>Membership Number</th>
                        <th>Date</th>
                        <th>Sacco</th>
                        <th>Share Value</th>
                        <th>Bid Value</th>
                        <th>Action/Status</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php if(!empty($bids)) : ?>
                        <?php foreach ($bids as $bid): ?>
                            <tr>
                                <td><?= $bid['membership_number'] ?></td>
                                <td>date</td>
                                <td><?= $bid['name'] ?></td>
                                <td>ksh. <?= $bid['total'] ?></td>
                                <td>ksh. <?= $bid['bid_amount'] ?></td>
                                <td class="action-links">
                                    <a class="reject-link" href="<?= 'my_bids/reject/'.$bid['bid_id'] ?>">Reject</a>
                                    <a class="accept-link" href="<?= 'my_bids/accept/'.$bid['bid_id'] ?>">Accept</a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    <?php elseif(!empty($accepted_bids) || !empty($rejected_bids)): ?>
                        <?php foreach ($accepted_bids as $accepted_bid): ?>
                            <tr>
                                <td><?= $accepted_bid['membership_number'] ?></td>
                                <td>date</td>
                                <td><?= ucfirst($accepted_bid['name']) ?></td>
                                <td>ksh. <?= $accepted_bid['total'] ?></td>
                                <td>ksh. <?= $accepted_bid['bid_amount'] ?></td>
                                <?php if($accepted_bid['action'] == '1'): ?>
                                    <td style="display: flex; justify-content: center; align-items: center">
                                        <a href="<?= base_url('/payment/initiate_payment?share_id='.urlencode($accepted_bid['uuid']).'&total='.urlencode($accepted_bid['bid_amount'])) ?>" class="accept-link" id="payment-link">Buy Now</a>
                                        <a class="reject-accept-delete" data-id="<?= $accepted_bid['share_on_sale_id'] ?>"><i class="fas fa-trash"></i></a>
                                        <span id="error-message"></span>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        <?php foreach ($rejected_bids as $rejected_bid): ?>
                            <tr>
                                <td><?= $rejected_bid['membership_number'] ?></td>
                                <td>date</td>
                                <td><?= $rejected_bid['name'] ?></td>
                                <td>ksh. <?= $rejected_bid['total'] ?></td>
                                <td>ksh. <?= $rejected_bid['bid_amount'] ?></td>
                                <?php if($rejected_bid['action'] == '2'): ?>
                                    <td style="display: flex; justify-content: center; align-items: center;">
                                        <button class="reject-link">Rejected</button>
                                        <a class="accept-link" href="<?= 'share/'.$rejected_bid['uuid'] ?>">Bid Again</a>
                                        <a class="reject-accept-delete" id="rejected-bid-delete" data-id="<?= $rejected_bid['share_on_sale_id'] ?>"><i class="fas fa-trash"></i></a>
                                    </td>
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


<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>

<?= $this->endSection();?>
