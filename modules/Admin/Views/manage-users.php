<?php $this->extend("Modules\Admin\Views\adminLayouts\base"); ?>
<?php $this->section('content'); ?>
<div class="container-scroller">
    <!--    the start of the admin navbar component -->
    <?= $this->include('Modules\Admin\Views\includes\navbar'); ?>
    <!--    end of the admin navbar component -->
    <div class="container-fluid page-body-wrapper">
        <?= $this->include('Modules\Admin\Views\includes\sidebar'); ?>
        <div class="main-panel">
            <?= $this->include('Modules\Admin\Views\partials\manage-users-content'); ?>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>
<?php $this->section('sacco-membership-script'); ?>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });

    $(document).ready(function () {
        $(document).on('click', '.approve-btn', function () {
            let id = $(this).data('id');
            $.ajax({
                url: '/admin/manage-membership/get-member-data/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#membership-data tbody').empty();
                    let row = '<tr>' +
                        '<td>' + data.fname + ' ' + data.lname + '</td>' +
                        '<td>' + data.phone + '</td>' +
                        '<td>' + data.id_number + '</td>' +
                        '</tr>';
                    $('#membership-data tbody').append(row);
                }
            })
        });

        $(document).on('click', '.approve-membership', function () {
            let membershipID = $(this).data('id');
            $.ajax({
                url: '/admin/manage-membership/approve-share',
                type: 'POST',
                data: {membershipID: membershipID},
                dataType: 'json',
                success: function(data){
                    if(data.status === 200) {
                        $('#member-success').text(data.message);
                        $('#member-success').css('display', 'block');
                        setTimeout(function(){
                            $('#staticBackdrop').modal('hide');
                        }, 2000);
                    }else{
                        $('#member-error').text(data.message);
                        $('#member-error').css('display', 'block');
                    }
                },
                error: function(data){
                    $('#member-error').text('Something went wrong');
                    $('#member-error').css('display', 'block');
                },
                onCompleted: function(data){
                    console.log(data);
                }
            });
        });

    });
</script>
<?php $this->endSection(); ?>

