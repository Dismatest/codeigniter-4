<?= $this->extend("client_base/base.php"); ?>
<?= $this->section('content'); ?>

<?= $this->include('includes/navbar.php'); ?>


<div class="load"></div>
<div class="container">
    <div class="row mt-5 mb-md-4 mb-sm-1">
        <div class="col-md-12">
            <div class="main-explore-container">
                <h3 class="text-center">Explore as you discover recommended share capital for you</h3>
                <form method="post" action="" class="explore-search-container">
                    <select class="explore-select">
                        <?php if(!empty($allSacco)) ?>
                        <?php foreach ($allSacco as $sacco) : ?>
                            <option value="<?= $sacco['sacco_id'] ?>"><?= $sacco['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" id="search-by-value" name="searchPrice" placeholder="search by price value"/>
                    <button type="submit" class="explore-search">Search</button>
                </form>
                <div class="recent search">
                    <p>Your Recent Searches</p>
                    <div class="d-flex">
                        <?php if(!empty($search)) : ?>
                        <?php foreach ($search as $user_search) : ?>
                        <div class="recent-search-container" style="margin-right: 5px;">
                            <a class="search-links" data-id=<?= $user_search['search_id'] ?> data-name="<?= $user_search['sacco_name']?>" data-price="<?= $user_search['total'] ?>"><?= $user_search['sacco_name'] ?> <i class="fa-solid fa-magnifying-glass saved-search-icon"></i></a>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="recommended-section">
                <h3>Recommended Share Capital</h3>
                <a href="<?= base_url() .'/index'?>" class="explore-all">Explore all Share Capital</a>
            </div>
        </div>
    </div>
</div>
            <div class="container" id="shares-container2">

                <div class="row pb-4 list-shares-main-container">
                    <!-- Remove the PHP loop -->

                    <div class="col-md-3 col-6 list-shares-shares">
                        <div class="card customize-card">
                            <div class="card-body">
                                <div class="placeholder-glow placeholder-main-container">
                                    <span class="placeholder placeholder-sacco-image"></span>
                                    <div class="placeholder-glow placeholder-sacco-name-container">
                                        <span class="placeholder w-100 placeholder-sacco-name"></span>
                                        <span class="placeholder w-100 placeholder-xs placeholder-price"></span>
                                        <div class="placeholder-button-div">
                                            <span class="placeholder w-75 placeholder-sm placeholder-button"></span>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 col-6 list-shares-shares">
                        <div class="card customize-card">
                            <div class="card-body">
                                <div class="placeholder-glow placeholder-main-container">
                                    <span class="placeholder placeholder-sacco-image"></span>
                                    <div class="placeholder-glow placeholder-sacco-name-container">
                                        <span class="placeholder w-100 placeholder-sacco-name"></span>
                                        <span class="placeholder w-100 placeholder-xs placeholder-price"></span>
                                        <div class="placeholder-button-div" >
                                            <span class="placeholder w-75 placeholder-sm placeholder-button"></span>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 col-6 list-shares-shares">
                        <div class="card customize-card">
                            <div class="card-body">
                                <div class="placeholder-glow placeholder-main-container">
                                    <span class="placeholder placeholder-sacco-image"></span>
                                    <div class="placeholder-glow placeholder-sacco-name-container">
                                        <span class="placeholder w-100 placeholder-sacco-name"></span>
                                        <span class="placeholder w-100 placeholder-xs placeholder-price"></span>
                                        <div class="placeholder-button-div">
                                            <span class="placeholder w-75 placeholder-sm placeholder-button"></span>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 col-6 list-shares-shares">
                        <div class="card customize-card">
                            <div class="card-body">
                                <div class="placeholder-glow placeholder-main-container">
                                    <span class="placeholder placeholder-sacco-image"></span>
                                    <div class="placeholder-glow placeholder-sacco-name-container">
                                        <span class="placeholder w-100 placeholder-sacco-name"></span>
                                        <span class="placeholder w-100 placeholder-xs placeholder-price"></span>
                                        <div class="placeholder-button-div">
                                            <span class="placeholder w-75 placeholder-sm placeholder-button"></span>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- the end of the body section -->
<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>

<?= $this->endSection(); ?>

<?php $this->section('explore-script'); ?>
<script>
    $(document).ready(function () {
        $.ajax({
            url: "<?= base_url() . '/explore/get_recommended'?>",
            method: "GET",
            success: function (response) {
                if(response.length > 0){
                    var sharesContainer = $('#shares-container2 .row');
                    sharesContainer.empty();

                    $.each(response, function(index, share) {

                        let dateCreated = new Date(share.created_at);
                        let dateNow = new Date();

                        let timeDiff = dateNow - dateCreated;
                        let differentDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24));

                        let imageUrl = share.logo ? '/uploads/sacco-logo/'+share.logo : '/assets/images/image.PNG';
                        var html = '<div class="col-md-3 col-6 list-shares-shares">' +
                            '<div class="card customize-card">' +
                            (differentDays < 3 ? '<div class="ribbon"><span>New</span></div>' : '') +
                            '<div class="card-body">' +
                            '<div class="sacco-image">' +
                            '<img src="'+ imageUrl + '" alt="" class="image-tag shadow-2-strong">' +
                            '<div class="shares-container-wrapper pl-2">' +
                            '<h5>' + share.name + '</h5>' +
                            '<span>' + share.shares_on_sale + ' shares @ ksh ' + share.total + '</span>' +
                            '<a href="<?= base_url() ?>/share/' + share.uuid + '" class="list-share-sell-button">Buy Shares</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        sharesContainer.append(html);
                    });
                }else{
                    $('#shares-container2 .row').html('<h6 class="text-center">No share capital recommendation found</h6>');
                }
            }
        });

    //     start of the search
        let sacco = '';
        let sacco_name = '';
        $('.explore-search').on('click', function (e){
            e.preventDefault();
            sacco = $('.explore-select').val();
            sacco_name = $('.explore-select').find('option:selected').text();
            let value = $('#search-by-value').val();
            performSearch(sacco_name, value);
        });

        function performSearch(sacco_name, value){
            let url = '';
            if(sacco_name.trim() !== '' && value !== ''){
                url = '<?= base_url() ?>/explore/search?selectedSacco=' + encodeURIComponent(sacco_name) + '&sharePrice=' + encodeURIComponent(value);
            }else if(sacco_name.trim() !== ''){
                url = '<?= base_url() ?>/explore/search?selectedSacco=' + encodeURIComponent(sacco_name);
            }else if(value !== '') {
                url = '<?= base_url() ?>/explore/search?sharePrice=' + encodeURIComponent(value);
            }else{
                url = '<?= base_url() ?>/explore/search';
            }

            $.ajax({
               url : url,
                method : 'GET',
                success : function (response){
                  renderResponse(response);
                  // window.history.pushState(null, null, url)
                },
                error : function (error){
                    console.log(error);
                }
            });
        }

        $('.search-links').on('click', function(){
            let sacco_name = $(this).data('name');
            let value = $(this).data('price');
            performSearch(sacco_name, value);
        });

        function renderResponse(response){
            if(response.length > 0){
                var sharesContainer = $('#shares-container2 .row');
                sharesContainer.empty();

                $.each(response, function(index, share) {

                    let dateCreated = new Date(share.created_at);
                    let dateNow = new Date();

                    let timeDiff = dateNow - dateCreated;
                    let differentDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24));

                    let imageUrl = share.logo ? '/uploads/sacco-logo/'+share.logo : '/assets/images/image.PNG';
                    var html = '<div class="col-md-3 col-6 list-shares-shares">' +
                        '<div class="card customize-card">' +
                        (differentDays < 3 ? '<div class="ribbon"><span>New</span></div>' : '') +
                        '<div class="card-body">' +
                        '<div class="sacco-image">' +
                        '<img src="'+ imageUrl + '" alt="" class="image-tag shadow-2-strong">' +
                        '<div class="shares-container-wrapper pl-2">' +
                        '<h5>' + share.name + '</h5>' +
                        '<span>' + share.shares_on_sale + ' shares @ ksh ' + share.total + '</span>' +
                        '<a href="<?= base_url() ?>/share/' + share.uuid + '" type="button" class="btn btn-secondary list-share-sell-button">Buy Shares</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    sharesContainer.append(html);
                });
            }else{
                $('#shares-container2 .row').html('<h6 class="text-center">No share capital found</h6>');
            }
        }

    });
</script>
<?php $this->endSection(); ?>
