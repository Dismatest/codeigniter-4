<?= $this->extend("client_base/base.php"); ?>
<?= $this->section('content'); ?>
<?= $this->include('includes/navbar.php'); ?>
    <script>
        setTimeout(function () {
            $('#hideTempMessage').addClass('move-out-flash');
            setTimeout(function () {
                $('#hideTempMessage').remove();
            }, 500);
        }, 5000);
    </script>
    <div class="load"></div>
    <div class="container">
        <div class="row" style="margin-bottom: 1.3em; margin-top: 2.0em;">
            <div class="col-md-8">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success" id="hideTempMessage">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php else: ?>
                    <?php if (session()->getFlashdata('fail')): ?>
                        <div class="alert alert-danger" id="hideTempMessage">
                            <?= session()->getFlashdata('fail') ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="border-col responsive-margin-top">
                    <div class="shares-desc-div">

                        <div class="share-description-container-heading">
                            <div class="share-description-share-details">
                                <?php if (!empty($share)) : ?>
                                    <h6 class="sacco-name"><?= $share['name'] ?></h6>
                                <?php endif; ?>
                            </div>

                            <div style="display: flex; align-items: center">
                                <span><i class="fas fa-circle-check verified-budge"></i></span>

                                <span class="new-budge">New</span>


                                <div class="dropdown dropstart">
                                    <a

                                        href="#"
                                        id="dropdownMenuLink"
                                        data-mdb-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        <span><i class="fas fa-ellipsis-vertical share-badge"></i></span>
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="#"><i class="fa-regular fa-bookmark"
                                                                                 style="padding: 4px;"></i>Save</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa-regular fa-share-from-square"
                                                                                 style="padding: 4px;"></i>Share</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="share-description-container-new">
                            <div class="share-description-container-new-info">
                                <p>Sellers Membership Number: <?= $share['membership_number'] ?></p>
                                <p>Number of Share capital: <?= $share['shares_on_sale'] ?></p>
                                <p>Price Value: ksh: <?= $share['total'] ?></p>
                            </div>
                            <div class="share-description-container-new-date">
                                2 days ago
                            </div>
                        </div>

                        <div class="d-flex">
                            <a class="buy-button" id="display-sell-now-btn">BUY SHARES</a>
                        </div>
                    </div>

                </div>

                <div style="padding-top: 1.3rem; padding-bottom: 1.3rem">
                    <h6 class="related-shares-title">You may also like the following shares</h6>
                </div>
                <?= $this->include('includes/related_shares.php'); ?>

            </div>

            <div class="col-md-4 sm-scree-disable" id="search-main-container">
                <div class="border-coll">

                    <h6 style="text-align: center; padding-bottom: 15px;">Search Shares here</h6>

                    <form action="" method="post">
                        <div class="verify-input-2">
                            <input type="search" name="shares" placeholder="Search by share capital" >
                        </div>

                        <div class="verify-input-2">
                            <input type="search" name="total" placeholder="Search by price value of shares">
                        </div>


                        <div class="d-flex justify-content-center">
                            <input type="submit" value="Search shares" class="verify-input-button">
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!--start of the bid model-->
        <div id="id01" class="user-share-model">
            <div class="modal-content-user animate">
                <div class="imgContainer">
                    <span class="x-close-button" id="modal01-close" title="Close Modal"><i
                            class="fa-solid fa-x close-font-icon"></i></span>
                </div>

                <div class="container1">
                    <label for="shares"><b class="shares-sell-heading text-warning"><i class="fas fa-circle-exclamation"
                                                                                       style="padding-right: 5px;"></i>Please
                            confirm if you are a member of <?= $share['name'] ?> sacco !</b></label>
                    <input type="hidden" class="customer-selling-button" name="bid" id="shares-for-sale-input-1"
                           value="<?= $share['total'] ?>">
                    <div class="first-modal-buttons">
                        <button class="confirm-sell-shares-btn" id="modal2Display">Yes, I am a member</button>
                        <a href="<?= base_url('share/' . $share['uuid'] . '/request_membership'); ?>"
                           class="confirm-sell-shares-btn2 text-center">NO, Not a member</a>

                    </div>
                </div>
            </div>
        </div>


        <!--        modal two-->

        <div id="id02" class="user-share-model">
            <form class="modal-content-user animate" action="<?= $share['uuid'] . '/bid' ?>" method="post" id="form">
                <div class="imgContainer">
                    <span class="x-close-button" id="modal02-close" title="Close Modal"><i
                            class="fa-solid fa-x close-font-icon"></i></span>
                </div>

                <div class="container1">
                    <label for="shares"><b class="shares-sell-heading"><i
                                class="fas fa-circle-exclamation icon-exclamation"></i>Place your bid for the shares
                            capital which the owner will either approve or reject (Ksh).</b></label>
                    <div class="d-flex align-items-center justify-content-around offer-buttons">
                        <span>500</span>
                        <span>500</span>
                        <span>500</span>
                        <span>500</span>
                    </div>
                    <input type="text" class="customer-selling-button" name="bid" value="<?= $share['total'] ?>">
                    <button type="submit" class="confirm-sell-shares-btn3">SEND</button>
                </div>
            </form>
        </div>


        <!-- end of the modal-->


        <!-- share posted share modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content modal-bg-color">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Share with others</h5>
                        <button type="button" class="close-button" data-bs-dismiss="modal">close</button>
                    </div>
                    <div class="modal-body">
                        <span><i class="fa-regular fa-envelope"></i><a href="" class="p-3">Share via email</a></span>
                        <span><i class="fa-brands fa-facebook"></i><a href="" class="p-3">share via facebook</a></span>
                        <span><i class="fa-brands fa-whatsapp"></i><a href="" class="p-3">share via whatsapp</a></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of modal -->
    </div>
    </div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>

<?= $this->endSection(); ?>