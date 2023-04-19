<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>


<!-- the start of the body section -->
    <div class="load"></div>
<div class="container">
    <div class="row mt-5">
    <form method = "post" action = "" id="search-form">
        <div class="col-md-12 d-flex">

            <div class="form-outline flex-wrap m-2">
                <i class="fas fa-magnifying-glass trailing"></i>
                <input type="text" id="search-by-sacco" name="searchOne" class="form-control form-control-lg form-icon-trailing"/>
                <label class="form-label" for="form1" >Search by sacco name</label>
            </div>

            <div class="form-outline flex-wrap m-2">
                <i class="fas fa-magnifying-glass trailing"></i>
                <input type="text" id="search-by-value" name="searchTwo" class="form-control form-control-lg form-icon-trailing"/>
                <label class="form-label" for="form1" >Search by share value</label>
            </div>

        <div class="flex-wrap m-2">
            <div class="input-group">
                <button type="submit" class="btn btn-secondary p-3" style="background: rgb(214, 178, 214); color: white;">Search</button>
            </div>
        </div>
        </div>
    </form>
    </div>
</div>


<div class="container">
<div class="row mt-5">
    <div class="col-md-12 d-flex justify-content-between header-two-content">

        <div class="d-flex header-content-3">
            <h6 class="shares-heading" id="shares-heading1">Found: <span class="shares-heading-inner" id="results-found"></span> shares</h6>
            <h6 class="shares-heading ps-2">Market Status: <span class="shares-heading-inner" style="color: green;">Online</span></h6>
        </div>
        <div class="header-content-3-select">
            <span style="font-weight: 500; font-size: 14px; padding-right: 15px;">Sort By:</span>
            <select class="home-select" id="sort" name="sort">
                <option value="newest">Newest</option>
                <option value="oldest">Oldest</option>
            </select>

        </div>
    </div>
    </div>
</div>

<?= $this->include('list_shares.php'); ?>
<!-- the end of the body section -->
<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>

<?= $this->endSection();?>