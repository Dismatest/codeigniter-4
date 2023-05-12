
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Admin Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Admin/Post Shares <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row d-flex align-items-center justify-content-center">

        <div class="col-8 grid-margin ">
            <div class="card">
                <div class="card-body">

                    <h4 class="text-center">Post share capital for members</h4>

                    <form class="pt-3" method="post" action="" id="admin-sell-member-shares">
                        <?= csrf_field()?>

                        <div class="form-group">
                            <label for="myInput" class="form-label">Select Member*</label>
                            <select id="myInput" class="form-select" name="memberName"></select>
                        </div>
                        <?php if(!empty($getCommission)) : ?>
                        <?php foreach ($getCommission as $commission) : ?>
                        <input type="hidden" name="commission" id="get_member_commission" value="<?= $commission['commission'] ?>">
                        <?php endforeach; ?>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="selectInput" class="form-label">Sacco Name*</label>
                            <?php if(!empty($sacco)) : ?>
                            <input type="text" class="form-control" id="select-sacco-name-id" data-id="<?= $sacco['sacco_id'] ?>" name="saccoName" value="<?= ucfirst($sacco['name'])?>">
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="membershipNumber" class="form-label">Membership Number*</label>
                            <input type="text" class="form-control" placeholder="Please enter membership number" name="membershipNumber" value="" id="membershipNumber">
                        </div>
                        <div class="form-group">
                            <label for="sharesAmount" class="form-label">Amount of Share capital*</label>
                            <input type="number" class="form-control" placeholder="Please enter the amount of share capital" id="sharesAmount" name="sharesAmount" value="">
                        </div>
                        <div class="form-group">
                            <label for="totalShareValue" class="form-label">Total share value*</label>
                            <input type="number" class="form-control" placeholder="Please enter total share value" name="total" value="" id="totalShareValue">
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-block btn-gradient-primary font-weight-medium auth-form-btn" id="admin-sell-shares">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>

        </div>
    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
    </div>
<?php $this->section('admin-post-shares-script') ?>
<script>
$(document).ready(function (){

    $("#myInput").select2({
        ajax: {
            url: "/admin/get-all-app-users",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    search: params.term
                };
            },
            processResults: function (data, params) {
                return {
                    results: $.map(data, function(obj) {
                        return { id: obj.user_id, text: obj.fname +" " + obj.lname };
                    })
                };
            },
            cache: true
        },
        minimumInputLength: 3,
        placeholder: 'Search members by name',
        templateResult: function(data) {
            if (data.loading) {
                return data.text;
            }

            return $('<div class="select2-result-repository">' + data.text + '</div>');
        }
    });


    $('#admin-sell-shares').on('click', function(){

        $('#admin-sell-member-shares').validate({
            rules: {
                errorClass: 'error',
                validClass: 'valid',
                memberName: {
                    required: true,
                },
                saccoName: {
                    required: true,
                },
                membershipNumber: {
                    required: true,
                    minlength: 8,
                    maxlength: 8,
                },
                sharesAmount: {
                    required: true,
                },
                total: {
                    required: true,
                }
            },
            messages: {
                memberName: {
                    required: "Please select a member",
                },
                saccoName: {
                    required: "Please select a sacco",
                },
                membershipNumber: {
                    required: "Please enter a membership number",
                    minlength: "Membership number must be 8 characters long",
                    maxlength: "Membership number must be 8 characters long",
                },
                sharesAmount: {
                    required: "Please enter the amount of shares",
                },
                total: {
                    required: "Please enter the total amount",
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
                let selectedOptionId = $('#myInput').select2('data')[0].id;
                let sacco_id = $('#select-sacco-name-id').data('id');
                let membershipNumber = $('#membershipNumber').val();
                let sharesAmount = $('#sharesAmount').val();
                let totalShareValue = $('#totalShareValue').val();
                let commission = $('#get_member_commission').val();

                let member_commission = (totalShareValue * commission) / 100;
                let total = Number(totalShareValue) + Number(member_commission);
                $('#admin-sell-shares').addClass('disabled');
                $('#admin-sell-shares').text('Please wait...');
                $.ajax({
                    url: '/admin/admin-sell-shares',
                    type: 'POST',
                    data: {
                        user_id: selectedOptionId,
                        sacco_id: sacco_id,
                        membershipNumber: membershipNumber,
                        sharesAmount: sharesAmount,
                        totalShareValue: totalShareValue,
                        total: total
                    },
                    success: function (response){
                        if(response.status === 200){
                            $('#admin-sell-member-shares').trigger('reset');

                            var delay = alertify.get('notifier','delay');
                            alertify.set('notifier','delay', 20);
                            alertify.success(response.messages);
                            alertify.set('notifier','delay', delay);

                        }else{
                            var delay = alertify.get('notifier','delay');
                            alertify.set('notifier','delay', 20);
                            alertify.error(response.messages);
                            alertify.set('notifier','delay', delay);
                        }
                    },

                    error: function (error){
                        console.log(error);
                    },
                    complete: function(xhr, status){
                        $('#admin-sell-shares').removeClass('disabled');
                        $('#admin-sell-shares').text('Submit');
                    }
                });
            }

        })


    });
});
</script>
<?php $this->endSection() ?>


