<div class="container">

    <div class="row pt-5 pb-5">
        <?php if(!empty($shares)): ?>
            <?php foreach ($shares as $share) :?>
                <div class="col-md-3">
                    <div class="card customize-card">
                        <div class="ribbon"><span>NEW</span></div>
                        <div class="card-body">
                            <a href="<?= base_url().'/share/'.$share['uuid'] ?>">
                                <div class="sacco-image">
                                    <img src="<?= 'assets/images/image.png'?>" alt="" class="image-tag" style="object-fit: cover;">
                                    <span class="image-subtitle">HS</span>
                                </div>
                                <div class="sacco-full-name">
                                    <h5><?= $share['name'] ?> sacco ltd.</h5>
                                </div>
                                <div class="shares-container-wrapper">
                                    <div class="shares-container-wrapper-content1">
                                        <span class="shares-price-description">Shares</span>
                                        <span class="shares-price-value"><?= $share['shares_on_sale'] ?></span>
                                    </div>

                                    <div class="shares-container-wrapper-content2">
                                        <span class="shares-price-description">Value</span>
                                        <span class="shares-price-value">ksh <?= $share['total'] ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        <?php else:?>
            <h6 class="text-center">No shares found</h6>
        <?php endif;?>
    </div>

    <div class="pt-3 pagination">
        <h6><?= $pager->links('default', 'full-pagination') ?></h6>
    </div>

</div>



<!--share details-->


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
                                <?php if($is_approved == true): ?>
                                    <a href="#" class="buy-button" id="display-sell-now-btn" onclick="document.getElementById('id01').style.display='block'">Place a bid</a>
                                <?php elseif($is_approved == false) : ?>
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

        <!--start of the bid model-->
        <div id="id01" class="user-share-model">
            <form class="modal-content-user animate" action="<?= $share['uuid'].'/bid' ?>" method="post" id="form">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('id01').style.display='none'" class="x-close-button" title="Close Modal"><i class="fa-solid fa-x close-font-icon"></i></span>
                </div>

                <div class="container1">
                    <label for="shares"><b class="shares-sell-heading">Your Bid Amount (ksh)</b></label>
                    <input type="text" class="customer-selling-button" name="bid" id="shares-for-sale-input-1" value="<?= $share['total']?>">
                    <button type="submit" class="confirm-sell-shares-btn" id="sell-now-btn">Place a bid</button>
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

        <?php if($is_approved == false): ?>
            <div class="row">
                <div class="col-md-7">
                    <div class="membership-title">
                        <h5>Membership Registration Form</h5>
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
                    </div>
                    <main>
                        <div class="stepper">
                            <div class="step--1 step-active">Step 1</div>
                            <div class="step--2">Step 2</div>
                            <div class="step--3">Step 3</div>
                            <div class="step--4">Finish</div>
                        </div>
                        <form class="form form-active" method="post" action="">
                            <div class="form--header-container">
                                <h1 class="form--header-title">
                                    Personal Information
                                </h1>
                            </div>
                            <labe for="fname" class="d-flex justify-content-start" style="margin-left: 15px; font-weight: 500;">First Name</labe>
                            <input type="text" class="stepper-input-fields" value="<?= $user['fname'] ?>" name="fname">
                            <labe for="lname" class="d-flex justify-content-start" style="margin-left: 15px; font-weight: 500; padding-top: 5px;">Last Name</labe>
                            <input type="text" class="stepper-input-fields" value="<?= $user['lname'] ?>" name="lname">
                            <button class="form__btn" id="btn-1">Next</button>
                        </form>
                        <form class="form" method="post" action="">
                            <div class="form--header-container">
                                <h1 class="form--header-title">
                                    Personal Information
                                </h1>
                            </div>
                            <labe for="phone" class="d-flex justify-content-start" style="margin-left: 15px; font-weight: 500;">Phone Number</labe>
                            <input type="text"class="stepper-input-fields" value="<?= $user['phone'] ?>" name="phone">
                            <labe for="email" class="d-flex justify-content-start" style="margin-left: 15px; font-weight: 500; padding-top: 5px;">Email Address</labe>
                            <input type="text" class="stepper-input-fields" value="<?= $user['email'] ?>" name="email">
                            <button class="form__btn" id="btn-2-prev">Previous</button>
                            <button class="form__btn" id="btn-2-next">Next</button>
                        </form>
                        <form class="form" method="post" action="">
                            <div class="form--header-container">
                                <h1 class="form--header-title">
                                    Personal Information
                                </h1>
                            </div>
                            <labe for="sacco-name" class="d-flex justify-content-start" style="margin-left: 15px; font-weight: 500;">Sacco Name</labe>
                            <input type="text" class="stepper-input-fields" value="<?= $share['name'] ?>" name="sacco-name">
                            <labe for="identification" class="d-flex justify-content-start" style="margin-left: 15px; font-weight: 500; padding-top: 5px;">ID Number</labe>
                            <input type="text" class="stepper-input-fields" placeholder="ID" name="identification">
                            <button class="form__btn" id="btn-3">Submit</button>
                        </form>
                        <div class="form--message"></div>
                    </main>
                </div>
            </div>
        <?php endif; ?>

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


