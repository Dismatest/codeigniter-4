<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>
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
        <div class="col-md-12">
            <div class="table-responsive-sm">
                <table id="dashboardDataTable" class="table-sm bid-table">
                    <thead>

                    <tr>
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
                        <?php foreach ($bids as $bid): ?>
                            <tr>
                                <td><?= ucfirst($bid['buyer_fname']). ' ' .ucfirst($bid['buyer_lname']) ?></td>
                                <td>

                                <?php
                                    $date = $bid['created_at'];
                                    $date = date_create($date);
                                    echo date_format($date, 'd-m-Y');
                                ?>

                                </td>
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
                                <td><?= ucfirst($accepted_bid['seller_fname']). ' ' .ucfirst($accepted_bid['seller_lname']) ?></td>
                                <td>
                                    <?php
                                    $date = $accepted_bid['updated_at'];
                                    $date = date_create($date);
                                    echo date_format($date, 'd-m-Y');
                                    ?>
                                </td>
                                <td><?= ucfirst($accepted_bid['name']) ?></td>
                                <td>ksh. <?= $accepted_bid['total'] ?></td>
                                <td>ksh. <?= $accepted_bid['bid_amount'] ?></td>
                                <?php if($accepted_bid['action'] == '1'): ?>
                                    <td style="display: flex; justify-content: center; align-items: center">
                                        <button type="button" data-id="<?= $accepted_bid['bid_id'] ?>" data-share="<?= $accepted_bid['uuid']?>" data-total=<?= $accepted_bid['bid_amount'] ?> class="accept-link" id="displayPaymentModal">Buy Now</button>
                                        <a class="reject-accept-delete" id="accepted-accept-delete" data-id="<?= $accepted_bid['bid_id'] ?>"><i class="fas fa-trash bid-delete-icon"></i></a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        <?php foreach ($rejected_bids as $rejected_bid): ?>
                            <tr>
                                <td><?= ucfirst($rejected_bid['seller_fname']). ' ' .ucfirst($rejected_bid['seller_lname']) ?></td>
                                <td>
                                    <?php
                                    $date = $rejected_bid['updated_at'];
                                    $date = date_create($date);
                                    echo date_format($date, 'd-m-Y');
                                    ?>
                                </td>
                                <td><?= $rejected_bid['name'] ?></td>
                                <td>ksh. <?= $rejected_bid['total'] ?></td>
                                <td>ksh. <?= $rejected_bid['bid_amount'] ?></td>
                                <?php if($rejected_bid['action'] == '2'): ?>
                                    <td style="display: flex; justify-content: center; align-items: center;">
                                        <button class="reject-link">Rejected</button>
                                        <a class="accept-link" href="<?= 'share/'.$rejected_bid['uuid'] ?>">Bid</a>
                                        <a class="reject-accept-delete" id="rejected-bid-delete" data-id="<?= $rejected_bid['bid_id'] ?>"><i class="fas fa-trash bid-delete-icon"></i></a>
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


    <!--payment modal-->
    <div id="id04" class="user-payment-model">
        <div class="modal-content-user animate">
            <div class="imgContainer">
                <span class="x-close-button" id="modal04-close" title="Close Modal"><i
                        class="fa-solid fa-x close-font-icon"></i></span>
            </div>

            <div class="container2">
                <div class="borders">
                    <div class="alert alert-success" role="alert" id="success2" style="display:none;">
                        <p id="success-message2"></p>
                    </div>

                    <div class="alert alert-warning" role="alert" id="warning" style="display:none;">
                        <p id="warning-message"></p>
                    </div>
                    <div class="payment-icon">
                        <h6 class="payment-heading">Secure Checkout Payment</h6>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Total amount to pay
                        </div>
                        <div id="card-content">
                            <h6>Total</h6>
                            <span id="bid-total"></span>
                        </div>
                    </div>
                    <div class="select-payment-method">
                        <h6 class="select-payment">The Default Mobile Payment</h6>
                        <div class="payment-buttons">
                            <span><i class="fa-solid fa-mobile"></i></span>
                            <p class="payment-desc">Mobile payment</p>
                        </div>
                    </div>
                    <div class="user-input-details">
                        <div class="phone-details">
                            <h6 class="select-service-provider">Phone number</h6>
                            <div class="phone-input">
                                <div class="phone-details-sm">
                                    <select class="user-select" name="phone-code" id="select-phone-code">
                                        <option value="+254">+254</option>
                                        <option value="+1">+1</option>
                                        <option value="+255">+255</option>
                                    </select>
                                    <input type="number" id="phone" pattern="^7\d{8}$" name="phone">
                                </div>
                                <span id="phone-errors"></span>
                            </div>
                        </div>
                        <h6 class="services">Please select your service provider to continue</h6>
                        <div class="checkbox-container">
                            <input type="checkbox" id="checkbox-1" name="mpesa-check-box">
                            <img class="saf-img"
                                 src="data:image/jpeg;base64,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"
                                 alt="">
                        </div>
                    </div>
                    <div class="footer-button">
                        <a href="<?= base_url() . '/my_bids' ?>" class="footer-link">Cancel</a>
                        <button type="button" class="footer-pay-button" id="initiatePayment" disabled><span><i class="fa-solid fa-lock"></i></span> Payment
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--end of the modal-->



