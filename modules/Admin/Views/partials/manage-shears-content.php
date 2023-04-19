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
                    <span></span><a href="<?= 'create_share' ?>">Create New <i class="mdi mdi-plus-box icon-sm text-primary align-middle"></i></a>
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
                                <th> Phone Number </th>
                                <th> Membership Number </th>
                                <td> Shares Amount </td>
                                <td> Total </td>
                                <td> Date </td>
                                <td> Status </td>
                                <td> Action </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($shares) && !empty($shares)): ?>
                            <?php foreach ($shares as $share): ?>
                                <tr>
                                    <td><?= $share['fname'] .' '. $share['lname'] ?></td>
                                    <td><?= $share['phone'] ?></td>
                                    <td><?= $share['membership_number'] ?></td>
                                    <td><?= $share['shares_on_sale'] ?></td>
                                    <td>Ksh: <?= $share['total'] ?></td>
                                    <?php if(isset($time) && !empty($time)): ?>
                                    <td><?= $time ?></td>
                                    <?php endif; ?>
                                    <?php if ($share['is_verified'] == 0): ?>
                                        <td><label class="badge badge-gradient-warning">Pending</label></td>
                                    <?php else: ?>
                                        <td><label class="badge badge-gradient-success">Approved</label></td>
                                    <?php endif; ?>
                                    <td>

                                        <a href="<?= 'delete-share/'.$share['uuid'] ?>" class="btn btn-gradient-danger btn-rounded btn-icon" style="display: grid; place-items: center; width: 20px; height: 20px; margin: 0 3px;">
                                            <i class="mdi mdi-delete"></i>
                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="9" class="text-center">No shares found</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Approve Share</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <p>Are you sure you want to approve this share?</p>

                                        <form method="post" action="<?= 'verify-share/'.$share['uuid'] ?>">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-primary approve-btn">Verify</button>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

