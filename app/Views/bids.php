<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>
<?= $this->include('includes/navbar.php'); ?>


<div class="container pt-5 pb-5">
    <div class="row">
        <div class="col-md-12">
            <table id="bid-table" class="table-responsive bid-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Member Name</th>
                    <th>Date</th>
                    <th>Sacco</th>
                    <th>Share Value</th>
                    <th>Bid Value</th>
                    <th>Action/Status</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($bids)) : ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($bids as $bid): ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= ucfirst($bid['fname']) .' '. ucfirst($bid['lname'])  ?></td>
                            <td>date</td>
                            <td><?= $bid['name'] ?></td>
                            <td>ksh. <?= $bid['total'] ?></td>
                            <td>ksh. <?= $bid['bid_amount'] ?></td>
                            <td class="action-links">
                                <a class="reject-link" href="<?= 'my_bids/reject/'.$bid['bid_id'] ?>">Reject</a>
                                <a class="accept-link" href="<?= 'my_bids/accept/'.$bid['bid_id'] ?>">Accept</a>
                            </td>
                        </tr>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                <?php elseif(!empty($accepted_bids) || !empty($rejected_bids)): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($accepted_bids as $accepted_bid): ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= $accepted_bid['fname'] .' '. $accepted_bid['lname'] ?></td>
                            <td>date</td>
                            <td><?= ucfirst($accepted_bid['name']) ?></td>
                            <td>ksh. <?= $accepted_bid['total'] ?></td>
                            <td>ksh. <?= $accepted_bid['bid_amount'] ?></td>
                            <?php if($accepted_bid['action'] == '1'): ?>
                                <td>
                                    <a href="<?= $payment_link ?>" class="accept-link" id="payment-link">Buy Now</a> <span data-tooltip="Agree with our terms" data-flow="top"><i class="fa-sharp fa-solid fa-circle-info"></i></span>
                                    <span id="error-message"></span>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($rejected_bids as $rejected_bid): ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= ucfirst($rejected_bid['fname']) .' '. ucfirst($rejected_bid['lname']) ?></td>
                            <td>date</td>
                            <td><?= $rejected_bid['name'] ?></td>
                            <td>ksh. <?= $rejected_bid['total'] ?></td>
                            <td>ksh. <?= $rejected_bid['bid_amount'] ?></td>
                            <?php if($rejected_bid['action'] == '2'): ?>
                                <td>
                                    <button class="reject-link">Rejected</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">
                            <p class="text-center">No bids found</p>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php if(!empty($accepted_bids)): ?>
<div class="container mb-4" id="agreement-container">
    <div class="row">
        <div class="col-md-12">

                <div class="agreement-title">
                    <h3 class="text-center">Agreement non-disclosure form</h3>
                    <div class="pdf-file">
                        <a href="<?= base_url().'/uploads/agreement-files/' .$pdf_view ?>" target="_blank">Download</a>
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


<?= $this->include('includes/footer.php'); ?>

<?= $this->endSection();?>
