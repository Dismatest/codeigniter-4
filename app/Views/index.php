<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>


<?= $this->include('includes/navbar.php'); ?>

<!-- the start of the body section -->
<div class="container pt-4">
    <div class="row">
    <form method = "post" action = "">
        <div class="col-md-12 d-flex">
        <div class="input-group flex-wrap m-2">
            <span class="input-group-text" id="addon-wrapping">
                <svg xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z"/></svg>
            </span>
            <input type="text" class="form-control" placeholder="Search by shares amount" aria-label="Shares" aria-describedby="addon-wrapping" />
        </div>
        <div class="input-group flex-rap m-2">
            <span class="input-group-text" id="addon-wrapping">
                <svg xmlns="http://www.w3.org/2000/svg"height="18" viewBox="0 0 384 512"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 256c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg>
            </span>
            <input type="text" class="form-control" placeholder="County or town" aria-label="Username" aria-describedby="addon-wrapping" />
        </div>
        <div class="input-group flex-wrap m-2">
            <input type="submit" value="show shares" class="btn btn-success">
        </div>
        <div class="flex-wrap m-2">
            <div class="clear-button">
            <svg xmlns="http://www.w3.org/2000/svg" id="clear-button-svg-icon" viewBox="0 0 640 512"><path d="M627.6 57.3c14-10.9 16.5-31 5.6-44.9s-31-16.5-44.9-5.6l-144 112-72 56-8.7 6.8-30.8-39.4c-3.7-4.8-9.8-7-15.8-5.8s-10.7 5.7-12.3 11.5l-12.5 46.3L371.1 295l48-.9c6.1-.1 11.5-3.7 14.1-9.1s1.9-11.9-1.8-16.7L403 231.9l8.6-6.7 72-56 144-112zM16.7 507.7c37.4 2.8 196.8 12 252.3-31.4c57.7-45.1 76.8-161.5 76.8-161.5L267.1 213.9s-117.6-9.6-175.3 35.5C69 267.1 50.5 304.1 36.3 344c-2.4 6.7 4.7 12.8 11 9.4L86.2 333c4.1-2.2 9.2-1.1 12 2.6s2.7 8.8-.4 12.3L24.4 430.4C13.2 442.9 5.5 458.1 2.4 474.5c-.9 4.8-1.6 8.9-2.2 12.1c-.9 5 .5 10.1 3.6 14.1s7.7 6.6 12.8 7z"/></svg>
            </div>
        </div>
        </div>
    </form>
    </div>
</div>
<div class="container">
<div class="row mt-2">
    <div class="col-md-12 d-flex justify-content-between">
        <div class="d-flex">
            <h6 class="shares-heading">Found: <span class="shares-heading-inner">255 </span>shares</h6>
            <h6 class="shares-heading ps-2">Market Status: <span class="shares-heading-inner" style="color: green;">Online</span></h6>
        </div>
        <div>
            <select>
                <option value="newest">Newest</option>
                <option value="oldest">Oldest</option>
            </select>

        </div>        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-4 mb-5">

        <div class="col-md-12">
            <?php if(!empty($shares)): ?>
          <?php foreach ($shares as $share) :?>
            <a href="<?= base_url().'/share/'.$share['uuid'] ?>" style="text-decoration: none;">
            <div class="list-shares mb-3">
                <div class="sacco">
                    <h5 class="shares-seller"><?= ucfirst($share['fname']) .' '. ucfirst($share['lname'])?></h5>
                    <p class="shares-seller"><span>Sacco:</span> <?= ucfirst($share['sacco']) ?></p>
                </div>
                <div>
                    <h4 class="list-shares-sub">Selling <span class="list-shares-sub-title"><?= $share['shares_amount'] ?></span> shares</h4>
                    <p class="location">Nairobi, Kenya</p>
                </div>
                <div class="user-info">
                    <span class="date-posted">
                        Posted

                            <?= $time ?>
                    </span>
                    <?php if ($share['is_verified'] == 1) :?>
                        <h6 class="user-info-account">Account verification <span class="fa-icon"><svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 0 512 512"><path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg></span></h6>
                    <?php elseif ($share['is_verified'] == 0):?>
                        <h6 class="user-info-account-not-very">Account verification <span class="fa-icon-not-very"><i class="fa-solid fa-circle-xmark fa-icon-not-very"></i></span></h6>
                    <?php endif;?>
                </div>
            </div>
            </a>
          <?php endforeach;?>
            <?php else:?>
                <h6 class="text-center">No shares found</h6>
          <?php endif;?>

            <div class="pt-3 pagination">
                <h6><?= $pager->links('default', 'full-pagination') ?></h6>
            </div>
        </div>
    </div>
</div>
<!-- the end of the body section -->
<?= $this->include('includes/footer.php'); ?>

<?= $this->endSection();?>