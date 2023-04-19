
        <!-- Remove the PHP loop -->
<div class="row">
    <?php if(!empty($related_shares)) : ?>
        <?php foreach($related_shares as $share) : ?>
            <div class="col-md-4 col-6 list-shares-shares">
                <div class="card customize-card">
                    <div class="card-body">
                        <div class="sacco-image">
                            <img src="<?php echo base_url() .'/assets/images/image.PNG' ?>" alt="sacco image" class="image-tag shadow-2-strong">
                            <div class="shares-container-wrapper pl-2">
                                <h5><?= $share['name']?></h5>
                                <span><?= $share['shares_on_sale'] .' '.'shares @ ksh' .' '.$share['total'] ?></span>
                                <a href="<?= base_url().'/share/'.$share['uuid'] ?>" type="button" class="btn btn-secondary list-share-sell-button">Buy Shares</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
    <div class="list-group list-group-light">
        <span class="list-group-item list-group-item-action px-3 border-0 rounded-3 mb-2 list-group-item-success">No similar shares found yet!</span>
    </div>
    <?php endif; ?>
</div>

