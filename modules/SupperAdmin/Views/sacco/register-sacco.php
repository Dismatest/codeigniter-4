
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Onboard New Sacco
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>


    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
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
                    <form class="pt-3" method="post" action="">
                        <?= csrf_field()?>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" placeholder="Name of the Sacco" name="name">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('name')) :?>
                                    <span class="text-danger text-sm"><?= $validation->getError('name') ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="email" placeholder="Sacco Email" name="email">
                            <?php if(isset($validation)) : ?>
                                <?php if($validation->hasError('email')) :?>
                                    <span class="text-danger text-sm"><?= $validation->getError('email') ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="mt-3 d-flex">
                            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">ONBOARD</button>
                        </div>

                </form>
                </div>
                </div>
            </div>
        </div><!-- page-body -->