<!--    terms and conditions models-->
    <div id="terms-and-conditions-modal" class="user-share-model">
       <div class="modal-content-user animate">
           <div class="imgContainer">
                <span class="x-close-button" id="terms-close-modal" title="Close Modal"><i
                        class="fa-solid fa-x close-font-icon"></i></span>
           </div>
           <div style="display: flex; flex-direction:column; justify-content: center; align-items: center; width: 100%;">
                <h3 class="text-center terms-heading">Terms and conditions</h3>
               <p class="terms-param">Agree to our terms and condition by clicking the small box bellow</p>
                   <div class="container mb-4" id="agreement-container">
                       <div class="row">
                           <div class="col-md-12">

                               <div class="alert alert-success" role="alert" id="success1" style="display:none;">
                                   <p id="success-message1"></p>
                               </div>

                               <div class="agreement-title">
                                   <div class="pdf-file">
                                       <div style="display: flex; justify-content: center; align-items: center">
                                           <span class="download-agreement-form"><i class="fas fa-arrow-down"></i></span>
                                           <a href="<?= base_url().'/uploads/agreement-files/' .$pdf_view ?>" target="_blank">Download</a>
                                       </div>

                                       <div class="terms-of-use">
                                           <span id="display-error">Terms and conditions</span>
                                           <input type="checkbox" id="terms-checkbox">
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
           </div>
           <div class="ok-button">
               <button id="ok-agreement-button" class="agreement-button-close" disabled>ok</button>
           </div>
       </div>
    </div>

<!--    end of the modal-->

</div>


<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>
<?= $this->endSection();?>
<?php $this->section('modal-script');?>
<script>
$(document).ready(function (){
    let terms_modal = $('#terms-and-conditions-modal');
    let checkBox = $('#terms-checkbox');
    let closeBtn = $('#terms-close-modal');
    let okBtn = $('#ok-agreement-button');

    function closeModal(){
        terms_modal.css('display', 'none');
    }

    function displayModal(){
        terms_modal.css('display', 'block');
    }


    closeBtn.on('click', function (){
        if(checkBox.is(':checked')){
            closeModal();
        }else {
            checkBox.addClass('display-error');
        }
    });

    okBtn.on('click', function (){
        if(checkBox.is(':checked')){
            closeModal();
        }else{

        }
    })

    checkBox.on('change', function(){
        if($(this).is(':checked')){
            $(this).addClass('ok-enabled');
            $('#ok-agreement-button').prop('disabled', false);
            $('#ok-agreement-button').addClass('enabled');
        }else{
            $(this).removeClass('agreement-button-close');
            $('#ok-agreement-button').prop('disabled', true);
            $('#ok-agreement-button').removeClass('enabled');
        }
    });

    $(window).on('load', function (){
        displayModal();
    });

//     initiate payment model
    let checkBox2 = $('#checkbox-1');
    $('#displayPaymentModal').on('click', function(){
        $('#id04').css('display', 'block');
    })
    $('#modal04-close').on('click', function(){
        $('#id04').css('display', 'none');
    });

    checkBox2.on('change', function(){
        if($(this).is(':checked')){
            $(this).addClass('paycheck');
            $('#initiatePayment').prop('disabled', false);
            $('#initiatePayment').addClass('enabled');
        }else{
            $(this).removeClass('paycheck');
            $('#initiatePayment').prop('disabled', true);
            $('#initiatePayment').removeClass('enabled');
        }
    });

    $('#displayPaymentModal').on('click', function (){
        let bidId = $(this).data('id');
        let shareId = $(this).data('share');
        let bidAmount = $(this).data('total');

        $.ajax({
            url: '<?= base_url(). '/payment/get_bid'?>',
            method: 'POST',
            data: {
                bidId : bidId,
                shareId: shareId,
            },
            success: function (response){
                $('#bid-total').html('ksh: ' + response.bid_amount)
                $('#phone').val(response.phone)

                $('#initiatePayment').data('bidId', bidId);
                $('#initiatePayment').data('shareId', shareId);
                $('#initiatePayment').data('bidAmount', bidAmount);
                $('#initiatePayment').data('buyerId', response.uniid);
            },
            error: function(error){
                console.log(error);
            }
        });
    });


    $('#initiatePayment').on('click', function (){
        let shareId = $(this).data('shareId');
        let bidAmount = $(this).data('bidAmount');
        let buyerId = $(this).data('buyerId');

        let phoneCode = $('#select-phone-code').val();
        let phoneNumber = $('#phone').val();
        let trimZero = phoneNumber.replace(/^0+/, '');
        let combinedPhoneNumber = phoneCode + trimZero;
        let trimPhoneNumber = combinedPhoneNumber.replace('+', '');

        if(phoneNumber.length < 10 || phoneNumber.length > 10){
            $('#warning-message').html('Please enter a valid phone number');
            $('#warning').css('display', 'block');
            setTimeout(function (){
                $('#warning').css('display', 'none');
            }, 3000);
            return;
        }

        $('#initiatePayment').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> Processing..');
        $.ajax({
            url: '<?= base_url(). '/payment/confirm_payment'?>',
            method: 'POST',
            data: {
                phoneNumber : trimPhoneNumber,
                shareId: shareId,
                bidAmount: bidAmount,
                buyerId: buyerId,
            },
            success: function (response){
                if(response.status === 200){
                    $('#success-message2').html(response.message);
                    $('#success2').css('display', 'block');
                    setTimeout(function (){
                        $('#success2').css('display', 'none');
                    }, 10000);
                }else{
                    $('#warning-message').html(response.message);
                    $('#warning').css('display', 'block');
                    setTimeout(function (){
                        $('#warning').css('display', 'none');
                    }, 6000);
                }
            },
            error: function(error){
                $('#warning-message').html('Something went wrong, please try again');
                $('#warning').css('display', 'block');
                setTimeout(function (){
                    $('#warning').css('display', 'none');
                }, 10000);
            },
            complete: function (){
                $('#initiatePayment').prop('disabled', false).html('Payment');
            }
        });
    });
})
</script>
<?php $this->endSection();?>
