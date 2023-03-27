<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> User Login Activities
        </h3>
        <nav aria-label="breadcrumb">
            <div id="supperAdminExample"></div>
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
                                <th></th>
                                <th> Fname </th>
                                <th> Lname </th>
                                <th> Agent </th>
                                <th> Login Time </th>
                                <th> Logout Time </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($users)) :?>
                            <?php foreach ($users as $user) :?>
                            <tr>
                                <td class="test">1</td>
                                <td> <?= ucfirst($user['fname']); ?> </td>
                                <td> <?= ucfirst($user['lname']); ?> </td>
                                <td> <?= ucfirst($user['agent']); ?> </td>
                                <td> <?= $user['login_time']; ?> </td>
                                <td> <?= $user['logout_time']; ?> </td>
                                <?php if($user['logout_time'] == '0000-00-00 00:00:00'): ?>
                                    <td>
                                        <label class="badge badge-gradient-success">ONLINE</label>
                                    </td>
                                <?php else: ?>
                                    <td>
                                        <label class="badge badge-gradient-danger">OFFLINE</label>
                                    </td>
                                <?php endif;?>
                                <td>
                                    <a href="<?= base_url('supperAdmin/user-log-in-activities/'.$user['id']); ?>" style="height: 24px; width: 24px; display: grid; place-items: center;" class="btn btn-gradient-primary btn-rounded btn-icon">
                                        <i class="mdi mdi-delete"></i>
                                    </a>
                                </td>
                            <?php endforeach;?>
                            <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

