
<?= $this->extend("client_base/base.php"); ?>
<?= $this->section('content'); ?>
<?= $this->include('includes/navbar.php'); ?>
<div class="load"></div>
<div class="container alert-main-container pt-5 pb-5">

    <div class="custom-alert">
        <div class="d-flex justify-content-around">
            <span><i class="fas fa-circle-check verified-budge check-icon-saved"></i></span>
            <span class="saved-message"></span>
            <span><i class="fa-solid fa-xmark close-icon-saved"></i></span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div id="ajax-alert" class="alert alert-success d-flex align-items-center alert-dismissible fade show show-success-message" role="alert">
                <i class="fas fa-check me-2"></i>
                <div id="ajax-alert-text">
                    some text
                </div>
                <button type="button" id="close-success-alert" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>


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
                                    <?php if (!empty($share)) : ?>
                                    <li><a class="dropdown-item" id="save-share" data-id="<?= $share['uuid'] ?>"><i class="fa-regular fa-bookmark"
                                                                             style="padding: 4px;"></i>Save</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa-regular fa-share-from-square"
                                                                             style="padding: 4px;"></i>Share</a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="share-description-container-new">
                        <div class="share-description-container-new-info">
                            <?php if (!empty($share)) : ?>
                            <p>Sellers Membership Number: <?= $share['membership_number'] ?></p>
                            <p>Number of Share capital: <?= $share['shares_on_sale'] ?></p>
                            <p>Price Value: ksh: <?= $share['total'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="share-description-container-new-date">
                            2 days ago
                        </div>
                    </div>

                    <div class="d-flex">
                        <a class="buy-button" id="display-sell-now-btn">Buy Share Capital</a>
                    </div>
                </div>

            </div>

            <div style="padding-top: 1.3rem; padding-bottom: 1.3rem">
                <h6 class="related-shares-title">You may also like the following share capital</h6>
            </div>
            <?= $this->include('includes/related_shares.php'); ?>

        </div>

        <div class="col-md-4 sm-scree-disable" id="search-main-container">

            <div class="border-coll">



                <h6 class="search-heading">Search share capital</h6>

                <form action="" method="post">
                    <div class="verify-input-2">
                        <input type="search" name="shares" placeholder="Search by share capital">
                    </div>

                    <div class="verify-input-2">
                        <input type="search" name="total" placeholder="Search by price value of shares">
                    </div>


                    <div class="d-flex justify-content-center">
                        <input type="submit" value="Search shares" class="verify-input-button1">
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
            <?php if (!empty($share)) : ?>
            <div class="container1">
                <div class="confirm-bidding">
                    <span class="icon-bottom"><i class="fa-solid fa-circle-check bid-confirm-icon"></i></span>
                    <label for="shares"><b class="shares-sell-heading text-warning"><i class="fas fa-circle-exclamation"
                                                                                       style="padding-right: 5px;"></i>Please
                            confirm if you are a member of <?= $share['name'] ?> sacco !</b></label>
                </div>
                <input type="hidden" class="customer-selling-button" name="bid" id="shares-for-sale-input-1"
                       value="<?= $share['total'] ?>">
                <div class="first-modal-buttons">
                    <a href="#" class="confirm-sell-shares-btn" id="modal2Display">Yes, I am a member</a>
                    <a href="<?= base_url('share/' . $share['uuid'] . '/request_membership'); ?>"
                       class="confirm-sell-shares-btn">NO, Not a member</a>

                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>


    <!--        modal two-->

    <div id="id02" class="user-share-model">
        <?php if (!empty($share)) : ?>
        <form class="modal-content-user animate" action="<?= $share['uuid'] . '/bid' ?>" method="post"
              id="bid-shares-form">
            <div class="imgContainer">
                <span class="x-close-button" id="modal02-close" title="Close Modal"><i
                        class="fa-solid fa-x close-font-icon"></i></span>
            </div>

            <div class="container1">
                <div class="confirm-bidding">
                    <span class="icon-bottom"><i id="ajax-icon" class="fa-solid fa-circle-check bid-confirm-icon"></i></span>
                    <label for="shares" id="shares-label" class="text-warning"><b class="shares-sell-heading">Place
                            your bid for the shares capital you want to purchase
                            (Ksh).</b></label>
                </div>
                <div class="d-flex align-items-center justify-content-around offer-buttons">
                    <span class="suggestedPrice"></span>
                    <span class="suggestedPrice"></span>
                    <span class="suggestedPrice"></span>
                    <span class="suggestedPrice"></span>
                </div>
                <div style="width: 100%;">
                    <label for="sharePrice"><b class="shares-sell-heading">Enter your bid amount*</b></label>
                    <input type="number" class="customer-selling-button" id="sharePrice" name="bid" value="<?= $share['total'] ?>">
                </div>
                <div style="width: 100%;">
                    <label for="MemberNumber"><b class="shares-sell-heading">Enter your membership number*</b></label>
                    <input type="text" class="customer-selling-button" id="MemberNumber" name="memberNumber">
                </div>
                <button type="submit" class="confirm-sell-shares-btn3" id="placeBidNow">Send Your Bid Amount</button>
            </div>
        </form>
        <?php endif; ?>
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

<?php $this->section('share-script'); ?>

<script>

    $(document).ready(function () {

        var sharePrice = parseInt($("#sharePrice").val());

        if(sharePrice < 100){
            $(".suggestedPrice").each(function (index) {
                $(this).text(sharePrice);
            });
        }

        else if (sharePrice >= 100 && sharePrice < 500) {
            $(".suggestedPrice").each(function (index) {
                var reduction = (index + 1) * 20;
                var suggestedPrice = sharePrice - reduction;
                $(this).text(suggestedPrice);
            });
        } else if (sharePrice >= 500 && sharePrice < 2000) {
            $(".suggestedPrice").each(function (index) {
                var reduction = (index + 1) * 50;
                var suggestedPrice = sharePrice - reduction;
                $(this).text(suggestedPrice);
            });
        } else if (sharePrice >= 2000 && sharePrice < 5000) {
            $(".suggestedPrice").each(function (index) {
                var reduction = (index + 1) * 100;
                var suggestedPrice = sharePrice - reduction;
                $(this).text(suggestedPrice);
            });
        } else if (sharePrice >= 5000 && sharePrice < 20000) {
            $('.suggestedPrice').each(function (index) {
                var reduction = (index + 1) * 200;
                var suggestedPrice = sharePrice - reduction;
                $(this).text(suggestedPrice);
            });
        } else if (sharePrice >= 20000 && sharePrice < 50000) {
            $('.suggestedPrice').each(function (index) {
                var reduction = (index + 1) * 500;
                var suggestedPrice = sharePrice - reduction;
                $(this).text(suggestedPrice);
            });

        } else if (sharePrice >= 50000 && sharePrice < 100000) {
            $('.suggestedPrice').each(function (index) {
                var reduction = (index + 1) * 1000;
                var suggestedPrice = sharePrice - reduction;
                $(this).text(suggestedPrice);
            });
        } else if (sharePrice >= 100000 && sharePrice < 200000) {
            $('.suggestedPrice').each(function (index) {
                var reduction = (index + 1) * 2000;
                var suggestedPrice = sharePrice - reduction;
                $(this).text(suggestedPrice);
            });
        } else if (sharePrice >= 200000 && sharePrice < 500000) {
            $('.suggestedPrice').each(function (index) {
                var reduction = (index + 1) * 5000;
                var suggestedPrice = sharePrice - reduction;
                $(this).text(suggestedPrice);
            });
        }

        $('.suggestedPrice').on('click', function () {
            $('#sharePrice').val($(this).text());
        });

        $('#placeBidNow').on('click', function (e) {
            $('#bid-shares-form').validate({
                rules: {
                    errorClass: 'error',
                    validClass: 'valid',
                    bid: {
                        required: true,
                        number: true
                    },
                    memberNumber: {
                        required: true,
                        minlength: 5,
                        maxlength: 10,
                    }
                },

                messages: {
                    bid: {
                        required: 'Please enter your bid amount',
                        number: 'Please enter a valid number',
                    },
                    memberNumber: {
                        required: 'Please enter your membership number',
                        minlength: 'Please enter a valid membership number',
                        maxlength: 'Please enter a valid membership number',
                    }
                },
                highlight: function (element) {
                    $(element).addClass('error');
                },
                unhighlight: function (element) {
                    $(element).removeClass('error');
                },
                errorPlacement: function (error, element) {
                    error.addClass('help-block');
                    element.parents('.form-group').addClass('has-error');
                    error.appendTo(element.parent());
                },
                success: function (label) {
                    label.parents('.form-group').removeClass('has-error');
                },
                onkeyup: function (element) {
                    $(element).valid();
                },
                submitHandler: function (form) {
                    $('#placeBidNow').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> Please wait ...');
                    $.ajax({
                        url: "<?= base_url('share/'.$share['uuid'] . '/bid') ?>",
                        type: "POST",
                        data: $('#bid-shares-form').serialize(),
                        success: function (response){
                            if(response){
                                $('#id02').css('display', 'none');
                                $('.custom-alert').css('display', 'block');
                                $('.saved-message').text(response.message);
                                $('#save-share').css('background-color', '#789f99');
                            }
                        },
                        error: function (error) {
                            $('.custom-alert').css('display', 'block');
                            $('.saved-message').text('An error occurred, please try again later');
                            $('#save-share').css('background-color', '#e5e5e5');
                        },

                        complete: function (xhr, status){
                            $('#placeBidNow').removeClass('disabled').html('Send Your Bid Amount');
                        }

                    });
                }

            });
        });

        function checkBidStatus() {
            $.ajax({
                url: "<?= base_url('has_bid/'.$share['uuid']) ?>",
                type: "GET",
                success: function (response){
                    if(response){
                        $('#ajax-icon').removeClass("fa-circle-check").addClass("fa-exclamation");
                        $('#ajax-icon').removeClass("bid-confirm-icon").addClass("bid-error-icon");
                        $('#shares-label').text('You are the owner of the selected share capital, you can not bid on your own share capital');
                        $('#placeBidNow').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> You Posted this Share Capital');
                    }
                },
                error: function (error) {
                    console.log(error);
                },

            });
        }

        checkBidStatus();

        function checkHasBid(){
            $.ajax({
                url: "<?= base_url('has_active_bid/'.$share['uuid']) ?>",
                type: "GET",
                success: function (response){
                    if(response){
                        $('#ajax-icon').removeClass("fa-circle-check").addClass("fa-exclamation");
                        $('#ajax-icon').removeClass("bid-confirm-icon").addClass("bid-error-icon");
                        $('#shares-label').text('You already have an active bid for this share capital, please select another share capital');
                        $('#placeBidNow').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> You have an active bid');
                    }
                },
                error: function (error) {
                    console.log(error);
                },

            });
        }

        checkHasBid();

        $('#close-success-alert').on('click', function(){
            $('#ajax-alert').addClass('show-success-message');
        });

        $('#save-share').on('click', function (){

            let share_id = $(this).data('id');
            $.ajax({
                url: "<?= base_url() ?>/saved/saved_share/",
                type: "POST",
                data: {share_id: share_id},
                success: function (response){
                   if(response.status === 200){
                       $('.custom-alert').css('display', 'block');
                       $('.saved-message').text(response.message);
                       $('#save-share').css('background-color', '#789f99');
                   }else{
                       $('.custom-alert').css('display', 'block');
                       $('.saved-message').text(response.message);
                       $('#save-share').css('background-color', '#e5e5e5');
                   }
                },
                error: function (error) {
                    $('.custom-alert').css('display', 'block');
                    $('.saved-message').text(response.message);
                    $('#save-share').css('background-color', '#e5e5e5');
                },

            });
        });

        $('.close-icon-saved').on('click', function (){
            $('.custom-alert').css('display', 'none');

        });

    })


</script>

<?php $this->endSection(); ?>
