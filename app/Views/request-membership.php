<?= $this->extend("client_base/base.php"); ?>
<?= $this->section('content'); ?>
<?= $this->include('includes/navbar.php'); ?>
    <div class="load"></div>

    <div class="container">
        <div class="row container-padding">
            <div class="col-md-12">
                <div class="sell-main-section1">

                    <div class="alert alert-success" role="alert" id="success4" style="display:none;">
                        <p id="success-message4"></p>
                    </div>

                    <div class="alert alert-warning" role="alert" id="warning4" style="display:none;">
                        <p id="warning-message4"></p>
                    </div>

                    <div class="sell-heading">
                        <h5>Membership Registration Form</h5>
                    </div>
                    <div class="verify-account">
                        <span>Fill in your membership registration details here</span>
                    </div>
                    <?php if (!empty($userData)): ?>
                        <form action="" method="post" class="verify-form-2" id="membership_form">
                            <div class="verify-input-1">
                                <label for="verify">Select Sacco*</label>
                                <select id="selectSacco" class="form-select" name="saccoName"></select>
                            </div>
                            <div class="verify-input-1">
                                <label for="verify">First Name*</label>
                                <input type="text" name="firstName" id="fname"
                                       value="<?= $userData->fname ?>">
                            </div>
                            <div class="verify-input-1">
                                <label for="verify">Last Name*</label>
                                <input type="text" name="lastName" value="<?= $userData->lname ?>"
                                       id="lname">
                            </div>
                            <div class="verify-input-1">
                                <label for="verify">Phone*</label>
                                <input type="tel" name="phone" value="<?= $userData->phone ?>"
                                       id="email">
                            </div>
                            <div class="verify-input-1">
                                <label for="verify">Email Address*</label>
                                <input type="email" name="email" value="<?= $userData->email ?>"
                                       id="email">
                            </div>
                            <div class="verify-input-1">
                                <label for="verify">ID Number*</label>
                                <input type="number" name="idNumber"
                                       id="id_number" value="<?= set_value('idNumber')?>">
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="verify-input-button1" id="membership_registration">Submit
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>

            </div>

        </div>
    </div>
<?= $this->include('includes/footer.php'); ?>

<?= $this->endSection(); ?>
<?php $this->section('registration'); ?>
<script>
    $(document).ready(function (){
        $("#selectSacco").select2({
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

        $('#membership_form').validate({
            rules: {
                errorClass: 'error',
                validClass: 'valid',
                saccoName: {
                    required: true,
                },
                firstName: {
                    required: true,
                    minlength: 3,
                    maxlength: 30,
                },
                lastName: {
                    required: true,
                    minlength: 3,
                    maxlength: 30,
                },
                phone: {
                    required: true,
                    minlength: 10,
                },
                email: {
                    required: true,
                    email: true,
                },
                idNumber: {
                    required: true,
                    minlength: 8,
                    maxlength: 8,
                }
            },

            messages: {
                saccoName: {
                    required: "Please select sacco",
                },
                firstName: {
                    required: "Please enter first name",
                    minlength: "First name must be at least 3 characters long",
                    maxlength: "First name must not exceed 30 characters",
                },
                lastName: {
                    required: "Please enter last name",
                    minlength: "Last name must be at least 3 characters long",
                    maxlength: "Last name must not exceed 30 characters",
                },
                phone: {
                    required: "Please enter phone number",
                    minlength: "Phone number must be at least 10 characters long",
                },
                email: {
                    required: "Please enter email address",
                    email: "Please enter a valid email address",
                },
                idNumber: {
                    required: "Please enter ID number",
                    minlength: "ID number must be at least 8 characters long",
                    maxlength: "ID number must not exceed 8 characters",
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
                element.parents('.verify-input-1').addClass('has-error');
                error.appendTo(element.parent());
            },
            success: function (label) {
                label.parents('.verify-input-1').removeClass('has-error');
            },
            onkeyup: function (element) {
                $(element).valid();
            },

            submitHandler: function (form){

                let sacco_id = $('#selectSacco').select2('data')[0].id;
                let idNumber = $('#id_number').val();


                $('#membership_registration').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> Please wait...');
                $.ajax({
                    url: '<?= base_url() ?>/share/' + "<?= $share_id ?>" + '/save_new_membership/save',
                    type: 'POST',
                    data: {
                        sacco_id: sacco_id,
                        idNumber: idNumber,
                    },
                    success: function (response){
                        console.log(response);
                        if (response.status == 200){
                            $('#success4').show();
                            $('#success-message4').html(response.message);
                            setTimeout(function (){
                                $('#success4').hide();
                                window.location.href = '<?= base_url() ?>/share/' + "<?= $share_id ?>";
                            }, 6000);
                        }else{
                            $('#warning4').show();
                            $('#warning-message4').html(response.message);
                            setTimeout(function (){
                                $('#warning4').hide();
                            }, 8000);
                        }
                    },
                    error: function(error){
                        $('#warning-message4').html('Something went wrong, please try again');
                        $('#warning4').css('display', 'block');
                        setTimeout(function (){
                            $('#warning4').css('display', 'none');
                        }, 10000);
                    },
                    complete: function (){
                        $('#membership_registration').prop('disabled', false).html('Submit');
                    }

                });
            }

        });
    });
</script>
<?php $this->endSection(); ?>
