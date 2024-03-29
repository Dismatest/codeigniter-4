<div class="col-md-5 responsive-margin-container">
    <div class="main-saved-container">
        <div class="margin-content-section">
            <div class="settings-section">
                <a href="<?= base_url('update-profile')?>"><span><i class="fa-solid fa-pen-to-square"></i></span></a>
                <a href="<?= base_url('saved/settings') ?>">
                    Account Settings
                    <span><i class="fa-solid fa-gear"></i></span>
                </a>
            </div>
            <div class="profile-main-section">
                <?php if(!empty($userData->profile)): ?>
                <img src="<?= base_url().'/uploads/'.$userData->profile ?>" alt="profile" >
                <?php else: ?>
                <img src="https://th.bing.com/th/id/R.eb2b82c57dda81c9aa7546a27b8399c1?rik=qZimBfcY7PKHIA&pid=ImgRaw&r=0" alt="profile" >
                <?php endif; ?>
            </div>
            <div class="display-user-name-phone">
                    <?php if(!empty($userData->fname) && !empty($userData->lname)): ?>
                    <h5><?= ucfirst($userData->fname); ?> <?= ucfirst($userData->lname); ?></h5>
                    <?php endif; ?>
                    <?php if(!empty($userData->phone)) :?>
                    <span><?= $userData->phone; ?></span>
                    <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="main-saved-container mt-3">

        <div class="help-related-sections">
            <a href="<?= base_url('saved/need_help') ?>" style="display: flex; align-items: baseline;">
                <span style="display: flex; align-items: flex-end; height: 2em;"><i class="fa-solid fa-circle-info"></i></span>
                <h5 style="height: 1em; display: inline-block">Need Help?</h5>
            </a>
        </div>
        <hr>
        <div class="help-related-sections">
            <a href="<?= base_url().'/saved' ?>">
                <span><i class="fa-sharp fa-regular fa-bookmark"></i></span>
                <h5 style="height: 1em; display: inline-block">Saved</h5>
            </a>
        </div>
        <hr>
        <div class="help-related-sections">
            <a href="<?= base_url('saved/your_active_shares')?>">
                <span><i class="fa-solid fa-briefcase"></i></span>
                <h5>Active Shares</h5>
            </a>
        </div>
        <hr>
        <div class="help-related-sections">
            <a href="<?= base_url('saved/your_share_history') ?>">
                <span><i class="fa-solid fa-signal"></i></span>
                <h5>Shares History</h5>
            </a>
        </div>

    </div>
</div>