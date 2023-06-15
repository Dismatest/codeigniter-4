<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
<?php $this->section('content');?>
    <div class="container-scroller">
        <!--    the start of the admin navbar component -->
        <?= $this->include('Modules\SupperAdmin\Views\includes\navbar.php'); ?>
        <!--    end of the admin navbar component -->
        <div class="container-fluid page-body-wrapper">
            <?= $this->include('Modules\SupperAdmin\Views\includes\sidebar.php');?>
            <div class="main-panel">
                <?= $this->include('Modules\SupperAdmin\Views\partials\set-seller-commission-content.php');?>
            </div>
        </div>
    </div>
<?php $this->endSection();?>
<?php $this->section('set-seller-commission'); ?>
<script>
    $(document).ready(function(){
        $('#save-seller-commission').on('click', function () {
            let sellerCommission = $('#selectInputSellerCommission').val();
            if (sellerCommission === "") {
                $('.buyer-commission-error').text("Please enter a number")
                return false;
            } else {
                $('.buyer-commission-error').text("")
            }
            if (sellerCommission < 0) {
                $('.seller-commission-error').text("Commission must be greater than 0")
                return false;
            } else {
                $('.buyer-commission-error').text("")
            }
            if (sellerCommission > 100) {
                $('.buyer-commission-error').text("Commission must be less than 100")
                return false;
            } else {
                $('.buyer-commission-error').text("")
            }
            $('#save-seller-commission').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> Please wait ...');
            $.ajax({
                url: "<?= base_url('supperAdmin/set_commission/seller_commission')?>",
                type: "POST",
                data: {
                    sellerCommission: sellerCommission,
                },

                success: function (response) {
                    if (response.status === 200) {
                        $('.seller-commission-success').text(response.message)
                        setTimeout(function () {
                            $('.seller-commission-success').text("");
                            $('#selectInputSellerCommission').val("");
                            $('#exampleModal').modal('hide');
                            loadSellerCommission();
                        }, 3000)
                    }
                },
                error: function (error) {
                    $('.seller-commission-error').text(error.message);
                },
                complete: function (status) {
                    $('#save-sellers-commission').prop('disabled', false).html('Save');
                }
            })
        })


        function loadSellerCommission() {
            $.ajax({
                url: "<?= base_url('supperAdmin/set_commission/get_seller_commission')?>",
                type: "GET",
                success: function (response) {
                    if (response.status === 200) {

                        $('#seller-commission-table tbody').empty();
                        $.each(response.data, function (key, value) {
                            let row = `<tr>
                                            <td>${value.seller_commission}</td>
                                            <td>${value.created_at}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateExampleModal" id="edit-seller-commission" data-id="${value.commission_id}"><i class="mdi mdi-border-color"></i></button>
                                                <button class="btn btn-danger btn-sm" id="delete-seller-commission" data-id="${value.commission_id}"><i class="mdi mdi-delete"></i></button>
                                            </td>
                                        </tr>`;
                            $('#seller-commission-table tbody').append(row);
                        });
                    }
                },
                error: function (error) {
                    console.log(error)
                },
            });
        }

        loadSellerCommission();


        $('#seller-commission-table tbody').on('click', '#edit-seller-commission', function () {

            let id = $(this).data('id');
            $.ajax({
                url: "<?= base_url('supperAdmin/set_commission/get_seller_commission_by_id')?>",
                type: "GET",
                data: {
                    commission_id: id
                },
                success: function (response) {
                    if (response.status === 200) {
                        $('#updateSellerCommission').val(response.data.seller_commission);
                    }
                },
            })
        });

        $('#update-seller-commission').on('click', function (){
            let commissionId = $('#edit-seller-commission').data('id');
            let sellerCommission = $('#updateSellerCommission').val();
            if (sellerCommission === "") {
                $('.update-commission-error').text("Please enter a number")
                return false;
            } else {
                $('.update-commission-error').text("")
            }
            if (sellerCommission <= 0) {
                $('.update-commission-error').text("Commission must be greater than 0")
                return false;
            } else {
                $('.update-commission-error').text("")
            }
            if (sellerCommission > 100) {
                $('.update-commission-error').text("Commission must be less than 100")
                return false;
            } else {
                $('.update-commission-error').text("")
            }
            $('#update-seller-commission').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> Please wait ...');
            $.ajax({
                url: "<?= base_url('supperAdmin/set_commission/update_seller_commission_by_id')?>",
                type: "POST",
                data: {
                    commissionId: commissionId,
                    sellerCommission: sellerCommission,
                },
                success: function (response) {
                    if (response.status === 200) {
                        $('.update-commission-success').text(response.message)
                        setTimeout(function () {
                            $('.update-commission-success').text("");
                            $('#updateExampleModal').modal('hide');
                            loadSellerCommission();
                        }, 3000)
                    }
                },
                error: function (response) {
                    $('.update-commission-error').text(response.message);
                },
                complete: function (status) {
                    $('#update-seller-commission').removeClass('disabled').html('Save');
                }
            })
        })


        $('#seller-commission-table tbody').on('click', '#delete-seller-commission', function () {
            let id = $(this).data('id');
            $.ajax({
                url: "<?= base_url('supperAdmin/set_commission/delete_seller_commission_by_id')?>",
                type: "POST",
                data: {
                    commission_id: id
                },
                success: function (response) {
                    if (response.status === 200) {
                        loadSellerCommission();
                        alertify.set('notifier','position', 'bottom-right');
                        alertify.success(response.message);
                    }else{
                        alertify.set('notifier','position', 'bottom-right');
                        alertify.error(response.message);
                    }
                },
                error: function (error) {
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.error('Something went wrong');
                },
            })
        })

    })
</script>
<?php $this->endSection() ;?>
