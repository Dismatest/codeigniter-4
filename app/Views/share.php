<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

    <div class="load"></div>
<div class="container">
    <div class="row" style="margin-bottom: 1.3em; margin-top: 2.0em;">
        <div class="col-md-7">
            <div class="border-col responsive-margin-top">
                <div class="shares-desc-div">
                    <div class="shares-description-sacco-title">
                        <h4 class="sacco-performance-title"><?= $share['name'] ?> Sacco Limited.</h4>
                    </div>
                <div class="shares-user-info">
                    <div class="d-flex justify-content-between share-user-fname-description">
                        <h5 class="shares-seller">Seller Name: <?= ucfirst($share['fname']) .' '. ucfirst($share['lname'])?></h5>
                        <h4 class="shares-seller">Shares On Sale: <span class="list-shares-sub-title"><?= $share['shares_on_sale'] ?></span></h4>
                    </div>
                    <div class="price-per-share d-flex justify-content-between">
                        <p class="percentage-increase">Price Per Share: ksh <?= $share['cost_per_share']?></p>
                        <span class="total-amount-to-pay">Total Shares Value: ksh <?= $share['total']?></span>
                    </div>
                    <div class="">
                            <div class="d-flex">
                                <?php if($is_registered == true): ?>
                                    <a href="<?= $payment_link ?>" class="buy-button">Buy Now</a>
                                <?php elseif($is_registered == false) : ?>
                                    <div class="membership-info">
                                        <p>
                                            Hello <?= ucfirst(session()->get('fname')) ?>, we have verified that you are not a member of <?= $share['name'] ?> sacco. Kindly
                                            submit your registration details in the form bellow in order to become a member of the sacco, after then you should be able
                                            to make your purchase. Thank you.
                                        </p>
                                    </div>

                                <?php endif; ?>
                            </div>
                    </div>
                </div>
                </div>

            </div>
        </div> 

       <div class="col-md-5">
            <div class="border-coll d-flex justify-content-between responsive-margin">
                
                <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h6 class="accordion-header" id="headingOne">
                    <button class="accordion-button" id="accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Important Safety Tips
                    </button>
                    </h6>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <div class="safety-tips">
                            <ul class="tips">
                                <li>You can not negotiate the price per share</li>
                                <li>You may receive the money within 24hr</li>
                                <li>Make sure you register with the sacco to buy</li>
                                <li>The sacco will register you and issue a personal number</li>
                                <li>Only the M-pesa payment is available now</li>
                            </ul>
                        </div>

                    </div>
                    </div>
                </div>
                </div>
                
                <div class="shares-save">
                    <span class="share-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-regular fa-share-from-square" style="padding: 4px;"></i></span>
                    <span class="save-button"><a href="#"><i class="fa-regular fa-bookmark" style="padding: 4px;"></i></span></a>
                </div>
            </div>
        </div>

        <?php if($is_registered == false): ?>
            <div class="row">
                <div class="col-md-7">
                    <div class="membership-title">
                        <h5>Membership Registration Form</h5>
                    </div>
                    <main>
                        <div class="stepper">
                            <div class="step--1 step-active">Step 1</div>
                            <div class="step--2">Step 2</div>
                            <div class="step--3">Step 3</div>
                            <div class="step--4">Finish</div>
                        </div>
                        <form class="form form-active">
                            <div class="form--header-container">
                                <h1 class="form--header-title">
                                    Personal Info
                                </h1>
                            </div>
                            <input type="text" class="stepper-input-fields" placeholder="fname" >
                            <input type="text" class="stepper-input-fields" placeholder="Lname" >
                            <button class="form__btn" id="btn-1">Next</button>
                        </form>
                        <form class="form">
                            <div class="form--header-container">
                                <h1 class="form--header-title">
                                    Personal Info
                                </h1>
                            </div>

                            <input type="text"class="stepper-input-fields"  placeholder="Phone" >
                            <input type="text" class="stepper-input-fields" placeholder="Email" >
                            <button class="form__btn" id="btn-2-prev">Previous</button>
                            <button class="form__btn" id="btn-2-next">Next</button>
                        </form>
                        <form class="form">
                            <div class="form--header-container">
                                <h1 class="form--header-title">
                                    Personal Info
                                </h1>
                            </div>
                            <input type="text" class="stepper-input-fields" placeholder="ID" >
                            <input type="text" class="stepper-input-fields" placeholder="Sacco" >
                            <button class="form__btn" id="btn-3">Submit</button>
                        </form>
                        <div class="form--message"></div>
                    </main>
                </div>
            </div>
        <?php endif; ?>

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