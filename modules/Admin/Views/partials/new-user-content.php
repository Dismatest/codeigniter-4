<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin">



            <div class="card">
                <div class="card-body">
                    <h4>Create User</h4>

                    <form class="pt-3" method="post" action="<?= 'new_user_post' ?>">
                        <?= csrf_field()?>

                        <div id="display-share-form">
                            <div class="form-group">
                                <label for="selectInput" class="form-label">First Name*</label>
                                <input type="text" class="form-control form-control-lg" placeholder="First Number" name="fname">
                            </div>

                            <div class="form-group">
                                <label for="selectInput" class="form-label">Last Name*</label>
                                <input type="text" class="form-control form-control-lg" placeholder="Last Name" name="lname">
                            </div>
                            <div class="form-group">
                                <label for="selectInput" class="form-label">Email*</label>
                                <input type="email" class="form-control form-control-lg" placeholder="Email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="selectInput" class="form-label">Phone*</Your></label>
                                <input type="number" class="form-control form-control-lg" placeholder="Phone number" name="phone">

                            </div>
                            <div class="mt-3">
                                <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SAVE</button>
                            </div>
                        </div>

                </div>
                </form>

            </div>
        </div>


        <div class="col-md-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4>Upload CSV</h4>

                    <form class="pt-3" method="post" action="">
                        <?= csrf_field()?>

                        <div id="display-share-form">

                            <div class="form-group">
                                <label for="selectInput" class="form-label">Upload csv*</Your></label>
                                <input type="file" class="form-control form-control-lg" placeholder="Cost Per Share" name="cost">

                            </div>
                            <div class="mt-3">
                                <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">UPLOAD</button>
                            </div>
                        </div>

                </div>
                </form>

            </div>
        </div>





    </div>
</div>

<?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

