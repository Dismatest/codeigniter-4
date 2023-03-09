<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>


<!-- the start of the body section -->
    <div class="load"></div>
<div class="container">
    <div class="row mt-5">
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
        <div class="flex-wrap m-2">
            <div class="input-group">
                <input type="submit" value="show shares" class="btn btn-success">
            </div>
        </div>
        </div>
    </form>
    </div>
</div>
<div class="container">
<div class="row mt-5">
    <div class="col-md-12 d-flex justify-content-between justify-content-center">
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

<?= $this->include('list_shares.php'); ?>
<!-- the end of the body section -->
<?= $this->include('includes/footer.php'); ?>

<?= $this->endSection();?>