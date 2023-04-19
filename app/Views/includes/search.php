<div class="col-md-4 sm-scree-disable" id="search-main-container">
    <div class="border-coll">

        <h6 style="text-align: center; padding-bottom: 15px;">Search Shares here</h6>

        <form action="" method="post">
            <div class="custom-select-search">
                <input type="search" class="select-input" placeholder="Search by sacco name" name="sacco_id" id="sell-shares-input">
                <ul class="select-options">
                    <?php if(!empty($saccos)): ?>
                        <?php foreach ($saccos as $sacco): ?>
                            <li data-value="<?= $sacco['sacco_id'] ?>"><?= $sacco['name'] ?></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="verify-input-2">
                <input type="search" name="member_number" placeholder="Search by share capital" id="memberNumber">
            </div>

            <div class="verify-input-2">
                <input type="search" name="member_number" placeholder="Search by price value of shares" id="memberNumber">
            </div>


            <div class="d-flex justify-content-center">
                <input type="submit" value="Save filters" class="verify-input-button" id="sell-now-btn">
            </div>
        </form>
    </div>
</div>