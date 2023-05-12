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
                    <span></span>Admin/Update Account <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">

                    <h4 class="text-center pt-3">Update Sacco Profile Information</h4>

                    <form class="pt-3" method="post" action="" id="admin-update-sacco-profile" enctype="multipart/form-data">
                        <?= csrf_field()?>

                        <div class="form-group">
                            <label for="contact-person-phone" class="form-label">Contact Person Phone</label>
                            <input type="tel" class="form-control" placeholder="contact person phone number" id="contact-person-phone" name="contactPersonPhone" value="">
                        </div>
                        <div class="form-group">
                            <label for="contact-person-email" class="form-label">Contact Person Email</label>
                            <input type="email" class="form-control" name="contactPersonEmail" value="" id="contact-person-email" placeholder="contact person email">
                        </div>
                        <div class="form-group">
                            <label for="sacco-headquarter" class="form-label">Sacco Headquarters</label>
                            <input type="text" class="form-control" id="sacco-headquarter" name="saccoHeadquarter" value="" placeholder="sacco headquarters">
                        </div>
                        <div class="form-group">
                            <label for="website-url" class="form-label">Sacco Website Url</label>
                            <input type="url" class="form-control" placeholder="sacco website url" name="website" value="" id="website-url">
                        </div>
                        <div class="form-group">
                            <label for="sacco-logo" class="form-label" id="sacco-logo-file">Sacco Logo</label>
                            <input type="file" class="form-control" name="saccoLogo" value="" id="sacco-logo">
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-block btn-gradient-primary font-weight-medium auth-form-btn" id="update-sacco-information">
                                Submit
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
<?php $this->section('admin-update-profile-script') ?>
<script>
   $(document).ready(function(){
       $('#update-sacco-information').on('click', function(){
           $.validator.addMethod("fileExtension", function(value, element, param) {
                   param = typeof param === "string" ? param.replace(/,/g, "|") : "png|jpe?g";
                   return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
           }, $.validator.format("Please upload a valid image file."));

           $('#admin-update-sacco-profile').validate({
               errorClass: 'error',
               validClass: 'valid',

                rules: {
                     contactPersonPhone: {
                          minlength: 10,
                          maxlength: 10,
                          number: true
                     },
                     contactPersonEmail: {
                          email: true,
                     },
                     saccoHeadquarter: {
                          minlength: 5,
                          maxlength: 100,
                     },
                     website: {
                          url: true
                     },
                     saccoLogo: {
                         fileExtension: "png,jpg,jpeg"
                     }
                },
                messages: {
                     contactPersonPhone: {
                          minlength: "Phone number must be 10 digits",
                          maxlength: "Phone number must be 10 digits",
                          number: "Phone number must be digits"
                     },
                     contactPersonEmail: {
                          email: "Please enter a valid email address"
                     },
                     saccoHeadquarter: {
                          minlength: "Sacco headquarters must be at least 5 characters long",
                          maxlength: "Sacco headquarters must be at most 100 characters long",
                     },
                     website: {
                          url: "Please enter a valid url"
                     },
                },
               highlight: function (element) {
                   $(element).addClass('error');
               },
               unhighlight: function (element) {
                   $(element).removeClass('error');
               },
               errorPlacement: function (error, element) {
                   error.addClass('help-block');
                   element.parents('.form-group').addClass('has-error');
                   error.appendTo(element.parent());
               },
               success: function (label) {
                   label.parents('.form-group').removeClass('has-error');
               },
               onkeyup: function (element) {
                   $(element).valid();
               },

               submitHandler: function(form){

                   $('#update-sacco-information').addClass('disabled').html('<i class="mdi mdi-spin mdi-loading"></i> Updating ...');
                   $.ajax({
                       url: '<?= base_url('admin/update-sacco-profile')?>',
                       type: 'POST',
                       data: new FormData($('#admin-update-sacco-profile')[0]),
                       processData: false,
                       contentType: false,
                       success: function(response){
                           if(response.status === 200){
                               var delay = alertify.get('notifier','delay');
                               alertify.set('notifier','delay', 20);
                               alertify.success(response.messages);
                               alertify.set('notifier','delay', delay);
                           }
                       },
                       error: function(error){
                           console.log(error);
                       },
                       complete: function(){

                           $('#update-sacco-information').removeClass('disabled').html('Submit');
                       }
                   })
               }

           });

       })

       function getUpdatedProfile(){
           $.ajax({
               url: '<?= base_url('admin/get-updated-profile')?>',
               type: 'GET',
               dataType: 'json',
               success: function(response){
                   console.log(response);
                   console.log(response.data[0].contact_phone);
                   if(response.status === 200){

                       $('#contact-person-phone').val(response.data[0].contact_phone);
                       $('#contact-person-email').val(response.data[0].contact_email);
                       $('#sacco-headquarter').val(response.data[0].location);
                       $('#website-url').val(response.data[0].website);
                       $('#sacco-logo-file').text(response.data[0].logo);
                   }
               },
               error: function(error){
                   console.log(error);
               }
           });
       }

         getUpdatedProfile();
   })
</script>
<?php $this->endSection() ?>
