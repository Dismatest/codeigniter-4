<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container">
    <div class="row mt-4 mb-5">
        <div class="col-md-7">
            <div class="border-col">
                <div class="shares-desc-div">
                <div class="shares-user-info">
                    <div class="d-flex justify-content-between">
                        <h5 class="shares-seller"><?= ucfirst($share['fname']) .' '. ucfirst($share['lname'])?></h5>
                        <h4 class="list-shares-sub">Selling <span class="list-shares-sub-title"><?= $share['shares_amount'] ?></span> shares</h4>
                    </div>
                    <div class="price-per-share">
                        <h4 class="sacco-performance-title">Sacco: <?= $share['sacco'] ?></h4>
                        <p class="percentage-increase">Sacco Price: ksh <?= $share['cost']?></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="desc-location">Head Office: Nairobi, Kenya</p>
                        <span class="total-amount-to-pay">Total Amount: ksh <?= $share['total']?></span>
                    </div>

                    <div class="">

                            <label class="shares-on-sale-label">Shares on Sale</label>
                            <div class="d-flex justify-content-between">
                                <span class="input-buy"><?= $share['shares_amount'] ?></span>
                                <?php if(isset($is_registered)): ?>
                                    <a href="<?= base_url().'/payment'?>" class="buy-button">Buy Now</a>
                                <?php else: ?>
                                    <a href="<?= base_url().'/share/'.$share['uuid'].'/sacco-membership'?>" class="buy-button"> Dont have account? Register to sacco <?= $share['sacco'] ?></a>
                                 <?php endif; ?>
                            </div>

                    </div>
                </div>
                </div>

            </div>
        </div> 

       <div class="col-md-5">
            <div class="border-coll d-flex justify-content-between">
                
                <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h6 class="accordion-header" id="headingOne">
                    <button class="accordion-button" id="accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Price Per Share
                    </button>
                    </h6>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="d-flex justify-content-between">
                            <div class="price-comparison">
                                <P>Sacco Price</P>
                                <span>ksh: <?= $share['cost']?></span>
                            </div>
                            <div class="price-comparison-two">
                                <P>Sellers Price</P>
                                <span>ksh: 3.0</span>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                
                <div class="shares-save">
                    <span class="share-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-regular fa-share-from-square"></i></span>
                    <span class="save-button"><a href="#"><i class="fa-regular fa-bookmark"></i></span></a>
                </div>
            </div>

            <div class="border-coll mt-2">
            <p class="text-center" id="safety-tips-para">Important safety tips</p>
            <div class="safety-tips">
                <ul class="tips">
                    <li>You can not negotiate the price per share</li>
                    <li>You may receive the money within 24hr</li>
                    <li>Make sure you register with the sacco to buy</li>
                    <li>The sacco will register you and issue a personal number</li>
                    <li>Please take precautions while trading</li>
                    <li>Only the M-pesa payment is available now</li>
                </ul>
            </div>
        </div>
        </div>
       

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content modal-bg-color">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Share with others</h5>
                    <button type="button" class="close-button" data-bs-dismiss="modal">close</button>
                </div>
                <div class="modal-body">
                    <span><i class="fa-regular fa-envelope"></i><a href="" class="p-3">Share via email</a></span>
                    <span><i class="fa-brands fa-facebook"></i><a href="" class="p-3">share via facebook</a></span>
                    <span><i class="fa-brands fa-whatsapp"></i><a href="" class="p-3">share via whatsapp</a></span>
                </div>
                </div>
            </div>
        </div>
        <!-- end of modal -->
    </div>
</div>

<?= $this->include('includes/footer.php'); ?>

<?= $this->endSection();?>