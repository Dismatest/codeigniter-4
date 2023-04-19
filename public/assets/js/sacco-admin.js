
$(document).ready(function() {
    $('#upload-form').on('submit', function(event) {
        event.preventDefault();
        let myFile = $('#agreementInputField');
        let inputValue = myFile.val();
        if(!inputValue) {
            var errors = 'Please select file to upload';
            $('#file-error-upload').text(errors);
            return;
        }else{
            errors = '';
            $('#file-error-upload').text(errors);
        }

        $.ajax({
            url: '/admin/upload_agreement_files',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#upload-form')[0].reset();
                let success = 'The file has been saved successfully';
                $("#form-success").text(success);
            },
                error: function(error) {
                    let fail = 'An error has occurred, refresh the page then upload new file';
                    $("#fail").text(fail);
                }
         })
    });
});

// ajax request for viewing the data

$(document).ready(function() {
    $(document).on('click', '.mark-as-read', function() {

        let data_id = $(this).data('id');

        $.ajax({
            method: 'POST',
            url: '/admin/get_each_share_notification',
            data:{
                share_id: data_id,
            },

            success: function(response) {
                $.each(response, function(key, value) {
                    const date = new Date(value.created_at);
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    const formattedDate = `${month}/${day}/${year}`;

                    $('#notification-seller-name').text(value.fname +' '+ value.lname);
                    $('#buyer-member-number').text(value.membership_number);
                    $('#notification-shares').text(value.shares_on_sale);
                    $('#notification-sacco').text(value.name);
                    $('#notification-share-value').text(value.total);
                    $('#notification-date').text(formattedDate);
                    $('#notification-reject').attr({'data-id': value.uuid, 'data-name': value.user_id});
                    $('#notification-approve').attr({'data-id': value.uuid, 'data-name': value.user_id});

                });
            },
            error: function(error) {
                console.log(error);
            }

        });
    });
});
// ajax view shares in notification

// reject and approve shares ajax request
$(document).ready(function() {
    $('#notification-reject').on('click', function() {
        let share_id = $(this).data('id');
        let user_id = $(this).data('name');
        let reason = $('#reason').val();

        if(reason === '') {
            $('.reject-share-errors').css('display', 'block');
            $('#reason').css('border', '1px solid red');
            return false;
        }else{

            $('.reject-share-errors').css('display', 'none');
            $('#reason').css('border', '1px solid #ced4da');
        }

        $.ajax({
            method: 'POST',
            url: '/admin/reject_share',
            data:{
                share_id: share_id,
                user_id: user_id,
                reason: reason,
            },
            success: function(response) {
                if(response.status === 'success') {
                    $('#notificationsModalReport').modal('hide');
                    updateRejectShares(share_id, user_id);
                    $('#reason').val('');
                    $('#displayShareNotifications').empty();
                    displaySingleShare();
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success(response.message);

                }
            },

            error: function(error) {
                console.log(error);
            }

        });
    });
});

function updateRejectShares(share_id, user_id) {
    $.ajax({
        url: '/admin/update_reject_shares',
        method: 'POST',
        data:{
            share_id: share_id,
            user_id: user_id,
        },
        success: function(response) {
            console.log(response);
        },
        error: function(error) {
            console.log(error);
        }

    });
}
$(document).ready(function() {
    $('#notification-approve').on('click', function() {
        let share_id = $(this).data('id');
        let user_id = $(this).data('name');
       $.ajax({
           url: '/admin/approve_share',
           method: 'POST',
           data:{
                    share_id: share_id,
                    user_id: user_id,
                },
              success: function(response) {
                  $('#notificationsModalReport').modal('hide');
                  $('#displayShareNotifications').empty();
                  displaySingleShare();
                  alertify.set('notifier','position', 'bottom-right');
                  alertify.success(response.message);
              },
                error: function(error) {
                    console.log(error);
                }

       });
    });
});

// end of reject and approve shares ajax request

$(document).ready(function() {
    displaySingleShare();
});

    function displaySingleShare(){
        $.ajax({
            url: '/admin/view_share_notification',
            method: 'GET',
            success: function(response) {
                let countAllResult = Object.keys(response).length;
                $('#notification-count').text(countAllResult);
                $.each(response, function(key, value) {
                    let row = '<tr>' +

                        '<td>' + value.fname + ' ' + value.lname + '</td>' +
                        '<td>' + value.membership_number + '</td>' +
                        '<td>' + value.shares_on_sale + '</td>' +
                        '<td>' + 'Ksh: ' + value.total + '</td>' +
                        '<td>' +
                        '<button class="btn btn-sm btn-primary mark-as-read" data-bs-toggle="modal" data-bs-target="#notificationsModalReport" data-id="' + value.uuid + '">View</button>' +
                        '</td>' +
                        '</tr>'

                    $('#notificationTable tbody').append(row);
                });

            },
            error: function(error) {
                console.log(error);
            }
        });
    }


