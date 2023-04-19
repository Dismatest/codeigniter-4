
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
                        var html = '<div class="col-md-3 pb-2">' +
                            '<div class="card customize-card">' +
                            '<div class="ribbon"><span>New</span></div>' +
                            '<div class="card-body">' +
                           '<div class="sacco-image">' +
                            '<img src="/assets/images/image.png" alt="" class="image-tag shadow-2-strong">' +
                            '<div class="shares-container-wrapper pl-2">' +
                            '<h5>' + share.name + ' sacco ltd.</h5>' +
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

            },
            error: function(xhr, err, status){
                console.log(err);
            }
        });
    }

    // Function to perform search
    function performSearch() {
        let searchOne = $('#search-by-sacco').val();
        let searchTwo = $('#search-by-value').val();
        let sort = $('#sort').val();

        $.ajax({
            url: '/index/search',
            method: 'POST',
            data: {
                searchOne: searchOne,
                searchTwo: searchTwo,
                sort: sort
            },
            success: function(response){
                //update the dom

                if(response.shares.length > 0) {

                    var sharesContainer = $('#shares-container .row');
                    sharesContainer.empty();

                    $.each(response.shares, function(index, share) {
                        var html = '<div class="col-md-3">' +
                            '<div class="card customize-card">' +
                            '<div class="ribbon"><span>NEW</span></div>' +
                            '<div class="card-body">' +
                            '<div class="sacco-image">' +
                            '<img src="/assets/images/image.png" alt="" class="image-tag img-thumbnail shadow-2-strong" style="object-fit: cover;">' +
                            '<div class="shares-container-wrapper pl-2">' +
                            '<h5>' + share.name + ' sacco ltd.</h5>' +
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
        if(membership_number == ''){
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
        console.log('logout');
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

// end of jquery select sacco input

// getting shares from the local storage

$(document).ready(function() {

    $('#clear').on('click', function() {
        $('#shares-for-sale-input-1').val('');
        $('#sell-shares-input').val('');
        $('#error-message').text('');
        $('#memberNumber').val('');
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


    $('#sell-now-btn').on('click', function(event){
        event.preventDefault();

        let input_sacco_id = $('.custom-select ul.select-options li.active').attr('data-value');
        let shares_for_sale = $('#shares-for-sale-input-1').val();
        let member_commission = $('#member-commission').val();
        let member_number = $('#memberNumber').val();
        let sale_shares = $('#sell-shares-input').val('');
        let checked = $('#sell-shares-terms').is(':checked');

        let commission = (shares_for_sale * member_commission) / 100;
        let total = (shares_for_sale * cost_per_share) + commission;

        if(sale_shares === '' || shares_for_sale === '' || member_number === ''){
            $('#error-message').text('Please fill in all the fields.');
            return false;
        }
        if(!checked){
            $('#error-message').text('Please agree to the terms and conditions.');
            return false;
        }

        let message = 'Please verify ' + member_number + ' selling ' + shares_for_sale + ' shares';

        $.ajax({
            url: 'sell-now/requestSell',
            method: 'POST',
            data: {
                'sacco_id': input_sacco_id,
                'member_number': member_number,
                'share': shares_for_sale,
                'price': cost_per_share,
                'total': total,
                'message': message,
            },
            success: function(response){
                $('#success-message').text('success, your shares will go live once approved by admin'); // Replace 'response.message' with the actual response from the server
                $('#success').show();

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
             console.log(response);
            },
            error: function(xhr, err, status){
                console.log(err);
            }
        });
    });
});
// end of the ajax call

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


document.addEventListener('DOMContentLoaded', function() {
    const eyeIcon = document.querySelector('.fa-eye-slash');
    const content = document.querySelector('.dashboard-shares-balance');
    if(eyeIcon){
        eyeIcon.addEventListener('click', function() {

            if (content.style.display === 'none') {
                content.style.display = 'block';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                content.style.display = 'none';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });
    }
});

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


