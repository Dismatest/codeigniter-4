<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> SupperAdmin Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <a href="<?= base_url().'/supperAdmin/list-users' ?>" style="text-decoration: none; color: white;">
                        <img src="<?=base_url('assets/images/dashboard/circle.svg')?>" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Users <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <?php if(isset($allUsers) && $allUsers > 0): ?>
                            <h2 class="mb-5">Users: <?= $allUsers ?></h2>
                        <?php else: ?>
                            <h2 class="mb-5">0</h2>
                        <?php endif; ?>
                        <h6 class="card-text">Increased by 60%</h6>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <a href="<?= base_url().'/supperAdmin/manage-sacco'?>" style="text-decoration: none; color: white;">
                        <img src="<?=base_url('assets/images/dashboard/circle.svg')?>" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Sacco <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                        </h4>
                        <?php if(isset($allSacco) && $allSacco > 0): ?>
                            <h2 class="mb-5">Sacco: <?= $allSacco ?></h2>
                        <?php else: ?>
                            <h2 class="mb-5">0</h2>
                        <?php endif; ?>
                        <h6 class="card-text">Decreased by 10%</h6>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="<?= base_url('assets/images/dashboard/circle.svg')?>" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Transactions <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <?php if(isset($allTransactions) && $allTransactions > 0): ?>
                        <h2 class="mb-5">Ksh: <?= $allTransactions ?></h2>
                    <?php else: ?>
                        <h2 class="mb-5">Ksh: 0</h2>
                    <?php endif; ?>
                    <h6 class="card-text">Increased by 5%</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <h4 class="transaction-icons-main"><i class="mdi mdi-grid transaction-icon"></i>Saccos Monthly Transactions Line Graph</h4>
                        <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>

                    <div>
                        <canvas height="200" id="myChart" class="mt-4"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <h4 class="transaction-icons-main"><i class="mdi mdi-grid transaction-icon"></i>Saccos Monthly Transactions Bar Graph</h4>
                        <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>

                    <div>
                        <canvas height="200" id="myChartTwo" class="mt-4"></canvas>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>

    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>