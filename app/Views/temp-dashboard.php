<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>
<script>
    setTimeout(function (){
        $('#hideTempMessage').addClass('move-out-flash');
        setTimeout(function (){
            $('#hideTempMessage').remove();
        }, 500);
    }, 5000);
</script>

<?= $this->include('includes/navbar.php'); ?>

<div class="load"></div>
<div class="container mt-4 mb-4" id="main-section-container">
    <div class="row">
        <div class="col col-md-8 responsive-margin-container">
            <?php if(session()->getTempdata('success')): ?>
                <div class="alert alert-success" id="hideTempMessage">
                    <?= session()->getTempdata('success') ?>
                </div>
            <?php else: ?>
                <?php if(session()->getTempdata('fail')): ?>
                    <div class="alert alert-danger" id="hideTempMessage">
                        <?= session()->getTempdata('fail') ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div id="col-content-section">
                <div class="profile-container">
                    <div class="user-profile-info">

                        <?php if(!empty($userData->profile)): ?>
                            <img alt="profile" src="<?= base_url().'/uploads/'.$userData->profile ?>" class="user-profile-avatar rounded-circle">
                        <?php else:?>
                            <span><i class="fa-solid fa-user user-profile-avatar"></i></span>
                        <?php endif; ?>
                        <?php if(!empty($userData->fname) && !empty($userData->lname)): ?>
                            <h6 class="user-profile-name"><?= strtoupper($userData->fname); ?> <?= strtoupper($userData->lname); ?></h6>
                            <a href="<?= base_url('update-profile')?>"><span><i class="fa-solid fa-pen-to-square user-profile-edit"></i></a></span>
                        <?php endif; ?>

                    </div>
                    <div class="user-info-details">
                        <?php if(!empty($userData)) :?>
                            <div class="user-information1">
                                <h6>Phone: <?= $userData->phone; ?></h6>
                                <h6>Email: <?= $userData->email; ?></h6>
                            </div>
                            <div class="user-information2">
                                <?php if(!empty($is_a_member)) :?>
                                    <?php foreach ($is_a_member as $member): ?>
                                        <h6>Sacco: <?= $member['name'] ?></h6>
                                        <?php if(!empty($userShares)) : ?>
                                            <?php foreach ($userShares as $userShare): ?>
                                                <h6>Member number: <?= $userShare['membership_number'] ?></h6>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <h6>Member number: <span class="text-danger">Processing ...</span></h6>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <h6>Sacco: <span class="text-danger">Not a member</span></h6>
                                    <h6>Member number: <span class="text-danger">Not a member</span></h6>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="col col-md-4 responsive-margin-shares-information-container">
            <div id="col-content-section">
                <div class="dashboard-heading">
                    <h6>Shares Balance</h6>
                </div>
                <?php if(!empty($userShares)) : ?>
                    <?php foreach ($userShares as $userShare): ?>
                        <div class="view">
                            <h6>View Shares</h6>
                            <span><i class="fa-solid fa-eye-slash view-icon" id="eye-icon"></i></i></span>
                        </div>
                        <div class="dashboard-shares-balance">
                            <div class="share-balance">
                                <h6>Total Share Balance: <span id="total-amount-of-shares"><?= $userShare['shares_amount'] ?></span></h6>
                                <h6>Cost Per Share <span>ksh: <?= $userShare['cost_per_share'] ?></span></h6>
                            </div>
                            <div class="dashboard-sell">
                                <button type="button" class="dashboard-sell-button" id="display-sell-now-btn" onclick="document.getElementById('id01').style.display='block'">Sell now</button>
                            </div>

                        </div>
                    <?php endforeach; ?>
                <?php elseif(!empty($is_a_member)): ?>
                    <div class="no-registration-info">
                        <p>Hello, your membership is in the processing stage, kindly wait.</p>
                    </div>
                <?php else: ?>
                <div class="no-registration-info">
                    <p>Hello, you are not a member of any sacco, follow the link bellow to join.</p>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="no-membership-button"><a href="<?= base_url('sacco_membership') ?>">Request Registration</a></span>
                    <?php if(isset($is_requested) && !empty($is_requested)) : ?>
                        <div class="status">
                            <div><span style="color: #f2a654">pending</span></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php endif; ?>


            <?php if(!empty($userShares)) : ?>
                <?php foreach ($userShares as $userShare): ?>

                    <div id="id01" class="user-share-model">
                        <form class="modal-content-user animate" action="" method="post" id="form">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById('id01').style.display='none'" class="x-close-button" title="Close Modal"><i class="fa-solid fa-x close-font-icon"></i></span>
                            </div>

                            <div class="container1">
                                <label for="shares"><b class="shares-sell-heading">Amount of Shares</b></label>
                                <p id="error-message" style="display:none;color:red;">You don't have enough shares to sell.</p>
                                <p id="error-message-share-empty" style="display:none;color:red;">Please enter the amount of shares to sell.</p>
                                <p id="error-message-terms" style="color:red;"></p>
                                <input type="text" class="customer-selling-button" name="shares" id="shares-for-sale-input-1" value="<?= $userShare['shares_amount'] ?>">
                                <div class="divider">
                                    <label for="cost"><b class="shares-sell-heading">Cost Per Share</b></label>
                                    <input type="text" class="customer-selling-button1"  name="price" readonly id="shares-for-sale-input-2" value="<?= $userShare['cost_per_share'] ?>">
                                    <?php if(!empty($member_commission)): ?>
                                        <input type="hidden" name="commission" value="<?= $member_commission ?>" id="member-commission">
                                    <?php endif; ?>
                                    <label for="value"><b class="shares-sell-heading">Total Share Value</b></label>
                                    <input type="text" class="customer-selling-button1"  name="total" readonly id="shares-on-sale-total-amount">
                                </div>
                                <div class="sell-shares-terms-and-conditions">
                                    <span>Terms and conditions</span>
                                    <input type="checkbox" id="sell-shares-terms">
                                </div>
                                <button type="submit" class="confirm-sell-shares-btn" id="sell-now-btn">Sell now</button>
                            </div>
                        </form>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>
            <?php if(isset($is_approved) && !empty($is_approved)) : ?>
                <div class="col-content-section2 mt-2">
                    <div class="toggle-bid">
                        <div class="bid-content" id="bid-content">
                            <?php if($is_approved->is_verified == '1'): ?>
                                <p>Share Verification Status: <span class="bid-badge-approved">Approved</span></p>
                            <?php elseif($is_approved->is_verified == '0') :?>
                                <p>Share Verification Status: <span class="bid-badge">Pending</span></p>
                            <?php endif ?>
                        </div>
                    </div>

                </div>
            <?php endif ?>
        </div>

    </div>
</div>
</div>
<?= $this->include('includes/footer.php'); ?>

<?= $this->endSection(); ?>



