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
                    <span></span>Dashboard/Statistics <i class="mdi mdi-table-large icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="set-buyer-commission-container">
            <h5 class="buyer-commission-container"><span><i class="mdi mdi-table-large buyer-commission"></i></span> Share Capital statistics</h5>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <h4 class="transaction-icons-main"><i class="mdi mdi-grid transaction-icon"></i>Active Share capital Statistics</h4>
                        <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>

                    <div>
                        <canvas height="300" id="activeShares" class="mt-4"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <h4 class="transaction-icons-main"><i class="mdi mdi-grid transaction-icon"></i>Sold Share capital Statistics</h4>
                        <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>

                    <div>
                        <canvas height="300" id="soldShares" class="mt-4"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?= $this->include('Modules\Admin\Views\includes\footer.php'); ?>
</div>