<div class="shares-description-sacco-title">
    <h4 class="sacco-performance-title"><?= $share['name'] ?> Sacco Limited.</h4>
</div>
<div class="shares-user-info">
    <div class="d-flex justify-content-between share-user-fname-description">
        <h5 class="shares-seller">Seller Membership Number: <?= $share['membership_number'] ?></h5>
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



<!--    the saved buttons were cut from the share description section-->
    <div class="col-md-4">
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
                <span class="save-button" id="save-share-button"><a href="#"><i class="fa-regular fa-bookmark" style="padding: 4px;"></i></span>
            </div>
        </div>
    </div>

<!--    end of the buttons share description-->

    <div class="share-description-container">
        <div class="share-description-share-details">
            <h6 class="sacco-name"><?= $share['name'] ?></h6>
            <p>Sellers Membership Number: <?= $share['membership_number'] ?></p>
            <div class="share-description-priceValue">
                <p>Shares: <?= $share['shares_on_sale'] ?></p>
                <p>Value: ksh: <?= $share['total']?></p>

                <div class="d-flex justify-content-end">2 days</div>
            </div>

        </div>

        <div>
            <span><i class="fas fa-ellipsis-vertical"></i></span>
            <span>New</span>
        </div>

    </div>


    <div class="swiper-slide">
        <div class="card card-hover-container">
            <img src="<?= base_url().'/assets/images/image.PNG'?>" class="card-img-top" alt="...">
            <div class="card-body">
                <a href="<?= base_url('sacco_name')?>" class="sacco-read-more" id="scroll-btn">View More <i class="fa-solid fa-arrow-right arrow-icon2"></i></a>
            </div>
        </div>
    </div>


<!--    select2 for the sacco admin-->

    <div class="form-group">
        <label for="selectInputName" class="form-label">Select Member Name</label>
        <select class="form-select form-control form-control-lg" id="selectInputName"
                name="selectMemberName">
            <option value=""></option>
        </select>
    </div>

<!--  -->

<!--    displaying the pdf form to the user-->

    <tbody>
    <?php if(!empty($bids)) : ?>
        <?php foreach ($bids as $bid): ?>
            <tr>
                <td>date</td>
                <td><?= $bid['name'] ?></td>
                <td>ksh. <?= $bid['total'] ?></td>
                <td>ksh. <?= $bid['bid_amount'] ?></td>
                <td class="action-links">
                    <a class="reject-link" href="<?= 'my_bids/reject/'.$bid['bid_id'] ?>">Reject</a>
                    <a class="accept-link" href="<?= 'my_bids/accept/'.$bid['bid_id'] ?>">Accept</a>
                </td>
            </tr>

        <?php endforeach; ?>
    <?php elseif(!empty($accepted_bids) || !empty($rejected_bids)): ?>
        <?php foreach ($accepted_bids as $accepted_bid): ?>
            <tr>
                <td><?= $accepted_bid['membership_number'] ?></td>
                <td>date</td>
                <td><?= ucfirst($accepted_bid['name']) ?></td>
                <td>ksh. <?= $accepted_bid['total'] ?></td>
                <td>ksh. <?= $accepted_bid['bid_amount'] ?></td>
                <?php if($accepted_bid['action'] == '1'): ?>
                    <td style="display: flex; justify-content: center; align-items: center">
                        <a href="<?= base_url('/payment/initiate_payment?share_id='.urlencode($accepted_bid['uuid']).'&total='.urlencode($accepted_bid['bid_amount'])) ?>" class="accept-link" id="payment-link">Buy Now</a>
                        <a class="reject-accept-delete" data-id="<?= $accepted_bid['share_on_sale_id'] ?>"><i class="fas fa-trash"></i></a>
                        <span id="error-message"></span>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        <?php foreach ($rejected_bids as $rejected_bid): ?>
            <tr>
                <td><?= $rejected_bid['membership_number'] ?></td>
                <td>date</td>
                <td><?= $rejected_bid['name'] ?></td>
                <td>ksh. <?= $rejected_bid['total'] ?></td>
                <td>ksh. <?= $rejected_bid['bid_amount'] ?></td>
                <?php if($rejected_bid['action'] == '2'): ?>
                    <td style="display: flex; justify-content: center; align-items: center;">
                        <button class="reject-link">Rejected</button>
                        <a class="accept-link" href="<?= 'share/'.$rejected_bid['uuid'] ?>">Bid Again</a>
                        <a class="reject-accept-delete" id="rejected-bid-delete" data-id="<?= $rejected_bid['share_on_sale_id'] ?>"><i class="fas fa-trash"></i></a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>


