<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Approve New Members
        </h3>
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
                                <th> Email </th>
                                <th> ID Number </th>
                                <th> Sacco </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($newMembers) && !empty($newMembers)) : ?>
                            <?php foreach ($newMembers as $newMember) : ?>
                                <tr>
                                    <td> <?= $newMember['fname'] . ' ' . $newMember['lname']; ?> </td>
                                    <td> <?= $newMember['phone']; ?> </td>
                                    <td> <?= $newMember['email']; ?> </td>
                                    <td> <?= $newMember['id_number']; ?> </td>
                                    <td> <?= $newMember['name']; ?> </td>
                                    <?php if($newMember['is_approved'] == 0) : ?>
                                        <td> <a href="<?= 'approve-member-request/'.$newMember['membership_id'] ?>" class="badge badge-gradient-warning" style="text-decoration: none;">Pending</a></td>
                                    <?php elseif($newMember['is_approved'] == 1) : ?>
                                        <td><label class="badge badge-gradient-success">Approved</label></td>
                                    <?php endif; ?>
                                    <td>
                                        <a href="<?=  'delete-member-request/'. $newMember['membership_id'] ; ?>">
                                            <i class="mdi mdi-close" style="background-color: red; padding: 2px; border-radius: 50%;"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No new members requests to join your sacco at this moment.</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!--                        the end of the update user shares page-->
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

