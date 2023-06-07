// swiper js
$(document).ready(function(){
    var table = $('#dashboardDataTable').DataTable({
        buttons: ['copy', 'csv', 'pdf', 'print']
    });
    table.buttons().container().appendTo('#example');
});

// js for listing and performing search

$(document).ready(function(){
    function loadAllRecords() {
        $.ajax({
            url: '/index/search',
            method: 'POST',
            data: {
                searchOne: '',
                searchTwo: '',
                sort: ''
            },
            success: function(response){
                if(response.shares.length > 0) {

                    let countAllResult = Object.keys(response.shares).length;
                    $('#results-found').text(countAllResult);
                    let passedHTML = $.parseHTML(response.pagerLinks);
                    $('#pagination-links').html(passedHTML);

                    var sharesContainer = $('#shares-container .row');
                    sharesContainer.empty();


                    $.each(response.shares, function(index, share) {
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
                            '<img src="'+imageUrl+'" alt="" class="image-tag shadow-2-strong">' +
                            '<div class="shares-container-wrapper pl-2">' +
                            '<h5>' + share.name + '</h5>' +
                            '<span>' + share.shares_on_sale + ' shares @ ksh ' + share.total + '</span>' +
                            '<a href="/share/' + share.uuid + '" class="list-share-sell-button">Buy Shares</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                        sharesContainer.append(html);
                    });

                    // Update the pagination links using the provided pager object

                } else {
                    // If no records are returned in the AJAX response
                    $('#shares-container .row').html('<h6 class="text-center">No shares found</h6>');
                    $('#pagination-links').empty();
                }

            },
            error: function(xhr, err, status){
                console.log(err);
            }
        });
    }

    // Function to perform search
    function performSearch() {
        let searchTwo = $('#search-by-value').val();
        let sort = $('#sort').val();

        $('#search-by-sacco').on('change', function() {
            var selectedOption = $(this).find('option:selected');

            var selectedText = selectedOption.text();

            $.ajax({
                url: '/index/search',
                method: 'POST',
                data: {
                    searchOne: selectedText,
                    searchTwo: searchTwo,
                    sort: sort
                },
                success: function(response){
                    //update the dom

                    if(response.shares.length > 0) {

                        var sharesContainer = $('#shares-container .row');
                        sharesContainer.empty();

                        $.each(response.shares, function(index, share) {
                            var html = '<div class="col-md-3 pb-4">' +
                                '<div class="card customize-card">' +
                                '<div class="ribbon"><span>NEW</span></div>' +
                                '<div class="card-body">' +
                                '<div class="sacco-image">' +
                                '<img src="/assets/images/image.PNG" alt="" class="image-tag img-thumbnail shadow-2-strong" style="object-fit: cover;">' +
                                '<div class="shares-container-wrapper pl-2">' +
                                '<h5>' + share.name + '</h5>' +
                                '<span>' + share.shares_on_sale + ' shares @ ksh ' + share.total + '</span>' +
                                '<a href="/share/' + share.uuid + '" type="button" class="btn btn-secondary list-share-sell-button">Buy Shares</a>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            sharesContainer.append(html);
                        });

                        // Update the pagination links using the provided pager object

                    } else {
                        // If no records are returned in the AJAX response
                        $('#shares-container .row').html('<h6 class="text-center">No shares found</h6>');
                        $('#pagination-links').empty();
                    }


                    $('#search-by-sacco').val('');
                    $('#search-by-value').val('');

                },
                error: function(xhr, err, status){
                    console.log(err);
                }
            });
        });

    }

    // Call function to load and render all records when page is ready
    loadAllRecords();

    // Submit form to perform search
    $('#search-form').submit(function(event){
        event.preventDefault();
        performSearch();
    });
});
// end of the ajax call
// membership number verify ajax call
$(document).ready(function() {
    $('.verify-form').submit(function(event){
        event.preventDefault();
        let membership_number = $('#verify').val();
        if(membership_number === ''){
            $('#verify').css('border', '1px solid red');
            $('#error-message').text('Membership number is required'); // Display error message
            return false;
        } else {
            $('#verify').css('border', ''); // Reset border
            $('#error-message').text(''); // Reset error message
        }
        $.ajax({
            url: '/sell/verify_memberNumber',
            method: 'POST',
            data: {
                'verify': membership_number,
            },
            success: function(response){
                if(response.status === 200){

                    // sessionStorage.setItem('shares', response.share);
                    localStorage.setItem('shares', JSON.stringify(response.share));
                    window.location.href = '/sell-now';

                }else if(response.status === 400){
                    $('#error-message').text(response.message); // Display error message
                }
            },
            error: function(xhr, err, status){
                console.log(err);
            },
        });
    });
});

