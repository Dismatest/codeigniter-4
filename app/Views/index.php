<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>


<!-- the start of the body section -->
    <div class="load"></div>
<div class="container">
    <div class="row mt-5">
    <form method = "post" action = "" id="search-form">
        <div class="col-md-12 d-flex">



            <select class="explore-select" id="search-by-sacco" name="searchOne">
                <option value="all">All Share Capital</option>
                <?php if(isset($allSacco)):?>
                    <?php foreach($allSacco as $sacco):?>
                        <option value="<?= $sacco['sacco_id']?>"><?= $sacco['name']?></option>
                    <?php endforeach;?>
                <?php endif;?>
            </select>
            <input type="text" id="search-by-value" name="searchTwo" placeholder="search by price value"/>
            <button type="submit" class="explore-search">Search</button>

        </div>
    </form>
    </div>
</div>


<div class="container">
<div class="row mt-5">
    <div class="col-md-12 d-flex justify-content-between header-two-content">

        <div class="d-flex header-content-3">
            <h6 class="shares-heading" id="shares-heading1">Found: <span class="shares-heading-inner" id="results-found"></span> shares</h6>
            <h6 class="shares-heading ps-2">Market Status: <span class="shares-heading-inner" style="color: #1bcfb4;">Online</span></h6>
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