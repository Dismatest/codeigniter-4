<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

    <div class="load"></div>
<nav class="navbar navbar-light bg-light">
  <div class="container">
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <img
          src="<?= base_url().'/assets/images/logo.png' ?>"
          height="15"
          alt="MDB Logo"
          loading="lazy"
        />
      </a>
  </div>
</nav>

<div class="container">
    <div class="borders">
        <div class="payment-icon">
            <span><i class="fa-solid fa-shop-lock"></i></span>
            <h6 class="payment-heading">Secure Checkout Payment</h6>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Total amount to pay
            </div>
            <div id="card-content">
                <h6>Total</h6>
                <p>Ksh: <?= $total ?></p>
            </div>
        </div>
        <div class="select-payment-method">
            <h6 class="select-payment">The Default Mobile Payment</h6>
            <div class="payment-buttons">
                <span><i class="fa-solid fa-mobile"></i></span>
                <p class="payment-desc">Mobile payment</p>
            </div>
        </div>
        <div class="user-input-details">
            <div class="phone-details">
                <h6 class="select-service-provider">Phone number</h6>
                <div class="phone-input">
                    <form action="" method="post">
                        <select class="user-select" name="phone-code">
                            <option value="+254">+254</option>
                            <option value="+1">+1</option>
                            <option value="+255">+255</option>
                        </select>
                        <input type="tel" id="phone" pattern="^7\d{8}$" name="phone" value="<?= $phone ?>">
                </div>
            </div>
            <h6 class="services">Your service provider</h6>
            <div class="checkbox-container">
                <input type="checkbox" id="checkbox-1" name="mpesa-check-box">
                <img class="saf-img" src="data:image/jpeg;base64,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" alt="">
                <?php if(isset($errors)): ?>
                    <div class="container">
                        <div class="text-danger text-center" role="alert" style="font-weight: 300; font-size: 12px;">
                            <?= $errors ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="footer-button">
            <a href="<?= base_url().'/my_bids'?>" class="footer-link">Cancel</a>
            <button type="submit" class="footer-pay-button"><span><i class="fa-solid fa-lock"></i></span> Pay Now</button>
        </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>