//saving shares ajax call
// logout ajax call
$(document).ready(function() {
    $('#logout').on('click', function(event) {
        event.preventDefault();
        $.ajax({
            url: '/logout',
            method: 'GET',
            success: function(response) {
                if (response.success === true) {
                    window.location.href = '/';
                }
            },
            error: function(xhr, err, status) {
                console.log(err);
            }
        });
    });
});

// end of logout ajax call
// select sacco input jquery

$(document).ready(function() {
    $('.select-input').on('click', function() {
        $(this).siblings('.select-options').toggle();
    });

    $('.select-options li').on('click', function() {
        var value = $(this).data('value');
        var text = $(this).text();
        $(this).parent().siblings('.select-input').val(text);
        $(this).parent().siblings('.select-value').val(value);
        $(this).parent().toggle();
    });

    $('.select-input').on('input', function() {
        var input = $(this).val().toLowerCase();
        $(this).siblings('.select-options').find('li').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(input) > -1);
        });
    });
});


$(document).ready(function() {

    $('.select-input-field').on('click', function() {
        $(this).siblings('.select-options-fields').toggle();
    });

    $('.select-options-fields li').on('click', function() {
        var value = $(this).data('value');
        var text = $(this).text();
        $(this).parent().siblings('.select-input-field').val(text);
        $(this).parent().siblings('.select-value').val(value);
        $(this).parent().toggle();
    });

    $('.select-input-field').on('input', function() {
        var input = $(this).val().toLowerCase();
        $(this).siblings('.select-options-fields').find('li').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(input) > -1);
        });
    });

});
// end of jquery select sacco input

// getting shares from the local storage

$(document).ready(function() {

    $('#clear').on('click', function() {
        $('#shares-for-sale-input-1').val('');
        $('#sell-shares-input').val('');
        $('#error-message').text('');
        $('#memberNumber').val('');
        $('#shares-for-sale-input-2').val('');
        $('#sell-shares-terms').prop('checked', false);
        let display = $('#success').css('display');
        if(display === 'block'){
            $('#success').hide();
        }
    });

    let cost_per_share = '';
    $('.custom-select ul.select-options li').on('click', function() {
        // Remove active class from all li elements
        $('.custom-select ul.select-options li').removeClass('active');
        // Add active class to the selected li element
        $(this).addClass('active');

        let input_sacco_id = $('.custom-select ul.select-options li.active').attr('data-value');
        $.ajax({
            url: '/get_sacco_cost_per_share',
            method: 'POST',
            data: {
                'sacco_id': input_sacco_id,
            },
            success: function(response){
                cost_per_share = response.sacco_cost_per_share;
            },
            error: function(xhr, err, status){
                console.log(err);
            }
        });
    });

});

// end of getting shares from the local storage

// your share status
$(document).ready(function(){
    $.ajax({
        url: '/saved/shares_status',
        method: 'GET',
        success: function (response){
            if(response.userShares && Object.keys(response.userShares).length > 0){
                $('#number-of-shares').text(Object.keys(response.userShares).length);
                let container = $('.my-accordion-content');
                container.empty();
                $.each(response.userShares, function(index, value) {
                    let html = '<div class="shares-on-share-active mb-2">' +
                        '<div class="my-accordion-sacco-info">' +
                        '<h5>' + value.name + ' sacco</h5>' +
                        '<p>Shares: ' + value.shares_on_sale + '</p>' +
                        '<span>Share Status</span>';

                    if (value.is_verified === '2') {
                        html += '<span class="shares-rejected-reason">Rejected with reason: '+ value.reason +'</span>';
                    }

                    html += '</div>' +
                        ' <div class="my-accordion-sacco-share-value">' +
                        '<h5>Share Value</h5>' +
                        '<p>Ksh. ' + value.total + '</p>';

                    if (value.is_verified === '1') {
                        html += '<span class="share-status">Approved</span>';
                    } else if (value.is_verified === '0') {
                        html += '<span class="share-status-pending">Pending</span>';
                    } else if (value.is_verified === '2') {
                        html += '<span class="share-status-rejected">Rejected</span>';
                    }

                    html += '</div></div>';

                    container.append(html);
                });
            }else{
                $('#number-of-shares').text(0);
                let container = $('.my-accordion-content');
                container.empty();
                let html = '<div class="no-registration-info mb-2">' +

                    '<p class="clip-the-path">You do not have active shares</p>' +
                    '<img src="/assets/images/no-active-shares.png?>" style="padding-left: 20px;">' +

                    '</div>';

                container.append(html);


            }

        },

        error: function (xhr, err, status){
            console.log(err);
        }

    });
});

// end of your share status
// save share ajax
$(document).ready(function() {
    $('#save-share-button').click(function(event){
        let shares_id = $('#ajax-share-id').val();
        let user_id = $('#ajax-user-id').val();

        $.ajax({
            url: 'saved/your_share_history/'+shares_id,
            method: 'GET',
            data: {
                shares: shares_id,
                terms: user_id,
            },
            success: function(response){
            },
            error: function(xhr, err, status){
                console.log(err);
            }
        });
    });
});
// end of the ajax call

