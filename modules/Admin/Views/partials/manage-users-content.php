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
                    <span>Admin/Manage New Members</span> <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
<h5 class="text-center p-2">Manage New Members</h5>
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
                                <th> ID Number </th>
                                <td> Sacco </td>
                                <td> Date </td>
                                <td> Status </td>
                                <td> Action </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($users)): ?>
                                <?php foreach($users as $user): ?>
                                    <tr>
                                        <td><?= ucfirst($user['fname']) .' '. ucfirst($user['lname']) ?></td>
                                        <td><?= $user['phone'] ?></td>
                                        <td><?= $user['id_number'] ?></td>
                                        <td><?= $user['name'] ?></td>
                                        <?php if(!empty($date_created)) : ?>
                                        <td><?= $date_created ?></td>
                                            <td><label class="badge badge-gradient-warning">pending</label></td>
                                        <?php endif; ?>
                                        <td>
                                            <a href="<?= 'delete-user-shares/'.$user['membership_id'] ?>" style="font-size: 20px; color: grey">
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

