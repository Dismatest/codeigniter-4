<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Admin Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Admin/Register new member <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <h5 class="text-center pb-2">Register New Members here</h5>
    <div class="row">
        <div class="col-md-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4>Create User</h4>

                    <form class="pt-3" method="post" action="<?= 'new_user_post' ?>" id="create-new-users">
                        <?= csrf_field() ?>

                        <div id="display-share-form">
                            <div class="form-group">
                                <label for="selectInput" class="form-label">First Name*</label>
                                <input type="text" class="form-control form-control-lg" placeholder="First Name"
                                       name="fname" id="fname">
                                <span class="register-errors"></span>
                            </div>

                            <div class="form-group">
                                <label for="selectInput" class="form-label">Last Name*</label>
                                <input type="text" class="form-control form-control-lg" placeholder="Last Name"
                                       name="lname" id="lname">
                                <span class="register-errors"></span>
                            </div>
                            <div class="form-group">
                                <label for="selectInput" class="form-label">Email*</label>
                                <input type="email" class="form-control form-control-lg" placeholder="Email"
                                       name="email" id="email">
                                <span class="register-errors"></span>
                            </div>
                            <div class="form-group">
                                <label for="selectInput" class="form-label">Phone*</Your></label>
                                <input type="number" class="form-control form-control-lg" placeholder="Phone number"
                                       name="phone" id="phone">
                                <span class="register-errors"></span>
                            </div>
                            <div class="mt-3">
                                <button
                                    class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                    id="register">SAVE
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4>Upload CSV</h4>

                    <form class="pt-3" enctype="multipart/form-data" id="csv-form-upload">
                        <?= csrf_field() ?>

                        <div id="display-share-form">

                            <div class="form-group">
                                <label for="selectInput" class="form-label">Upload csv*</Your></label>
                                <input type="file" class="form-control" placeholder="Cost Per Share" name="file"
                                       id="csv-file-input" accept=".csv">

                            </div>
                            <div class="mt-3">
                                <button
                                    class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                    id="csv-upload">UPLOAD
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>


    </div>
    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>