// saving new member request ajax
$(document).ready(function() {

    $('.custom-select-input ul.select-options-fields li').on('click', function() {
        $('.custom-select-input ul.select-options-fields li').removeClass('active');
        // Add active class to the selected li element
        $(this).addClass('active');
    });

    $('#btn-3').on('click', function(event){
        event.preventDefault();
        let sacco_id = $('.custom-select-input ul.select-options-fields li.active').attr('data-value');
        let id_number = $('#id_number').val();
        $.ajax({
            url: '/share/save_new_membership',
            method: 'POST',
            data: {
                'sacco_id': sacco_id,
                'id_number': id_number,
            },
            success: function(response){
                if(response.status === 400) {
                    $('#warning-message-registration').text(response.message); // Replace 'response.message' with the actual response from the server
                    $('#warning-registration').show();

                }
            },
            error: function(xhr, err, status){
                console.log(err);
            }
        });
    });
});
// end of new member ajax

// delete bids ajax

$(document).ready(function() {
    $('#accepted-accept-delete').on('click',function(){
        let share_id = $(this).attr('data-id');
        $.ajax({
            url: '/share/delete_bid/'+share_id,
            method: 'GET',
            success: function(response){
                if(response.status === 200) {
                    $('.custom-alert').css('display', 'block');
                    $('.saved-message').text(response.message);
                    $('#save-share').css('background-color', '#789f99');
                    setTimeout(function(){
                        location.reload();
                    }, 3000);
                }else{
                    $('#save-share').css('background-color', '#e5e5e5');
                }
            },
            error: function(xhr, err, status){
                console.log(err);
            },
        });

    });
});

$(document).ready(function() {
    $('#rejected-bid-delete').on('click',function(){
        let share_id = $(this).attr('data-id');
        $.ajax({
            url: '/share/delete_bid_rejected/'+share_id,
            method: 'GET',
            success: function(response){
                if(response.status === 200) {
                    $('.custom-alert').css('display', 'block');
                    $('.saved-message').text(response.message);
                    $('#save-share').css('background-color', '#789f99');
                    setTimeout(function(){
                        location.reload();
                    }, 3000);
                }else{
                    $('#save-share').css('background-color', '#e5e5e5');
                }
            },
            error: function(xhr, err, status){
                console.log(err);
            },
        });

    });
});

// end of delete bids ajax
// ajax call for all sacco shares
$(document).ready(function() {
    $.ajax({
        url: '/all_sacco_shares',
        method: 'GET',
        success: function(response){

            var html = '';
            $.each(response.shares, function(index, share) {
                let imageUrl = share.logo ? '/uploads/sacco-logo/'+share.logo : '/assets/images/image.PNG';
                html += '<div class="swiper-slide">' +
                    '<div class="card card-hover-container">' +
                    '<img src="'+ imageUrl + '" class="card-img-top" alt="...">' +
                    '<div class="card-body">' +
                    '<a href="/sacco-all-shares/' + share.uuid + '" class="sacco-read-more" id="get-single-sacco-share" data-id="'+share.uuid+'">View More <i class="fa-solid fa-arrow-right arrow-icon2"></i></a>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            });
            // Update HTML content with dynamically loaded content
            $('#swiper-wrapper').html(html);

            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 3,
                spaceBetween: 30,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    // when window width is <= 320px
                    320: {
                        slidesPerView: 2,
                    },
// when window width is <= 480px
                    480: {
                        slidesPerView: 2,
                    },
// when window width is <= 640px
                    640: {
                        slidesPerView: 3,
                    }

                }

            });

        },
        error: function(xhr, err, status){
            console.log(err);
        }
    });
});
// end of the call


let modal01 = document.getElementById('id01');
let modal01Close = document.getElementById('modal01-close');
let displayModal1 = document.getElementById('display-sell-now-btn');
let modal2 = document.getElementById('id02');
let displayModal2 = document.getElementById('modal2Display');
let modal2Close = document.getElementById('modal02-close');

displayModal1.onclick = function() {
    modal01.style.display = 'block';
}

modal01Close.onclick = function() {
    modal01.style.display = 'none';
}

displayModal2.onclick = function() {
    modal01.style.display = 'none';
    modal2.style.display = 'block';
}

modal2Close.onclick = function() {
    modal2.style.display = 'none';
}

const shareStatus = document.getElementById('shares-status');
const bidStatus = document.getElementById('bid-status');
const  bidContent = document.getElementById('bid-content');
const bidContent2 = document.getElementById('bid-content2');

shareStatus.addEventListener('click', () =>{
    bidContent2.style.display = 'none';
    bidContent.style.display = 'block';
})

bidStatus.addEventListener('click', () =>{
    bidContent2.style.display = 'block';
    bidContent.style.display = 'none';
})

//active links for the page


