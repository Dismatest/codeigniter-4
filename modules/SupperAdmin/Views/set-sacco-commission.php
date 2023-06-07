<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
<?php $this->section('content');?>
    <div class="container-scroller">
        <!--    the start of the admin navbar component -->
        <?= $this->include('Modules\SupperAdmin\Views\includes\navbar.php'); ?>
        <!--    end of the admin navbar component -->
        <div class="container-fluid page-body-wrapper">
            <?= $this->include('Modules\SupperAdmin\Views\includes\sidebar.php');?>
            <div class="main-panel">
                <?= $this->include('Modules\SupperAdmin\Views\partials\set-sacco-commission-content.php');?>
            </div>
        </div>
    </div>
<?php $this->endSection();?>
<?php $this->section('set-sacco-commission');?>
<script>
    $(document).ready(function () {
        $('#save-sacco-commission').on('click', function (){
            let selectedSacco = $('#selectSacco').val();
            let saccoCommission = $('#saccoCommission').val();
            if (selectedSacco === "") {
                $('.sacco-commission-error-select').text("Please select a sacco")
                return false;
            } else {
                $('.sacco-commission-error-select').text("")
            }
            if (saccoCommission === "") {
                $('.sacco-commission-error-input').text("Please enter a number")
                return false;
            } else {
                $('.sacco-commission-error-input').text("")
            }

            $('#save-sacco-commission').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> Please wait ...');
            $.ajax({
                url: "<?= base_url('supperAdmin/set_sacco_commission')?>",
                type: "POST",
                data: {
                    saccoId: selectedSacco,
                    saccoCommission: saccoCommission,
                },
                success: function (response){
                    if (response.status === 200) {
                        $('.sacco-commission-success-container').css('display', 'block');
                        $('.set-sacco-commission-success').text(response.message)
                        setTimeout(function () {
                            $('.sacco-commission-success-container').css('display', 'none');
                            $('.set-sacco-commission-success').text("");
                            $('#selectSacco').val("");
                            $('#saccoCommission').val("");
                            $('#set-sacco-commission').modal('hide');
                            loadSaccoCommission();
                        }, 5000)
                    }else{
                        $('.sacco-commission-error-container').css('display', 'block');
                        $('.set-sacco-commission-error').text(response.message)
                    }
                },
                error: function (error){
                    $('.sacco-commission-error-container').css('display', 'block');
                    $('.set-sacco-commission-error').text('Something went wrong');
                },
                complete: function (status) {
                    $('#save-sacco-commission').removeClass('disabled').html('Save');
                }
            });
        })


        function loadSaccoCommission(){
            $.ajax({
                url: "<?= base_url('supperAdmin/set_sacco_commission/get_sacco_commission')?>",
                type: "GET",
                success: function (response){
                    if (response.status === 200) {
                        $('#sacco-commission-table tbody').empty();
                        response.data.forEach(function (saccoCommission){
                            let row = `<tr>
                                            <td>${saccoCommission.name}</td>
                                            <td>${saccoCommission.sacco_commission}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" id="edit-sacco-commission" data-id="${saccoCommission.sacco_commission_id}">
                                                    <i class="mdi mdi-border-color"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" id="delete-sacco-commission" data-sacco="${saccoCommission.sacco_id}" data-id="${saccoCommission.sacco_commission_id}">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </td>
                                        </tr>`;
                            $('#sacco-commission-table tbody').append(row);
                        });
                    }
                },
                error: function (error) {
                    console.log(error)
                },
            });
        }

        loadSaccoCommission();

        $('#sacco-commission-table tbody').on('click', '#edit-sacco-commission', function (){
            let saccoCommissionId = $(this).data('id');
            $.ajax({
                url: "<?= base_url('supperAdmin/set_sacco_commission/get_sacco_commission_by_id')?>",
                type: "GET",
                data: {
                    saccoCommissionId: saccoCommissionId,
                },
                success: function (response){
                    if (response.status === 200) {
                        $('#sacco_id').val(response.data.sacco_id);
                        $('#updateSaccoCommissionName').val(response.data.name);
                        $('#updateSaccoCommission').val(response.data.sacco_commission);
                    }
                },
                error: function (error){
                    console.log(error)
                }
            });
        })


        $('#update-sacco-commission').on('click', function (){
            let saccoCommissionId = $('#sacco_id').val();
            let saccoCommission = $('#updateSaccoCommission').val();
            if (saccoCommission === "") {
                $('.update-sacco-commission-error').text("Please enter the sacco commission");
                return false;
            } else {
                $('.update-sacco-commission-error').text("")
            }
            $('#update-sacco-commission').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> Please wait ...');
            $.ajax({
                url: "<?= base_url('supperAdmin/set_sacco_commission/update_sacco_commission_by_id')?>",
                type: "POST",
                data: {
                    saccoCommissionId: saccoCommissionId,
                    saccoCommission: saccoCommission,
                },
                success: function (response){
                    if (response.status === 200) {
                        $('.sacco-commission-success-container').css('display', 'block');
                        $('.set-sacco-commission-success').text(response.message)
                        setTimeout(function () {
                            $('.sacco-commission-success-container').css('display', 'none');
                            $('.set-sacco-commission-success').text("");
                            $('#exampleModal').modal('hide');
                            loadSaccoCommission();
                        }, 5000)
                    }else{
                        $('.sacco-commission-error-container').css('display', 'block');
                        $('.set-sacco-commission-error').text(response.message)
                    }
                },
                error: function (error){
                    $('.sacco-commission-error-container').css('display', 'block');
                    $('.set-sacco-commission-error').text('Something went wrong');
                },
                complete: function (status) {
                    $('#update-sacco-commission').removeClass('disabled').html('Save changes');
                }
            });
        })

        $('#sacco-commission-table tbody').on('click', '#delete-sacco-commission', function (){
            let saccoCommissionId = $(this).data('id');
            let saccoId = $(this).data('sacco');
            console.log(saccoCommissionId)
            $.ajax({
                url: "<?= base_url('supperAdmin/set_sacco_commission/delete_sacco_commission_by_id')?>",
                type: "POST",
                data: {
                    saccoCommissionId: saccoCommissionId,
                    saccoId: saccoId,
                },
                success: function (response){
                    if (response.status === 200) {
                        if (response.status === 200) {
                            loadSaccoCommission();
                            alertify.set('notifier','position', 'bottom-right');
                            alertify.success(response.message);
                        }else{
                            alertify.set('notifier','position', 'bottom-right');
                            alertify.error(response.message);
                        }
                    }
                },
                error: function (error){
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.error('Something went wrong');
                },
            });
        })

        $('#sacco-commission-table').DataTable({
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
