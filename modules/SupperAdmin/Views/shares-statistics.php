<?php $this->extend("Modules\SupperAdmin\Views\adminLayouts\base.php");?>
<?php $this->section('content');?>
    <div class="container-scroller">
        <!--    the start of the admin navbar component -->
        <?= $this->include('Modules\SupperAdmin\Views\includes\navbar.php'); ?>
        <!--    end of the admin navbar component -->
        <div class="container-fluid page-body-wrapper">
            <?= $this->include('Modules\SupperAdmin\Views\includes\sidebar.php');?>
            <div class="main-panel">
                <?= $this->include('Modules\SupperAdmin\Views\partials\share-statistics-content.php');?>
            </div>
        </div>
    </div>
<?php $this->endSection();?>
<?php $this->section('share-statistics');?>
    <script>
        $(document).ready(function(){
            const ctx = document.getElementById('activeShares').getContext('2d')
            console.log(ctx)
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Match', 'April', 'May', 'June'],
                    datasets: [{
                        label: 'Shares history',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        fill: false,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    }
                }
            });


            const adminBar = document.getElementById('soldShares').getContext('2d');
            if (adminBar) {
                const adminChart = new Chart(adminBar, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Match', 'April', 'May', 'June'],
                        datasets: [{
                            label: 'Six months transaction history',
                            data: [12, 19, 3, 5, 6, 3],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1,
                            fill: false,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                            }
                        }
                    }
                });
            }
        });
    </script>
<?php $this->endSection();?>
