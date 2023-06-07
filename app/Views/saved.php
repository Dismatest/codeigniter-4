<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container alert-main-container pt-5 pb-5">

    <div class="custom-alert">
        <div class="d-flex justify-content-around">
            <span><i class="fas fa-circle-check verified-budge check-icon-saved"></i></span>
            <span class="saved-message"></span>
            <span><i class="fa-solid fa-xmark close-icon-saved"></i></span>
        </div>
    </div>

    <div class="row">

        <?= $this->include('includes/saved-sidebar.php'); ?>

        <div class="col-md-7 settings-top-social-media">
            <div class="main-saved-container">
                <div class="save-title">
                    <h5>My Saved Shares</h5>
                    <button>Shares (<span  id="count-all-saved"></span>)</button>
                </div>
                <hr>
                <div class="saved-shares-content">

                    <div class="saved-loading">
                        <i class="fa-solid fa-circle-notch fa-spin saved-loading-icon"></i>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>
<?= $this->endSection(); ?>
<?php $this->section('saved-shares');?>
<script>
    $(document).ready(function(){
       function loadSavedShares(){
           $.ajax({
               url: "<?= base_url('saved/get-all-saved-shares'); ?>",
               method: "GET",
               dataType: "json",
               success: function(data){
                   if(Object.keys(data).length > 0){
                       let countAllResult = Object.keys(data.shares).length;
                       $('#count-all-saved').text(countAllResult);

                       let html = '';
                       $.each(data.shares, function(index, share){
                           let imageUrl = share.logo ? '/uploads/sacco-logo/'+share.logo : '/assets/images/image.PNG';
                           html += '<div class="margin-content-section">' +
                               '<div class="saved-shares-details">' +
                               '<img src="'+ imageUrl + '" alt="sacco-profile" >' +
                               '</div>' +
                               '<div class="saved-shares-more-details">' +
                               '<h4>' + share.name + '</h4>' +
                               '<h5 class="shares-value">' + share.shares_on_sale + ' Share Capital <span>@ ksh: ' + share.total + '</span></h5>' +
                               '</div>' +
                               `<div class="close-saved-share" data-id="${share.saved_id}" id="delete-saved-share"><i class="fa-solid fa-x"></i></div>` +
                               '</div>' +
                               '<hr>';
                       });
                       $('.saved-shares-content').html(html);
                   }else{
                          $('.saved-shares-content').html('<h5 class="text-center">No saved shares yet</h5>');
                   }
               },
                error: function(xhr, status, error){
                     console.log(xhr.responseText);
               }
           });
       }

         loadSavedShares();

       $('.saved-shares-content').on('click', '#delete-saved-share', function(){
           let saved_id = $(this).data('id');
           $.ajax({
               url: "<?= base_url('saved/delete-saved-share'); ?>",
               method: "POST",
               data: {saved_id: saved_id},
               dataType: "json",
               success: function (data) {
                   if (data.status === 200) {
                       $('.custom-alert').css('display', 'block');
                       $('.saved-message').text(data.message);
                       $('#save-share').css('background-color', '#789f99');
                       loadSavedShares();
                   }else{
                       $('#save-share').css('background-color', '#e5e5e5');
                   }
               },
               error: function (xhr, status, error) {
                   console.log(xhr.responseText);
               }
           });
       });


       $('.close-icon-saved').on('click', function (){
           $('.custom-alert').css('display', 'none');
       })

    });

</script>
<?php $this->endSection(); ?>
