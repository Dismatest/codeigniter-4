<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Manage Users
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span><a href="<?= 'add-user-shares' ?>">Add shares <i class="mdi mdi-plus-box icon-sm text-primary align-middle"></i></a>
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
                                <td> Sacco </td>
                                <td> Cost </td>
                                <td> Date </td>
                                <td> Action </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($users)): ?>
                                <?php foreach($users as $user): ?>
                                    <tr>
                                        <td><?= ucfirst($user['fname']) .' '. ucfirst($user['lname']) ?></td>
                                        <td><?= $user['phone'] ?></td>
                                        <td><?= $user['membership_number'] ?></td>
                                        <td><?= $user['shares_amount'] ?></td>
                                        <td><?= $user['name'] ?></td>
                                        <td><?= $user['cost_per_share'] ?></td>
                                        <td><?= $date_created ?></td>
                                        <td>
                                            <a href="<?= 'update-user-shares/'.$user['sacco_shares_id'] ?>" style="font-size: 20px; color: grey" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                <i class="mdi mdi-tooltip-edit"></i>
                                            </a>
                                            <a href="<?= 'delete-user-shares/'.$user['sacco_shares_id'] ?>" style="font-size: 20px; color: grey">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No shares found, please go to <a href="<?= 'add-user-shares' ?>" class="text-warning">Add Shares</a> Add select customer who have been approved to join your sacco</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
<!--the start of the update user shares page-->
                        <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Update Share</p>
                                        <?php if(!empty($users)): ?>
                                        <?php foreach($users as $user): ?>
                                        <form method="post" action="<?= 'update-user-shares/'.$user['sacco_shares_id'] ?>">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Shares Amount</label>
                                                <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" name="sharesAmount" value="<?= $user['shares_amount'] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Update</button>
                                            </div>
                                        </form>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        the end of the update user shares page-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

