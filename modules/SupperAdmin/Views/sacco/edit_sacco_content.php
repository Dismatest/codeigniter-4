
<div class="content-wrapper">
    <h5 class="text-center text-primary">Set Sacco Details</h5>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-primary">Contact Person</h5>
               <form method="post" action="">
                   <?= csrf_field()?>
                   <div class="mb-2 row">
                       <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                       <div class="col-sm-10">
                           <input type="tel" class="form-control" id="inputPhone" placeholder="phone number" name="phone" value="<?= $sacco['contact_phone'] ?>">
                           <?php if(isset($validation)) : ?>
                               <?php if($validation->hasError('phone')) :?>
                                   <span class="text-danger text-sm"><?= $validation->getError('phone') ?></span>
                               <?php endif; ?>
                           <?php endif; ?>
                       </div>
                   </div>
                   <div class="mb-2 row">
                       <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                       <div class="col-sm-10">
                           <input type="text" class="form-control" id="inputEmail" placeholder="email address" name="email" value="<?= $sacco['contact_email'] ?>">
                           <?php if(isset($validation)) : ?>
                               <?php if($validation->hasError('email')) :?>
                                   <span class="text-danger text-sm"><?= $validation->getError('email') ?></span>
                               <?php endif; ?>
                           <?php endif; ?>
                       </div>
                   </div>
                   <h5 class="text-primary">Sacco Details</h5>
                   <div class="mb-2 row">
                       <label for="inputHeadOffice" class="col-sm-2 col-form-label">Head Office</label>
                       <div class="col-sm-10">
                           <input type="text" class="form-control" id="inputHeadOffice" placeholder="head office" name="office" value="<?= $sacco['location'] ?>">
                           <?php if(isset($validation)) : ?>
                               <?php if($validation->hasError('office')) :?>
                                   <span class="text-danger text-sm"><?= $validation->getError('office') ?></span>
                               <?php endif; ?>
                           <?php endif; ?>
                       </div>
                   </div>
                   <div class="mb-2 row">
                       <label for="inputWebsite" class="col-sm-2 col-form-label">Website Url</label>
                       <div class="col-sm-10">
                           <input type="text" class="form-control" id="inputWebsite" placeholder="website url" name="website" value="<?= $sacco['website'] ?>">
                           <?php if(isset($validation)) : ?>
                               <?php if($validation->hasError('website')) :?>
                                   <span class="text-danger text-sm"><?= $validation->getError('website') ?></span>
                               <?php endif; ?>
                           <?php endif; ?>
                       </div>
                   </div>
                   <h5 class="text-primary">Payment Details</h5>
                   <div class="mb-2 row">
                       <label for="inputTill" class="col-sm-2 col-form-label">Till Number</label>
                       <div class="col-sm-10">
                           <input type="number" class="form-control" id="inputTill" placeholder="till number" name="till" value="<?= $sacco['till'] ?>">
                           <?php if(isset($validation)) : ?>
                               <?php if($validation->hasError('till')) :?>
                                   <span class="text-danger text-sm"><?= $validation->getError('till') ?></span>
                               <?php endif; ?>
                           <?php endif; ?>
                       </div>
                   </div>
                   <h5 class="text-primary">Commission</h5>
                   <div class="mb-2 row">
                       <label for="inputCommission" class="col-sm-2 col-form-label">Commission (%)</label>
                       <div class="col-sm-10">
                           <input type="number" class="form-control" id="inputCommission" placeholder="set commission" name="commission" value="<?= $sacco['commission'] ?>">
                           <?php if(isset($validation)) : ?>
                               <?php if($validation->hasError('commission')) :?>
                                   <span class="text-danger text-sm"><?= $validation->getError('commission') ?></span>
                               <?php endif; ?>
                           <?php endif; ?>
                       </div>
                   </div>
                   <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Submit</button>
               </form>

                </div>
            </div>
        </div>
    </div>
