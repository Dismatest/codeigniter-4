<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4>Set Price per share</h4>

                    <form class="pt-3" method="post" action="">
                        <div id="display-share-form">
                            <div class="form-group">
<!--                                --><?php //if(isset($pricePerShare)) :?>
<!--                                --><?php //foreach($pricePerShare as $price):?>
                                        <label for="selectInput" class="form-label">Set Price Per Share*</label>
                                        <input type="number" class="form-control form-control-lg" placeholder="Enter the price per share" name="pricePerShare" value="">
<!--                                --><?php //endforeach;?>
<!--                                --><?php //endif;?>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SAVE</button>
                            </div>
                        </div>

                    </form>
                      </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

