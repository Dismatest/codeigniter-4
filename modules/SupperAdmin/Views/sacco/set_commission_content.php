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
                    <h4>Set members commission
                    </h4>
                    <form class="pt-3" method="post" action="">
                        <?= csrf_field()?>
                        <div class="form-group">
                            <label for="selectInput" class="form-label">Set commission

                                <?php if(!empty($commissions)): ?>
                                    <?php foreach($commissions as $commission): ?>
                                        <span class="text-warning"> (<?= $commission['commission'] ?> %)</span>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                </Your></label>
                            <input type="text" class="form-control form-control-lg" name="commission" value="">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('commission')) :?>
                                    <span class="text-danger text-sm"><?= $validation->getError('commission') ?></span>
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
