<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h6 id="file-error-upload" class="text-center text-warning"></h6>
                    <h6 id="form-success" class="text-center text-success"></h6>
                    <h6 id="fail" class="text-center text-warning"></h6>
                    <h4 class="text-center">Upload agreement form in pdf format</h4>
                    <div class="d-flex justify-content-center align-items-center">
                    <form class="pt-3" method="post" action="<?= 'upload_agreement_files' ?>" enctype="multipart/form-data" id="upload-form">
                        <?= csrf_field()?>

                        <div class="drop-zone">
                            <span class="drop-zone__prompt">Drop file or click to upload</span>
                            <input type="file" class="drop-zone--input" name="agreementFile" id="agreementInputField">
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" id="upload-btn" style="width: 100%;">UPLOAD</button>
                        </div>
                </div>
                </form>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

