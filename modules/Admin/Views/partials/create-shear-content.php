<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <?php
                    if(!empty(session()->getFlashData('success'))){
                        ?>
                        <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
                        <?php
                    }else if(!empty(session()->getFlashData('fail'))){
                        ?>
                        <div class="alert alert-danger"><?= session()->getFlashData('fail') ?></div>
                        <?php
                    }
                    ?>

                    <h4>Create new share</h4>

                    <form class="pt-3" method="post" action="">
                        <?= csrf_field()?>
                        <div class="form-group">
                            <label for="selectInput" class="form-label">Sacco Name</label>
                            <select class="form-select form-control form-control-lg" id="selectInput" name="selectSaccoName">
                                <option value="">-- Select sacco --</option>
                                <?php if(!empty($sacco)): ?>
                                        <option value="<?= $sacco['sacco_id'] ?>"><?= ucfirst($sacco['name']) ?></option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="selectInput" class="form-label">Select Member Name</label>
                            <select class="form-select form-control form-control-lg" id="selectMemberName" name="selectMemberName">
                                <option value="">-- Select member --</option>
                                <?php if(!empty($users)): ?>
                                    <?php foreach($users as $user): ?>
                                        <option value="<?= $user['user_id'] ?>"><?= ucfirst($user['fname']) . ' ' . ucfirst($user['lname']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div id="display-share-form" style="display: none;">
                            <div class="form-group">
                                <label for="selectInput" class="form-label">Membership Number</label>
                                <input type="text" class="form-control form-control-lg" placeholder="Membership Number" name="membershipNumber" value="">
                                <?php if(isset($validation)) : ?>
                                    <?php if($validation->hasError('membershipNumber')) :?>
                                        <span class="text-danger text-sm"><?= $validation->getError('membershipNumber') ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="selectInput" class="form-label">Amount of Shares</label>
                                <input type="number" class="form-control form-control-lg" placeholder="Shares Amount" name="sharesAmount" value="">
                                <?php if(isset($validation)) : ?>
                                    <?php if($validation->hasError('sharesAmount')) :?>
                                        <span class="text-danger text-sm"><?= $validation->getError('sharesAmount') ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="selectInput" class="form-label">Cost Per Share</Your></label>
                                <input type="number" class="form-control form-control-lg" placeholder="Cost Per Share" name="cost" value="">
                                <?php if(isset($validation)) : ?>
                                    <?php if($validation->hasError('cost')) :?>
                                        <span class="text-danger text-sm"><?= $validation->getError('cost') ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="selectInput" class="form-label">Total</Your></label>
                                <input type="number" class="form-control form-control-lg" placeholder="Cost Per Share" name="total" value="">
                                <?php if(isset($validation)) : ?>
                                    <?php if($validation->hasError('total')) :?>
                                        <span class="text-danger text-sm"><?= $validation->getError('total') ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SUBMIT</button>
                            </div>
                        </div>

                </div>
                </form>

                </div>
            </div>
        </div>
    </div>

    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

