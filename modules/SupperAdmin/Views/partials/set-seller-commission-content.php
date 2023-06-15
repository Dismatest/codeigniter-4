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
                    <span></span>Dashboard/Set Commission <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="set-buyer-commission-container">
                <h5 class="buyer-commission-container"><span><i class="mdi mdi-account-multiple-plus buyer-commission"></i></span>Set Seller's Commission</h5>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="mdi mdi-plus add-buyers-commission-icon"></i>Set Commission</button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="seller-commission-table" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th> commission </th>
                                <th> Date Created</th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

<!--set buyer commission modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Set Seller's Commission</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="pt-3" id="set-buyer-commission">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="selectInputBuyerCommission" class="form-label">Set commission *</label>
                        <input type="number" id="selectInputSellerCommission" class="form-control form-control-lg" name="sellerCommission" value="">
                        <span class="buyer-commission-error"></span>
                        <span class="buyer-commission-success"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="save-seller-commission">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--update buyer commission modal-->
<div class="modal fade" id="updateExampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Seller's Commission</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="pt-3" id="set-buyer-commission">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="updateBuyerCommission" class="form-label">Update commission</label>
                        <input type="number" id="updateSellerCommission" class="form-control form-control-lg" value="">
                        <span class="update-commission-error"></span>
                        <span class="update-commission-success"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="update-seller-commission">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end of the modal --->