<!--    custom select field-->

    <div class="verify-input">
        <label for="verify">Select sacco*</label>
        <div class="custom-select">
            <input type="text" class="select-input" placeholder="Select sacco" name="sacco_id" id="sell-shares-input">
            <ul class="select-options">
                <?php if(!empty($saccos)): ?>
                    <?php foreach ($saccos as $sacco): ?>
                        <li data-value="<?= $sacco['sacco_id'] ?>"><?= $sacco['name'] ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>


    <div class="col-md-12">
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

        <div class="pt-5">

            <?php if(!empty($share_id)) : ?>
                <div class="membership-title text-center pb-3">
                    <a href="<?= base_url('share/'.$share_id)?>" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Go back to shares"><i class="fas fa-arrow-left back-icon"></i></a>
                    <h6>Membership Registration Form</h6>
                </div>
            <?php endif; ?>
            <main>
                <div class="stepper">
                    <div class="step--1 step-active">Step 1</div>
                    <div class="step--2">Step 2</div>
                    <div class="step--3">Step 3</div>
                    <div class="step--4">Finish</div>
                </div>
                <?php if (!empty($userData)): ?>
                    <form class="form form-active" method="post" action="">
                        <div class="form--header-container">
                            <h1 class="form--header-title">
                                Personal Information
                            </h1>
                        </div>

                        <div class="d-flex justify-content-center align-items-center information-main-wrapper">
                            <labe for="fname" class="d-flex justify-content-start" style="margin-right: 10px; font-weight: 500;">First Name</labe>
                            <input type="text" class="stepper-input-fields" value="<?= $userData->fname ?>">
                        </div>

                        <div class="d-flex justify-content-center align-items-center information-main-wrapper">
                            <labe for="lname" class="d-flex justify-content-start" style="margin-right: 10px; font-weight: 500;">Last Name</labe>
                            <input type="text" class="stepper-input-fields" value="<?= $userData->lname ?>">
                        </div>

                        <button class="form__btn" id="btn-1">Next</button>

                    </form>
                    <form class="form" method="post" action="">
                        <div class="form--header-container">
                            <h1 class="form--header-title">
                                Personal Information
                            </h1>
                        </div>
                        <div class="d-flex justify-content-center align-items-center information-main-wrapper">
                            <labe for="phone" class="d-flex justify-content-start" style="margin-right: 10px; font-weight: 500;">Phone Number</labe>
                            <input type="text"class="stepper-input-fields" value="<?= $userData->phone ?>">
                        </div>
                        <div class="d-flex justify-content-center align-items-center information-main-wrapper">
                            <labe for="email" class="d-flex justify-content-start" style="margin-right: 10px; font-weight: 500;">Email Address</labe>
                            <input type="text" class="stepper-input-fields" value="<?= $userData->email ?>">
                        </div>
                        <button class="form__btn" id="btn-2-prev">Previous</button>
                        <button class="form__btn" id="btn-2-next">Next</button>
                    </form>
                    <form class="form" method="post" action="">
                        <div class="form--header-container">
                            <h1 class="form--header-title">
                                Personal Information
                            </h1>
                        </div>
                        <div class="d-flex justify-content-center align-items-center information-main-wrapper">
                            <labe for="sacco-name" class="d-flex justify-content-start" style="margin-right: 10px; font-weight: 500;">Sacco Name</labe>
                            <div class="custom-select-input">
                                <input type="text" class="select-input-field" name="sacco_id" placeholder="Select sacco*">
                                <ul class="select-options-fields">
                                    <?php if(!empty($sacco)): ?>
                                        <?php foreach ($sacco as $sac): ?>
                                            <li data-value="<?= $sac['sacco_id'] ?>"><?= $sac['name'] ?></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center information-main-wrapper">
                            <labe for="identification" class="d-flex justify-content-start" style="margin-right: 10px; font-weight: 500;">ID Number</labe>
                            <input type="text" class="stepper-input-fields" name="identification" id="id_number" placeholder="ID">
                        </div>
                        <button class="form__btn" id="btn-3">Submit</button>
                    </form>
                <?php endif; ?>
                <div class="alert alert-warning" role="alert" id="warning-registration" style="display:none;">
                    <p id="warning-message-registration"></p>
                </div>
            </main>

        </div>

    </div>


