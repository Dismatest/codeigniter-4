<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Manage Shares
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
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Location </th>
                                <th> Website </th>
                                <th> Date Joined </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($sacco) && !empty($sacco)) :?>
                                <?php foreach ($sacco as $sacco) :?>
                                    <tr>
                                        <td><?= $sacco['name']; ?></td>
                                        <td><?= $sacco['email']; ?></td>
                                        <td><?= $sacco['location']; ?></td>
                                        <?php if($sacco['website'] == '') :?>
                                            <td>Not Available</td>
                                        <?php else :?>
                                        <td><?= $sacco['website']; ?></td>
                                        <?php endif; ?>
                                        <td><?= date('Y-m-d', strtotime($sacco['created_at'])); ?></td>
                                        <td class="d-flex">

                                            <a href="<?= base_url().'/supperAdmin/manage-sacco/edit/'.$sacco['uuid']; ?>" class="btn btn-gradient-success btn-rounded btn-icon" style="display: grid; place-items: center; width: 20px; height: 20px; margin: 0 3px;">
                                                <i class="mdi mdi-border-color"></i>
                                            </a>

                                            <a href="<?= base_url().'/supperAdmin/manage-sacco/delete/'.$sacco['uuid']; ?>" class="btn btn-gradient-danger btn-rounded btn-icon" style="display: grid; place-items: center; width: 20px; height: 20px; margin: 0 3px;">
                                                <i class="mdi mdi-delete"></i>
                                            </a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No Sacco Found <a href="<?= 'register-sacco' ?>">Add New</a></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

