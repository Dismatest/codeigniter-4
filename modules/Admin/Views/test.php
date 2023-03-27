<!--the remaining content that will be hidden when feching the user informtion-->

<div style="display: none">
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

