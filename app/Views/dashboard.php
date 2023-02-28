<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>
<script>
    setTimeout(function (){
        $('#hideTempMessage').hide();
    }, 4000)
</script>

<?= $this->section('user_names'); ?>
<?php if(isset($userData->fname)):; ?>
    <?= $userData->fname; ?>

    <?= $userData->lname; ?>
<?php endif; ?>

<?= $this->endSection() ;?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container mt-4 mb-4" id="main-section-container">
   <div class="row">
      <div class="col col-md-8">
          <?php if(session()->getTempdata('success')): ?>
              <div class="alert alert-success" id="hideTempMessage">
                  <?= session()->getTempdata('success') ?>
              </div>
          <?php else: ?>
            <?php if(session()->getTempdata('fail')): ?>
                <div class="alert alert-danger" id="hideTempMessage">
                    <?= session()->getTempdata('fail') ?>
                </div>
          <?php endif; ?>
          <?php endif; ?>
         <div id="col-content-section" style="height: 11rem;">
            <div class="profile-container">
               <div class="user-profile-info">

                   <?php if(!empty($userData->profile)): ; ?>
                   <img src="<?= base_url().'/uploads/'.$userData->profile ?>" class="user-profile-avatar rounded-circle">
                   <?php else: ;?>
                       <span><i class="fa-solid fa-user user-profile-avatar"></i></span>
                   <?php endif; ?>
                   <?php if(!empty($userData->fname) && !empty($userData->lname)): ?>
                       <h6 class="user-profile-name"><?= strtoupper($userData->fname); ?> <?= strtoupper($userData->lname); ?></h6>
                       <a href="<?= base_url('update-profile')?>"><span><i class="fa-solid fa-pen-to-square user-profile-edit"></i></a></span>
                   <?php endif; ?>

               </div>
               <div class="user-info-details">
                   <?php if(!empty($userData)) :;?>
                       <h6>phone: <?= $userData->phone; ?></h6>
                       <h6>email: <?= $userData->email; ?></h6>
                       <h6>sacco: Stima</h6>
                       <h6>member number: zyz</h6>
                   <?php endif; ?>
               </div>
            </div>
         </div>

         <div id="col-content-section" class="mt-4">
            <div class="">
               <div class="profile-container-content">
                  <h6 class="selling-history">Shares History</h6>
               </div>
               <div class="dashboardDataTable">
                  <div id="example"></div>
               <table id="dashboardDataTable" class="table table-responsive">
               <thead>
                     <tr>
                        <th>Name</th>
                        <th>Shares</th>
                        <th>Cost per share</th>
                        <th>Total</th>
                        <th>Sacco</th>
                     </tr>
               </thead>
               <tbody>
                     <tr>
                        <td>Tiger Nixon</td>
                        <td>200</td>
                        <td>3</td>
                        <td>600</td>
                        <td>Hisa</td>
                     </tr>
               </tbody>
               </table>
               </div>
            </div>
         </div>

      </div>
      <div class="col col-md-4">
         <div id="col-content-section">
            <div class="dashboard-heading">
               <h6>Shares Information</h6>
            </div>
            <div class="dashboard-shares-balance">
               <h6>Total: <span id="total-amount-of-shares">200</span></h6>
               <h6>Cost Per Share <span>ksh: 3.0</span></h6>
            </div>
            <div class="dashboard-sell">
               <button type="button" class="dashboard-sell-button" id="display-sell-now-btn">SELL</button>
            </div>
         </div>

          <div id="col-content-section-confirm-selling" class="mt-4" style="display: none;">
              <div class="confirm-shares-on-sale-heading">
                  <span>Please confirm the amount of shares you wish to sell.</span>
              </div>
              <div>
                  <form method="post" action="" class="submit-shares-for-sale-form">
                      <label for="input-1" class="shares-for-sale-input-label">Amount of Shares on Sale: </label>
                      <input type="text" id="shares-for-sale-input-1" class="shares-on-sales-input-field" value="100" name="shares">
                      <div class="shares-on-sale-cost-price">
                          <span>Cost: ksh<input type="text" id="shares-for-sale-input-2" class="shares-for-sale-cost-per-share" value="3" name="price"></span>
                          <span>Total Amount: ksh<input type="text" id="shares-on-sale-total-amount" class="shares-for-sale-cost-per-share" value="" name="total"></span>
                      </div>
                      <button class="submit-shares-on-sale" id="sell-now-btn" type="submit">SELL NOW</button>
                  </form>
              </div>
          </div>

      </div>
   </div>
</div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->endSection(); ?>

