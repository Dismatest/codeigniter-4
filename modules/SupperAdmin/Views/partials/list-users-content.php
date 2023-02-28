<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> List Users
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
            <div id="supperAdminExample" class="pb-3"></div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="supperAdminDataTable">
                            <thead>
                            <tr>
                                <th> Profile </th>
                                <th> Fname </th>
                                <th> Lname </th>
                                <th> Phone </th>
                                <th> Email </th>
                                <th> Activation </th>
                                <th> Created Date </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user) :;?>
                                <tr>
                                    <?php if(!empty($user['profile'])): ; ?>
                                        <td>
                                            <img src="<?= base_url().'/uploads/'.$user['profile'] ?>" class="me-2" alt="image">
                                        </td>
                                    <?php else: ;?>
                                        <td>
                                            <img src="<?= base_url('assets/images/faces/avatar.png') ?>" class="me-2" alt="image">
                                        </td>
                                    <?php endif; ?>
                                    <td> <?= $user['fname']; ?> </td>
                                    <td> <?= $user['lname']; ?> </td>
                                    <td> <?= $user['phone']; ?> </td>
                                    <td> <?= $user['email']; ?> </td>
                                    <?php if ($user['activation_status'] == 1) : ?>
                                        <td>
                                            <label class="badge badge-gradient-success">YES</label>
                                        </td>
                                    <?php elseif ($user['activation_status'] == 0) : ?>
                                        <td>
                                            <label class="badge badge-gradient-danger">NO</label>
                                        </td>
                                    <?php endif; ?>
<!--                                    <td> --><?php //= $user['created_at']; ?><!-- </td>-->
                                    <?php

                                    ?>
                                    <td> <?= $time ?></td>
                                    <?php
                                    ?>

                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

