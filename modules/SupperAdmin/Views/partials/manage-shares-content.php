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
                                <th> Sacco </th>
                                <th> Membership Number </th>
                                <th> Shares </th>
                                <th> Price </th>
                                <th> Total </th>
                                <th> Verification </th>
                                <th> Date Created </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($shares) && !empty($shares)) :?>
                            <?php foreach($shares as $share): ?>
                                    <tr>
                                        <td> <?= ucfirst($share['fname']) .' '. ucfirst($share['lname']) ?> </td>
                                        <td> <?= $share['sacco'] ?> </td>
                                        <td> <?= $share['membership_number'] ?> </td>
                                        <td> <?= $share['shares_amount'] ?> </td>
                                        <td> ksh <?= $share['cost'] ?> </td>
                                        <td> ksh <?= $share['total'] ?> </td>
                                        <?php if($share['is_verified'] == '1') : ?>
                                            <td> <i class="mdi mdi-check-circle" style="color: green;"></i> </td>
                                        <?php elseif($share['is_verified'] == '0') : ?>
                                            <td> <i class="mdi mdi-close-circle-outline" style="color: red;"></i> </td>
                                        <?php endif; ?>

                                        <td> <?= $time ?> </td>
                                        <td class="d-flex">

                                            <a href="<?= base_url().'/supperAdmin/manage-shares/edit/'.$share['uuid']; ?>" class="btn btn-gradient-success btn-rounded btn-icon" style="display: grid; place-items: center; width: 20px; height: 20px; margin: 0 3px;">
                                                <i class="mdi mdi-border-color"></i>
                                            </a>

                                            <a href="<?= base_url().'/supperAdmin/manage-shares/delete/'.$share['uuid']; ?>" class="btn btn-gradient-danger btn-rounded btn-icon" style="display: grid; place-items: center; width: 20px; height: 20px; margin: 0 3px;">
                                                <i class="mdi mdi-delete"></i>
                                            </a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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

