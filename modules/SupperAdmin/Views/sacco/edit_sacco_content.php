
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> SupperAdmin Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Dashboard/Edit Sacco <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card card-max-width">
                <div class="card-body">
                    <h5 class="buyer-commission-container pb-3"><span><i class="mdi mdi-account-multiple-plus buyer-commission"></i></span>Edit Sacco Details</h5>
              <?php if(!empty($sacco)) : ?>
               <form method="post" action="">
                   <?= csrf_field()?>
                   <div class="form-group">
                       <label for="contactPersonPhone" class="form-label">Sacco Contact Person Phone</label>
                           <input type="tel" class="form-control" id="contactPersonPhone" placeholder="phone number" name="phone" value="<?= $sacco['contact_phone'] ?>">
                           <?php if(isset($validation)) : ?>
                               <?php if($validation->hasError('phone')) :?>
                                   <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('phone') ?></span>
                               <?php endif; ?>
                           <?php endif; ?>
                   </div>
                   <div class="form-group">
                       <label for="inputHeadOffice" class="form-label">Sacco Head Office</label>
                       <div class="col-sm-10">
                           <input type="text" class="form-control" id="inputHeadOffice" placeholder="head office" name="office" value="<?= $sacco['location'] ?>">
                           <?php if(isset($validation)) : ?>
                               <?php if($validation->hasError('office')) :?>
                                   <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('office') ?></span>
                               <?php endif; ?>
                           <?php endif; ?>
                       </div>
                   </div>
                   <div class="form-group">
                       <label for="inputWebsite" class="form-label">Sacco Website Url</label>
                           <input type="text" class="form-control" id="inputWebsite" placeholder="website url" name="website" value="<?= $sacco['website'] ?>">
                           <?php if(isset($validation)) : ?>
                               <?php if($validation->hasError('website')) :?>
                                   <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('website') ?></span>
                               <?php endif; ?>
                           <?php endif; ?>
                   </div>
                   <div class="form-group">
                       <label for="inputTill" class="form-label">Till Number</label>
                           <input type="number" class="form-control" id="inputTill" placeholder="till number" name="till" value="<?= $sacco['till'] ?>">
                           <?php if(isset($validation)) : ?>
                               <?php if($validation->hasError('till')) :?>
                                   <span class="text-danger text-sm register-sacco-error"><?= $validation->getError('till') ?></span>
                               <?php endif; ?>
                           <?php endif; ?>
                   </div>
                   <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Update</button>
                   <a href="<?= base_url('supperAdmin/manage-sacco') ?>" class="btn btn-block btn-gradient-danger btn-lg font-weight-medium auth-form-btn">Cancel</a>
               </form>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
