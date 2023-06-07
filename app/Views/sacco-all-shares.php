<?= $this->extend("client_base/base.php"); ?>
<?= $this->section('content'); ?>
<?= $this->include('includes/navbar.php'); ?>


    <div class="load"></div>
    <div class="sacco-shares-image-container">
        <div class="sacco-logo-image">
            <?php if(isset($sacco_name) && !empty($sacco_name)): ?>
                <?php foreach($sacco_name as $name): ?>
                <?php if($name['logo'] != null): ?>
                    <img src="<?= base_url() . '/uploads/sacco-logo/' . $name['logo'] ?>" class="img-thumbnail" alt="">
                <?php else: ?>
                    <img src="<?= base_url() . '/assets/images/image.PNG' ?>" class="img-thumbnail" alt="">
                <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <span><i class="fas fa-circle-check"></i></span>
            <?php if (isset($sacco_name)): ?>
                <?php foreach ($sacco_name as $name): ?>
                    <h5><?= $name['name'] ?></h5>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="accordion sacco-shares-accordion" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-mdb-toggle="collapse"
                                data-mdb-target="#flush-collapseOne"
                                aria-expanded="false"
                                aria-controls="flush-collapseOne"
                            >
                                <?php if (isset($sacco_name)): ?>
                                    <?php foreach ($sacco_name as $name): ?>
                                        About <?= $name['name'] ?>
                                    <?php endforeach; ?>
                                <?php endif ?>
                            </button>
                        </h2>
                        <div
                            id="flush-collapseOne"
                            class="accordion-collapse collapse"
                            aria-labelledby="flush-headingOne"
                            data-mdb-parent="#accordionFlushExample"
                        >
                            <div class="accordion-body">
                                <h5>Company Information</h5>
                                <div class="sacco-information-accordion">
                                    <div class="accordion-sacco-website">
                                        <p>Website</p>
                                        <?php if (isset($sacco_name) && !empty($sacco_name)): ?>
                                            <?php foreach ($sacco_name as $name): ?>
                                                <span><?= $name['website'] ?></span>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span>Not Available</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="accordion-sacco-head-quartor">
                                        <p>Headquator</p>
                                        <?php if (isset($sacco_name) && !empty($sacco_name)): ?>
                                            <?php foreach ($sacco_name as $name): ?>
                                                <span><?= $name['location'] ?></span>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span>Not Available</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <hr class="sacco-shares-hr">
    <div class="container">
        <div class="row" style="margin-bottom: 1.3em;">
            <div class="col-md-8" id="search-position-left">


                <div class="row">
                    <?php if (isset($shares) && !empty($shares)) : ?>
                        <?php foreach ($shares as $share) : ?>
                            <div class="col-md-4 col-6 list-shares-shares">
                                <div class="card customize-card">
                                    <div class="card-body">
                                        <div class="sacco-image">
                                            <?php if (!empty($share['logo'])) : ?>
                                            <img src="<?= base_url() . '/uploads/sacco-logo/' . $share['logo'] ?>"
                                                 alt="sacco image" class="image-tag shadow-2-strong">
                                            <?php else: ?>
                                                <img src="<?= base_url() . '/assets/images/logo.PNG' ?>"
                                                     alt="sacco image" class="image-tag shadow-2-strong">
                                            <?php endif; ?>
                                            <div class="shares-container-wrapper pl-2">
                                                <h5><?= $share['name'] ?></h5>
                                                <span><?= $share['shares_on_sale'] . ' ' . 'shares @ ksh' . ' ' . $share['total'] ?></span>
                                                <a href="<?= base_url() . '/share/' . $share['uuid'] ?>" type="button"
                                                   class="btn btn-secondary list-share-sell-button">Buy Shares</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="list-group list-group-light">
                            <span class="list-group-item list-group-item-action px-3 border-0 rounded-3 mb-2 list-group-item-success">No shares to display yet!</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?= $this->include('includes/search.php'); ?>
        </div>
    </div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>

<?= $this->endSection(); ?>