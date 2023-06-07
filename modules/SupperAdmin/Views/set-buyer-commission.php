<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
<?php $this->section('content');?>
    <div class="container-scroller">
        <!--    the start of the admin navbar component -->
        <?= $this->include('Modules\SupperAdmin\Views\includes\navbar.php'); ?>
        <!--    end of the admin navbar component -->
        <div class="container-fluid page-body-wrapper">
            <?= $this->include('Modules\SupperAdmin\Views\includes\sidebar.php');?>
            <div class="main-panel">
                <?= $this->include('Modules\SupperAdmin\Views\partials\set-buyer-commission-content.php');?>
            </div>
        </div>
    </div>
<?php $this->endSection();?>
<?php $this->section('set-buyer-commission');?>
<script>
    $(document).ready(function() {
        $('#save-buyers-commission').on('click', function () {
            let buyerCommission = $('#selectInputBuyerCommission').val();
            if (buyerCommission === "") {
                $('.buyer-commission-error').text("Please enter a number")
                return false;
            } else {
                $('.buyer-commission-error').text("")
            }
            if (buyerCommission < 0) {
                $('.buyer-commission-error').text("Commission must be greater than 0")
                return false;
            } else {
                $('.buyer-commission-error').text("")
            }
            if (buyerCommission > 100) {
                $('.buyer-commission-error').text("Commission must be less than 100")
                return false;
            } else {
                $('.buyer-commission-error').text("")
            }
            $('#save-buyers-commission').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> Please wait ...');
            $.ajax({
                url: "<?= base_url('supperAdmin/set_commission/buyer_commission')?>",
                type: "POST",
                data: {
                    buyerCommission: buyerCommission,
                },

                success: function (response) {
                    if (response.status === 200) {
                        $('.buyer-commission-success').text(response.message)
                        setTimeout(function () {
                            $('.buyer-commission-success').text("");
                            $('#selectInputBuyerCommission').val("");
                            $('#exampleModal').modal('hide');
                            loadBuyerCommission();
                        }, 3000)
                    }
                },
                error: function (error) {
                    $('.buyer-commission-error').text(error.message);
                },
                complete: function (status) {
                    $('#save-buyers-commission').removeClass('disabled').html('Save');
                }
            });
        });

        function loadBuyerCommission() {
            $.ajax({
                url: "<?= base_url('supperAdmin/set_commission/get_buyer_commission')?>",
                type: "GET",
                success: function (response) {
                    if (response.status === 200) {

                        $('#buyer-commission-table tbody').empty();
                        $.each(response.data, function (key, value) {
                            let row = `<tr>
                                            <td>${value.commission}</td>
                                            <td>${value.created_at}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateExampleModal" id="edit-buyer-commission" data-id="${value.commission_id}"><i class="mdi mdi-border-color"></i></button>
                                                <button class="btn btn-danger btn-sm" id="delete-buyer-commission" data-id="${value.commission_id}"><i class="mdi mdi-delete"></i></button>
                                            </td>
                                        </tr>`;
                            $('#buyer-commission-table tbody').append(row);
                        });
                    }
                },
                error: function (error) {
                    console.log(error)
                },
            });
        }

        loadBuyerCommission();

        $('#buyer-commission-table tbody').on('click', '#edit-buyer-commission', function () {

            let id = $(this).data('id');
            $.ajax({
                url: "<?= base_url('supperAdmin/set_commission/get_buyer_commission_by_id')?>",
                type: "GET",
                data: {
                    commission_id: id
                },
                success: function (response) {
                    if (response.status === 200) {
                        $('#updateBuyerCommission').val(response.data.commission);
                    }
                },
            })
        });

        $('#update-buyers-commission').on('click', function (){
            let commissionId = $('#edit-buyer-commission').data('id');
            let buyerCommission = $('#updateBuyerCommission').val();
            if (buyerCommission === "") {
                $('.update-commission-error').text("Please enter a number")
                return false;
            } else {
                $('.update-commission-error').text("")
            }
            if (buyerCommission < 0) {
                $('.update-commission-error').text("Commission must be greater than 0")
                return false;
            } else {
                $('.update-commission-error').text("")
            }
            if (buyerCommission > 100) {
                $('.update-commission-error').text("Commission must be less than 100")
                return false;
            } else {
                $('.update-commission-error').text("")
            }
            $('#update-buyers-commission').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> Please wait ...');
            $.ajax({
                url: "<?= base_url('supperAdmin/set_commission/update_buyer_commission_by_id')?>",
                type: "POST",
                data: {
                    commissionId: commissionId,
                    buyerCommission: buyerCommission,
                },
                success: function (response) {
                    if (response.status === 200) {
                        $('.update-commission-success').text(response.message)
                        setTimeout(function () {
                            $('.update-commission-success').text("");
                            $('#updateExampleModal').modal('hide');
                            loadBuyerCommission();
                        }, 3000)
                    }
                },
                error: function (response) {
                    $('.update-commission-error').text(response.message);
                },
                complete: function (status) {
                    $('#update-buyers-commission').removeClass('disabled').html('Save');
                }
            })
        })


        $('#buyer-commission-table tbody').on('click', '#delete-buyer-commission', function () {
            let id = $(this).data('id');
            $.ajax({
                url: "<?= base_url('supperAdmin/set_commission/delete_buyer_commission_by_id')?>",
                type: "POST",
                data: {
                    commission_id: id
                },
                success: function (response) {
                    if (response.status === 200) {
                        loadBuyerCommission();
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

        $('#buyer-commission-table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
    });
</script>
<?php $this->endSection();?>
