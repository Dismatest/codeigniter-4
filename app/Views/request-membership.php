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
        </div>
    </div>

<?= $this->include('includes/footer.php'); ?>

<?= $this->endSection();?>