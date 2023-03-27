<div class="content-wrapper">
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
                                <td> Sacco </td>
                                <td> ID Number </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($allMembers) && !empty($allMembers)): ?>
                            <?php foreach ($allMembers as $member): ?>
                                <tr>
                                    <td><?= $member['fname'] .' '. $member['lname'] ?></td>
                                    <td><?= $member['phone'] ?></td>
                                    <td><?= $member['email'] ?></td>
                                    <td><?= $member['name'] ?></td>
                                    <td><?= $member['id_number'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="9" class="text-center">No members found</td>
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

