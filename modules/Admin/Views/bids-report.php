<?php $this->extend("Modules\Admin\Views\adminLayouts\base");?>
<?php $this->section('content');?>
    <div class="container-scroller">
        <!--    the start of the admin navbar component -->
        <?= $this->include('Modules\Admin\Views\includes\navbar'); ?>
        <!--    end of the admin navbar component -->
        <div class="container-fluid page-body-wrapper">
            <?= $this->include('Modules\Admin\Views\includes\sidebar');?>
            <div class="main-panel">
                <?= $this->include('Modules\Admin\Views\partials\bids-report-content');?>
            </div>
        </div>
    </div>
<?php $this->endSection();?>
<?php $this->section('bids-report-script');?>
    <script>
        $(document).ready(function(){
            $('#bidsReport').DataTable();

            $('.view-bids').on('click', function () {
                let ht = $('#success')
                let shareUuid = $(this).data('id');
                $.ajax({
                    url: '/admin/bids-report/view-report/' + shareUuid,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        let tableBody = $('#bidsReportModal tbody');
                        tableBody.empty(); // Clear the table body before populating new data

                        $.each(data.bids, function (key, value) {
                            let row = $('<tr>');
                            row.append('<td>' + value.fname + ' ' + value.lname + '</td>');
                            row.append('<td>' + value.buyer_membership_number + '</td>');
                            row.append('<td>' + value.shares_on_sale + '</td>');
                            row.append('<td>ksh ' + value.total + '</td>');
                            row.append('<td>Ksh ' + value.bid_amount + '</td>');

                            let status;
                            if (value.action === '0') {
                                status = '<span class="text-primary">Pending</span>';
                            } else if (value.action === '1') {
                                status = '<span class="text-success">Approved</span>';
                            } else if (value.action === '2') {
                                status = '<span class="text-danger">Rejected</span>';
                            }
                            row.append('<td>' + status + '</td>');

                            let actionCell = $('<td>');
                            checkApprove(value.uuid, function (data) {
                                if (data.checkApprove === true) {
                                    actionCell.append('<button class="btn btn-success btn-sm" disabled>Approve</button>');
                                    actionCell.append('<button class="btn btn-danger btn-sm m-1" disabled>Reject</button>');
                                } else if (data.checkApprove === false) {
                                    actionCell.append('<button class="btn btn-success btn-sm approve-btn" data-id="' + value.bid_uuid + '">Approve</button>');
                                    actionCell.append('<button class="btn btn-danger btn-sm m-1 reject-btn" data-id="' + value.bid_uuid + '">Reject</button>');
                                }
                            });
                            row.append(actionCell);

                            row.append('<td>' + value.updated_at + '</td>');

                            tableBody.append(row);

                            $('#bidsReportModal').DataTable({
                                destroy: true,
                                responsive: true,
                                searching: true,
                                autoWidth: false,
                                "order": [[ 7, "desc" ]]
                            });
                        });
                    }
                });
            });

            $('#bidsReportModal').on('click', '.approve-btn', function () {
                let shareUuid = $(this).data('id');
                $.ajax({
                    url: '/admin/bids-report/approve-share',
                    type: 'POST',
                    data: {
                        shareUuid: shareUuid
                    },
                    success: function (data) {
                        console.log(data.message);
                        if(data.status === 200){
                            setTimeout(function () {
                                $('#success').text(data.message);
                                $('#success').css('display', 'block');
                                $('#displayBidsModal').modal('hide');
                            }, 4000)
                        }else{
                            setTimeout(function () {
                                $('#error').text(data.message);
                            }, 4000)
                        }
                    },
                    error: function (data) {
                        setTimeout(function () {
                            $('#error').html(data.message);
                            ('#error').css('display', 'block');
                        }, 1000)
                    }
                });
            });



            $('#bidsReportModal').on('click', '.reject-btn', function () {
                let shareUuid = $(this).data('id');
                $.ajax({
                    url: '/admin/bids-report/reject-share',
                    type: 'POST',
                    data: {
                        shareUuid: shareUuid
                    },
                    success: function (data) {
                        console.log(data.message);
                        if(data.status === 200){
                            setTimeout(function () {
                                alertify.set('notifier', 'position', 'bottom-right');
                                alertify.success(response.message);
                                $('#displayBidsModal').modal('hide');
                            }, 4000)
                        }else{
                            setTimeout(function () {
                                $alertify.set('notifier', 'position', 'bottom-right');
                                alertify.error(response.message);
                            }, 4000)
                        }
                    },
                    error: function (data) {
                        setTimeout(function () {
                            alertify.set('notifier', 'position', 'bottom-right');
                            alertify.error('there was an error');
                        }, 1000)
                    }
                });
            });

            function checkApprove(shareUuid, callback) {
                $.ajax({
                    url: '/admin/bids-report/check-approve/' + shareUuid,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        callback(data);
                    }
                });
            }
        });
    </script>
<?php $this->endSection();?>

