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
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" class="form-control" placeholder="Search by Sacco name" aria-label="Shares" aria-describedby="addon-wrapping" />
        </div>
        <div class="input-group flex-rap m-2">
            <span class="input-group-text" id="addon-wrapping">
                <i class="fa-solid fa-dollar-sign"></i>
            </span>
            <input type="text" class="form-control" placeholder="Search by amount of shares" aria-label="Username" aria-describedby="addon-wrapping" />
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