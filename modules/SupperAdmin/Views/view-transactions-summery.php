<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
<?php $this->section('content');?>
    <div class="container-scroller">
        <!--    the start of the admin navbar component -->
        <?= $this->include('Modules\SupperAdmin\Views\includes\navbar.php'); ?>
        <!--    end of the admin navbar component -->
        <div class="container-fluid page-body-wrapper">
            <?= $this->include('Modules\SupperAdmin\Views\includes\sidebar.php');?>
            <div class="main-panel">
                <?= $this->include('Modules\SupperAdmin\Views\partials\view-transactions-summery-content.php');?>
            </div>
        </div>
    </div>
<?php $this->endSection();?>
<?php $this->section('transaction-summery-script');?>
    <script>
        $(document).ready(function () {
            $('#transaction-history-main-table').DataTable({
                searching: true // Enable searching
            });
        });
        $(document).ready(function(){
            $(document).on('click', '.transaction-history', function () {
                let saccoId = $(this).data('id');
                $.ajax({
                    url: '/supperAdmin/transaction-history-view/' +saccoId,
                    type: 'GET',
                    success: function (response) {
                        let html = '';
                        $.each(response.transactionHistory, function (value, item) {
                            html += '<tr>';
                            html += '<td>'+item.name+'</td>';
                            html += '<td>Ksh '+item.amount+'</td>';
                            html += '<td>'+item.transactionDate+'</td>';
                            html += '</tr>';
                        })
                        $('#view-transaction-history tbody').html(html);

                        $('#view-transaction-history').DataTable({
                            searching: true
                        });
                    }
                })
            })
        })
    </script>
<?php $this->endSection();?>
