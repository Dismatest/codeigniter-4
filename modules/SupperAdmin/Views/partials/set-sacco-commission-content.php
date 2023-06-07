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
                <h5 class="buyer-commission-container"><span><i class="mdi mdi-contrast buyer-commission"></i></span>Set Sacco's Commission</h5>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#set-sacco-commission"><i class="mdi mdi-plus add-buyers-commission-icon"></i>Set Commission</button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="sacco-commission-table" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th> Sacco Name </th>
                                <th> commission </th>
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
        <!--        end-->

    </div>
    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>
<!--set sacco commission modal-->
<div class="modal fade" id="set-sacco-commission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Set sacco's Commission</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="pt-3" id="set-sacco-commission">
                <div class="sacco-commission-success-container">
                    <span class="set-sacco-commission-success"></span>
                </div>
                <div class="sacco-commission-error-container">
                    <span class="set-sacco-commission-error"></span>
                </div>
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="selectSaccoSetCommission" class="form-label">Select sacco*</label>
                        <select class="form-select" aria-label="Default select example" id="selectSacco">
                            <option selected>Select sacco</option>
                            <?php if (!empty($saccos)): ?>
                                <?php foreach ($saccos as $sacco): ?>
                                    <option value="<?= $sacco['sacco_id'] ?>"><?= $sacco['name'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <span class="sacco-commission-error-select"></span>
                    </div>
                    <div class="form-group">
                        <label for="selectInputBuyerCommission" class="form-label">Set commission*</label>
                        <input type="number" id="saccoCommission" class="form-control form-control-lg" value="">
                        <span class="sacco-commission-error-input"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="save-sacco-commission">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end of the modal -->

<!--update buyer commission modal-->
<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Sacco's Commission</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="sacco-commission-success-container">
                    <span class="set-sacco-commission-success"></span>
                </div>
                <div class="sacco-commission-error-container">
                    <span class="set-sacco-commission-error"></span>
                </div>
                <div class="form-group">
                    <label for="updateSaccoCommissionName" class="form-label">Sacco Name*</label>
                    <input type="text" readonly id="updateSaccoCommissionName" class="form-control form-control-lg" value="">
                    <input type="hidden" readonly id="sacco_id" class="form-control form-control-lg" value="">
                </div>
                <div class="form-group">
                    <label for="updateSaccoCommission" class="form-label">Update commission</label>
                    <input type="number" id="updateSaccoCommission" class="form-control form-control-lg" value="">
                    <span class="update-sacco-commission-error"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="update-sacco-commission" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!--end of the modal --->




