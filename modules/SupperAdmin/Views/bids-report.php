<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
<?php $this->section('content');?>
    <div class="container-scroller">
        <!--    the start of the admin navbar component -->
        <?= $this->include('Modules\SupperAdmin\Views\includes\navbar.php'); ?>
        <!--    end of the admin navbar component -->
        <div class="container-fluid page-body-wrapper">
            <?= $this->include('Modules\SupperAdmin\Views\includes\sidebar.php');?>
            <div class="main-panel">
                <?= $this->include('Modules\SupperAdmin\Views\partials\bids-report-content.php');?>
            </div>
        </div>
    </div>
<?php $this->endSection();?>
<?php $this->section('view-bids-modal');?>
    <script>
        $(document).ready(function () {
            $('#bidsReport').DataTable();

            $('.view-bids').on('click', function () {
                let shareUuid = $(this).data('id');
                $.ajax({
                    url: '/supperAdmin/bids-report/view-report/' + shareUuid,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        let html = '';
                        $.each(data.bids, function (key, value) {
                            html += '<tr>';
                            html += '<td>' + value.fname + ' ' + value.lname + '</td>';
                            html += '<td>' + value.buyer_membership_number + '</td>';
                            html += '<td>' + value.shares_on_sale + '</td>';
                            html += '<td>ksh ' + value.total + '</td>';
                            html += '<td>Ksh ' + value.bid_amount + '</td>';

                            if (value.action === '0') {
                                html += '<td><span class="badge-gradient-primary p-1">Pending</span></td>';
                            } else if (value.action === '1') {
                                html += '<td><span class="badge-gradient-success p-1">Approved</span></td>';
                            }else if(value.action === '2'){
                                html += '<td><span class="badge-gradient-warning p-1">Rejected</span></td>';
                            }

                            html += '<td>' + value.updated_at + '</td>';
                            html += '</tr>';
                        });
                        $('#bidsReport tbody').html(html);
                    }

                });
            });
        });
    </script>
<?php $this->endSection();?>