<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>
<?= $this->include('includes/navbar.php'); ?>
    <script>
        setTimeout(function (){
            $('#hideTempMessage').addClass('move-out-flash');
            setTimeout(function (){
                $('#hideTempMessage').remove();
            }, 500);
        }, 5000);
    </script>
    <div class="load"></div>
<div class="container">
    <div class="row" style="margin-bottom: 1.3em; margin-top: 2.0em;">
        <div class="col-md-7">
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

                                    <a href="#" class="buy-button" id="display-sell-now-btn">BUY SHARES</a>
                            </div>
                    </div>
                </div>
                </div>

            </div>
        </div>

<!--start of the bid model-->
        <div id="id01" class="user-share-model">
            <div class="modal-content-user animate">
                <div class="imgContainer">
                    <span class="x-close-button" id="modal01-close" title="Close Modal"><i class="fa-solid fa-x close-font-icon"></i></span>
                </div>

                <div class="container1">
                    <label for="shares"><b class="shares-sell-heading text-warning"><i class="fas fa-circle-exclamation" style="padding-right: 5px;"></i>Please confirm if you are a member of <?= $share['name'] ?> sacco !</b></label>
                    <input type="hidden" class="customer-selling-button" name="bid" id="shares-for-sale-input-1" value="<?= $share['total']?>">
                    <div class="d-flex justify-content-between pt-5">
                        <button  class="confirm-sell-shares-btn" id="modal2Display">Yes, I am a member</button>
                        <a href="<?= base_url('share/'.$share['uuid'].'/request_membership'); ?>" class="confirm-sell-shares-btn2 text-center">NO, I am not a member</a>

                    </div>
                </div>
            </div>
        </div>


<!--        modal two-->

        <div id="id02" class="user-share-model">
            <form class="modal-content-user animate" action="<?= $share['uuid'].'/bid' ?>" method="post" id="form">
                <div class="imgContainer">
                    <span class="x-close-button" id="modal02-close" title="Close Modal"><i class="fa-solid fa-x close-font-icon"></i></span>
                </div>

                <div class="container1">
                    <label for="shares"><b class="shares-sell-heading">Place your bid | Make an offer (ksh)</b></label>
                    <div class="d-flex align-items-center justify-content-around offer-buttons">
                        <span>500</span>
                        <span>500</span>
                        <span>500</span>
                        <span>500</span>
                    </div>
                    <input type="text" class="customer-selling-button" name="bid" id="shares-for-sale-input-1" value="<?= $share['total']?>">
                    <button type="submit" class="confirm-sell-shares-btn3" id="sell-now-btn">SEND</button>
                </div>
            </form>
        </div>


<!-- end of the modal-->

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
                    <input type="hidden" value="<?= $share['uuid']?>" id="ajax-share-id" name="ajax-share-id">
                    <input type="hidden" value="<?= session()->get('user_id') ?>" id="ajax-user-id" name="ajax-user-id">
                    <span class="share-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-regular fa-share-from-square" style="padding: 4px;"></i></span>
                    <span class="save-button" id="save-share-button"><a href="#"><i class="fa-regular fa-bookmark" style="padding: 4px;"></i></span></a>
                </div>
            </div>
        </div>



        <!-- share posted share modal -->
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