<!--    welcome page-->

    <?= $this->extend("client_base/base.php"); ?>
    <?= $this->section('content'); ?>

    <?= $this->include('includes/navbar.php'); ?>

    <div class="load"></div>
    <div class="main-container">
        <div class="description-section">
            <div class="content-section">
                <h5>Welcome to the Sacco Hisa Shares Portal</h5>
                <p>The platform that allow you sell and buy shares from different sacco within kenya.
                </p>
                <div class="top-button">
                    <a href="<?= 'index' ?>">Buy Shares <i class="fa-solid fa-arrow-right arrow-icon2"></i></a>

                    <a href="<?= 'index' ?>">Sell Shares <i class="fa-solid fa-arrow-right arrow-icon2"></i></a>
                </div>

            </div>
        </div>
        <div class="container scroll-btn-main-container">
            <a href="#scroll-btn">
                <button type="button" class="welcome-scroll-btn">Scroll <i
                        class="fa-solid fa-arrow-down arrow-icon-down"></i></button>
            </a>
        </div>
    </div>
    <div class="moving-text-container">
        <div class="moving-text">

            <?php if (!empty($activeShares)) : ?>
                <?php foreach ($activeShares as $activeShare) : ?>
                    <span class="moving-text-name"><?= $activeShare['name'] ?> <i class="fa-solid fa-arrow-up moving-text-icon"></i></span>
                    <span class="moving-text-shares"><?= $activeShare['shares_on_sale'] ?></span>
                <?php endforeach; ?>
            <?php endif; ?>


        </div>
    </div>
    <div class="container">
        <div class="onboarded-sacco-container">
            <h5>Saccos actively selling share capital</h5>
        </div>

        <div class="slider-main-container pb-5">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper" id="swiper-wrapper">


                    <div class="swiper-wrapper sacco-shares-skeleton">

                        <div class="swiper-slide">
                            <div class="card" style="padding: 15px;">
                                <span class="placeholder col-12 btn " style="border-radius: 5px;"></span>
                                <div class="card-body">
                                    <span class="placeholder col-12 placeholder-lg" style="border-radius: 5px;"></span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="swiper-wrapper sacco-shares-skeleton">

                        <div class="swiper-slide">
                            <div class="card" style="padding: 15px;">
                                <span class="placeholder col-12 btn " style="border-radius: 5px;"></span>
                                <div class="card-body">
                                    <span class="placeholder col-12 placeholder-lg" style="border-radius: 5px;"></span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="card" style="padding: 15px;">
                                <span class="placeholder col-12 btn " style="border-radius: 5px;"></span>
                                <div class="card-body">
                                    <span class="placeholder col-12 placeholder-lg" style="border-radius: 5px;"></span>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>


    </div>

    <?= $this->include('includes/footer.php'); ?>
    <?= $this->include('includes/small-footer.php'); ?>

<?= $this->endSection(); ?>

    <div class="form-outline flex-wrap m-2">
        <i class="fas fa-magnifying-glass trailing"></i>
        <input type="text" id="search-by-sacco" name="searchOne" class="form-control form-control form-icon-trailing"/>
        <label class="form-label" for="form1" >Search by sacco name</label>
    </div>

    <div class="form-outline flex-wrap m-2">
        <i class="fas fa-magnifying-glass trailing"></i>
        <input type="text" id="search-by-value" name="searchTwo" class="form-control form-control form-icon-trailing"/>
        <label class="form-label" for="form1" >Search by share value</label>
    </div>

    <div class="flex-wrap m-2">
        <div class="input-group">
            <button type="submit" class="btn btn-secondary p-3 search-shares">Search</button>
        </div>
    </div>


<!--    search with input box -->


<!--    end of search-->
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

<!--    css-->



    <?php
    if(!empty(session()->getFlashData('success'))){
        ?>
        <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
        <?php
    }else if(!empty(session()->getFlashData('fail'))){
        ?>
        <div class="alert alert-danger"><?= session()->getFlashData('fail') ?></div>
        <?php
    }
    ?>
    <h4>Set members commission
    </h4>
    <form class="pt-3" method="post" action="">
        <?= csrf_field()?>
        <div class="form-group">
            <label for="selectInput" class="form-label">Set commission

                <?php if(!empty($commissions)): ?>
                    <?php foreach($commissions as $commission): ?>
                        <span class="text-warning"> (<?= $commission['commission'] ?> %)</span>
                    <?php endforeach; ?>
                <?php endif; ?>

                </Your></label>
            <input type="text" class="form-control form-control-lg" name="commission" value="">
            <?php if(isset($validation)) : ?>
                <?php if($validation->hasError('commission')) :?>
                    <span class="text-danger text-sm"><?= $validation->getError('commission') ?></span>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="mt-3">
            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SUBMIT</button>
        </div>
    </form>