// end

$(document).ready(function() {

    $(document).on('click', '.view-btn', function() {
        var data_id = $(this).data('id');
        $.ajax({
            method: 'POST',
            url: 'reports/view',
            data:{
                report_id: data_id,
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    $('#seller-name').text(value[0].seller_fname + ' ' + value[0].seller_lname);
                    $('#buyer-name').text(value[0].buyer_fname + ' ' + value[0].buyer_lname);
                    $('#shares-sold').text(value[0].shares_on_sale);
                    $('#share-value').text(value[0].total);
                    $('#amount').text(value[0].amount);
                    $('#mpesaReceiptNumber').text(value[0].mpesaReceiptNumber);
                    $('#date').text(value[0].transactionDate);
                });
        }
    });
    });

});

// approve shares ajax request
$(document).ready(function() {
    $(document).on('click', '.approve-share', function() {
        var share_id = $(this).data('id');
        $.ajax({
            method: 'POST',
            url: 'manage_shares/approve',
            data:{
                share_id: share_id,
            },
            success: function(response) {
                alertify.set('notifier','position', 'bottom-right');
                alertify.success(response.status);
        }
    });
    });
});

// js for the admin file upload
document.querySelectorAll(".drop-zone--input").forEach(element => {
    const dropZoneElement = element.closest(".drop-zone");
    dropZoneElement.addEventListener("click", e => {
        element.click();
    });
    element.addEventListener("change", e => {
        if(element.files.length){
            updateThumbnail(dropZoneElement, element.files[0])
        }
    })
    dropZoneElement.addEventListener("dragover", e => {
        e.preventDefault();
        dropZoneElement.classList.add("drop-zone--over");
    });
    ["dragleave", "dragend"].forEach(type =>{
        dropZoneElement.addEventListener(type, e =>{
            dropZoneElement.classList.remove("drop-zone--over")
        });
    });
    dropZoneElement.addEventListener("drop", e =>{
        e.preventDefault();
        if(e.dataTransfer.files.length > 1){
            return false;
        }else{
            element.files = e.dataTransfer.files;
            updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
        }
        dropZoneElement.classList.remove("drop-zone--over");
    })
});

function updateThumbnail(dropZoneElement, file){
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumbnail");
    if(dropZoneElement.querySelector(".drop-zone__prompt")){
        dropZoneElement.querySelector(".drop-zone__prompt").remove();
    }
    if(!thumbnailElement){
        thumbnailElement = document.createElement("div");
        thumbnailElement.classList.add("drop-zone__thumb");
        dropZoneElement.appendChild(thumbnailElement);

    }
    thumbnailElement.dataset.label = file.name;
    if(file.type.startsWith("image")){
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => {
            thumbnailElement.style.backgroundImage = `url('${reader.result}')`
        }

    }else{
        thumbnailElement.style.backgroundImage = null;
    }
}


// chart js for the admin page
document.addEventListener('DOMContentLoaded', function() {
    const adminCtx = document.getElementById('adminChart').getContext('2d');
    if(adminCtx){
        const adminChart = new Chart(adminCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Match', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Transaction history',
                    data: [12, 19, 3, 5, 6, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    fill: false,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    }
});


// displaying create shares more details form
const displayCreateSharesForm = document.getElementById('selectMemberName');
displayCreateSharesForm.addEventListener('change', function() {
    const display = document.getElementById('display-share-form');
    display.style.display = 'block';
}
);

const sharesAmountInput = document.querySelector('input[name="sharesAmount"]');
const costPerShareInput = document.querySelector('input[name="cost"]');
const totalCostInput = document.querySelector('input[name="total"]');

sharesAmountInput.addEventListener('change', calculateTotalCost);
costPerShareInput.addEventListener('input', calculateTotalCost);

function calculateTotalCost() {

    const sharesAmount = Number(sharesAmountInput.value);
    const costPerShare = Number(costPerShareInput.value);

    totalCostInput.value= sharesAmount * costPerShare;
}




