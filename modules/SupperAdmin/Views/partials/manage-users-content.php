<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Manage Users
        </h3>
        <nav aria-label="breadcrumb">
            <div id="ManageUsers"></div>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="manageUsers" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th> Name </th>
                                <th> Phone Number </th>
                                <th> Email </th>
                                <th> Activation Status </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($users) && !empty($users)) :?>
                                <?php foreach($users as $user): ?>
                                    <tr>
                                        <td> <?= ucfirst($user['fname'] ). ' ' . ucfirst($user['lname']) ?> </td>
                                        <td> <?= $user['phone'] ?> </td>
                                        <td> <?= $user['email'] ?> </td>
                                        <?php if($user['activation_status'] == '1') : ?>
                                            <td> <i class="mdi mdi-check-circle" style="color: green; font-size: 24px;"></i> </td>
                                        <?php elseif($user['activation_status'] == '0') : ?>
                                            <td>

                                                <a href="<?= base_url().'/supperAdmin/manage-users/'.$user['uniid']; ?>" class="btn btn-gradient-success btn-rounded btn-icon" style="display: grid; place-items: center; width: 20px; height: 20px; margin: 0 3px;">
                                                    <i class="mdi mdi-email"></i>
                                                </a>
                                            </td>
                                        <?php endif; ?>


                                        <td class="d-flex">

                                            <a href="<?= base_url().'/supperAdmin/manage-users/edit/'.$user['uniid']; ?>" class="btn btn-gradient-success btn-rounded btn-icon" style="display: grid; place-items: center; width: 20px; height: 20px; margin: 0 3px;">
                                                <i class="mdi mdi-border-color"></i>
                                            </a>

                                            <a href="<?= base_url().'/supperAdmin/manage-users/delete/'.$user['uniid']; ?>" class="btn btn-gradient-danger btn-rounded btn-icon" style="height: 24px; width: 24px; display: grid; place-items: center;">
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

