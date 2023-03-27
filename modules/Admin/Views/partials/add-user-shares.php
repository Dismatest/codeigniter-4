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
                <h4>Please, add shares for the users under your category</h4>
                <form class="pt-3" method="post" action="">
                    <?= csrf_field()?>
                    <div class="form-group">
                        <label for="selectInput" class="form-label">Select Customer Full Name</label>
                        <select class="form-select form-control form-control-lg" id="selectInput" name="selectCustomerName">
                            <option value="">-- Select member --</option>
                            <?php if(!empty($users)): ?>
                                <?php foreach($users as $user): ?>
                                    <option value="<?= $user['user_id'] ?>"><?= ucfirst($user['fname']) . ' ' . ucfirst($user['lname']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectInput" class="form-label">Sacco Name</label>
                        <input type="text" class="form-control form-control-lg" placeholder="Last Name" name="sacco" value="<?= $sacco ?>">
                        <?php if(isset($validation)) : ?>
                            <?php if($validation->hasError('sacco')) :?>
                                <span class="text-danger text-sm"><?= $validation->getError('sacco') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
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

                    <div class="mt-3">
                        <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SUBMIT</button>
                    </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
