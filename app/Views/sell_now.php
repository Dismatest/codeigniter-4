<?= $this->extend("client_base/base.php"); ?>
<?= $this->section('content'); ?>

<?= $this->include('includes/navbar.php'); ?>

<div class="load"></div>
<div class="container">
    <div class="row container-padding">

        <div class="col-md-12">


            <div class="sell-main-section1">

                <div class="alert alert-success" role="alert" id="success3" style="display:none;">
                    <p id="success-message3"></p>
                </div>

                <div class="alert alert-warning" role="alert" id="warning3" style="display:none;">
                    <p id="warning-message3"></p>
                </div>

                <div class="sell-heading">
                    <h5>Sell Share Capital</h5>
                    <span id="error-message"></span>
                    <span id="clear">clear</span>
                </div>
                <div class="verify-account">
                    <span>Sell Your Share Capital Here</span>
                </div>
                <form action="" method="post" class="verify-form-2" id="sell-form">

                    <div class="verify-input-1">
                        <label for="verify">Select Sacco*</label>
                        <select id="myInput" class="form-select" name="saccoName"></select>
                    </div>

                    <div class="verify-input-1">
                        <label for="verify">Member Number*</label>
                        <input type="text" name="member_number" placeholder="Enter member number" id="memberNumber" value="<?= set_value('member_name')?>">
                    </div>

                    <div class="verify-input-1">
                        <label for="verify">Shares*</label>
                        <input type="number" name="share" placeholder="Enter the amount of shares"
                               id="shares-for-sale-input-1" value="<?= set_value('share')?>">
                    </div>

                    <div class="verify-input-1">
                        <label for="verify">Total Amount*</label>
                        <input type="number" name="amount" placeholder="Enter the total amount"
                               id="shares-for-sale-input-2" value="<?= set_value('amount')?>">
                    </div>

                    <div class="verify-terms">
                        <label for="terms">I agree to the terms and conditions*</label>
                        <input type="checkbox" name="terms" id="sell-shares-terms">
                    </div>

                    <div class="hidden">
                        <?php if (!empty($member_commission)): ?>
                            <input type="hidden" name="commission" value="<?= $member_commission ?>"
                                   id="member-commission">
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button disabled type="submit" class="verify-input-button" id="sell-now-btn">Submit</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>
<?= $this->endSection(); ?>
<?php $this->section('sell-now-script'); ?>
<script>
    $(document).ready(function () {
        $("#myInput").select2({
            ajax: {
                url: "/get-all-sacco",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: $.map(data.sacco, function (obj) {
                            return {id: obj.sacco_id, text: obj.name};
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 1,
            placeholder: 'Search sacco',
            templateResult: function (data) {
                if (data.loading) {
                    return data.text;
                }

                return $('<div class="select2-result-repository">' + data.text + '</div>');
            }
        });

        let checkbox = $('#sell-shares-terms');
        checkbox.on('change', function () {
            if ($(this).is(':checked')) {
                $('#sell-now-btn').prop('disabled', false);
                $('#sell-now-btn').addClass('enabled');
            } else {
                $('#sell-now-btn').prop('disabled', true);
                $('#sell-now-btn').removeClass('enabled');
            }
        });

        $('#sell-form').validate({
            rules: {
                errorClass: 'error',
                validClass: 'valid',
                saccoName: {
                    required: true,
                },
                member_number: {
                    required: true,
                    minlength: 8,
                    maxlength: 8,
                },
                share: {
                    required: true,
                    minlength: 1,
                },
                amount: {
                    required: true,
                },
                commission: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                }
            },

            messages: {
                saccoName: {
                    required: "Please select a sacco",
                },
                member_number: {
                    required: "Please enter member number",
                    minlength: "The minimum length of member number is 8",
                    maxlength: "The maximum length of member number is 8",
                },
                share: {
                    required: "Share capital field is required",
                    minlength: "You can not sell less than 1 share capital",
                },
                amount: {
                    required: "Please enter the amount of share capital",
                },
            },

            highlight: function (element) {
                $(element).addClass('error');
            },
            unhighlight: function (element) {
                $(element).removeClass('error');
            },
            errorPlacement: function (error, element) {
                error.addClass('help-block');
                element.parents('.verify-input-1').addClass('has-error');
                error.appendTo(element.parent());
            },
            success: function (label) {
                label.parents('.verify-input-1').removeClass('has-error');
            },
            onkeyup: function (element) {
                $(element).valid();
            },
            submitHandler: function (form) {
                let sacco_id = $('#myInput').select2('data')[0].id;
                let shares_for_sale = $('#shares-for-sale-input-1').val();
                let member_commission = $('#member-commission').val();
                let member_number = $('#memberNumber').val();
                let total_share_value = $('#shares-for-sale-input-2').val();

                let commission = (total_share_value * member_commission) / 100;
                let total = Number(total_share_value) + Number(commission);

                $('#sell-now-btn').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> Please wait...');
                $.ajax({
                    url: 'sell-now/requestSell',
                    method: 'POST',
                    data: {
                        'sacco_id': sacco_id,
                        'member_number': member_number,
                        'share': shares_for_sale,
                        'total': total,
                    },
                    success: function (response){
                        if(response.status === 200){
                            $('#success-message3').html(response.message);
                            $('#success3').css('display', 'block');
                            setTimeout(function (){
                                $('#success3').css('display', 'none');
                                window.location.href = '/saved/your_active_shares';
                            }, 10000);
                        }else if(response.status === 500){
                            $('#warning-message3').html(response.message);
                            $('#warning3').css('display', 'block');
                            setTimeout(function (){
                                $('#warning3').css('display', 'none');
                            }, 6000);
                        }
                    },
                    error: function(xhr, status, error){
                        $('#warning-message3').html('Something went wrong, please try again later');
                        $('#warning3').css('display', 'block');
                        setTimeout(function (){
                            $('#warning3').css('display', 'none');
                        }, 10000);
                    },
                    complete: function (){
                        $('#sell-now-btn').prop('disabled', false).html('Submit');
                    }
                });
            }
        });

    })
</script>
<?php $this->endSection(); ?>
