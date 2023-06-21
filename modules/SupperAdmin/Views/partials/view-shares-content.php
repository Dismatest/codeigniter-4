<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Supper Admin Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>supperAdmin/view Shares <i class="mdi mdi-code-string icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="set-buyer-commission-container">
                <h5 class="buyer-commission-container"><span><i class="mdi mdi-code-string buyer-commission"></i></span> View Shares</h5>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th> Owner </th>
                                <th> Membership Number </th>
                                <th> Sacco </th>
                                <th> Shares </th>
                                <th> Value </th>
                                <th> Status </th>
                                <th> Date Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($shares)) :?>
                            <?php foreach($shares as $share): ?>
                                    <tr>
                                        <td> <?= ucfirst($share['fname']) .' '. ucfirst($share['lname']) ?> </td>
                                        <td> <?= $share['membership_number'] ?> </td>
                                        <td> <?= $share['name'] ?> </td>
                                        <td> <?= $share['shares_on_sale'] ?> </td>
                                        <td> ksh <?= $share['total'] ?> </td>
                                        <?php if($share['is_verified'] == '1') : ?>
                                            <td><span class="badge badge-success" style="border-radius: 50%; width: 30px; height: 30px; display: grid; place-items: center"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></td>
                                        <?php elseif($share['is_verified'] == '0') : ?>
                                            <td><span class="badge badge-warning" style="border-radius: 50%; width: 30px; height: 30px; display: grid; place-items: center"><i class="mdi mdi-close-circle-outline"></i></span></td>
                                        <?php elseif($share['is_verified'] == '2') : ?>
                                            <td><span class="badge badge-danger" style="border-radius: 50%; width: 30px; height: 30px; display: grid; place-items: center"><i class="mdi mdi-clock-outline"></i></span></td>
                                        <?php elseif($share['is_verified'] == '3') : ?>
                                            <td><span class="badge badge-success">sold</span></td>
                                        <?php endif; ?>

                                        <td> <?= date('Y-m-d', strtotime($share['created_at'])) ?> </td>
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

