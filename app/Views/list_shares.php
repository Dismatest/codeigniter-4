<div class="container">

    <div class="row pt-5 pb-5">
        <?php if(!empty($shares)): ?>
        <?php foreach ($shares as $share) :?>
        <div class="col-md-3">
            <div class="card customize-card">
                <div class="ribbon"><span>NEW</span></div>
                <div class="card-body">
                    <a href="<?= base_url().'/share/'.$share['uuid'] ?>">
                        <div class="sacco-image">
                            <img src="<?= 'assets/images/image.png'?>" alt="" class="image-tag" style="object-fit: cover;">
                            <span class="image-subtitle">HS</span>
                        </div>
                        <div class="sacco-full-name">
                            <h5><?= $share['name'] ?> sacco ltd.</h5>
                        </div>
                        <div class="shares-container-wrapper">
                            <div class="shares-container-wrapper-content1">
                                <span class="shares-price-description">Shares</span>
                                <span class="shares-price-value"><?= $share['shares_on_sale'] ?></span>
                            </div>

                            <div class="shares-container-wrapper-content2">
                                <span class="shares-price-description">Value</span>
                                <span class="shares-price-value">ksh <?= $share['total'] ?></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
            <?php endforeach;?>
        <?php else:?>
            <h6 class="text-center">No shares found</h6>
        <?php endif;?>
    </div>

    <div class="pt-3 pagination">
        <h6><?= $pager->links('default', 'full-pagination') ?></h6>
    </div>

</div>