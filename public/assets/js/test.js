$('#sell-now-btn').on('click', function(event){
    event.preventDefault();

    let input_sacco_id = $('.custom-select ul.select-options li.active').attr('data-value');
    let shares_for_sale = $('#shares-for-sale-input-1').val();
    let member_commission = $('#member-commission').val();
    let member_number = $('#memberNumber').val();
    let sale_shares = $('#sell-shares-input').val('');
    let total_share_value = $('#shares-for-sale-input-2').val();
    let checked = $('#sell-shares-terms').is(':checked');


    let commission = (total_share_value * member_commission) / 100;
    let total = Number(total_share_value) + Number(commission);

    if(sale_shares === '' || shares_for_sale === '' || member_number === '' || total_share_value === ''){
        $('#error-message').text('Please fill in all the fields.');
        return false;
    }

    if(shares_for_sale < 1){
        $('#error-message').text('Shares for sale should be greater than 0.');
        return false;
    }

    if(member_number.length !== 8){
        $('#error-message').text('Member number should be 8 characters long.');
        return false;
    }
    if(member_commission < 0 || member_commission > 100){
        $('#error-message').text('The commission charged has not been set, please contact the sacco admin.');
        return false;
    }
    if(!checked){
        $('#error-message').text('Please agree to the terms and conditions.');
        return false;
    }

    $.ajax({
        url: 'sell-now/requestSell',
        method: 'POST',
        data: {
            'sacco_id': input_sacco_id,
            'member_number': member_number,
            'share': shares_for_sale,
            'total': total,
        },
        success: function(response){
            $('#success-message').text('success, your shares will go live once approved by admin');
            $('#success').show();

        },
        error: function(xhr, err, status){
            console.log(err);
            $('#error-message').text('An error occurred, please try again later.');
            return false;
        }
    });

});