
$(document).ready(function(){
    var table = $('#dashboardDataTable').DataTable({
        buttons: ['copy', 'csv', 'pdf', 'print']
    });
    table.buttons().container().appendTo('#example');
});

document.addEventListener('DOMContentLoaded', function() {
    const termsCheckbox = document.getElementById('sell-shares-terms');
    const sellShares = document.getElementById('sell-now-btn');
    const messageError = document.getElementById('error-message-terms');
    if(sellShares){
        sellShares.addEventListener('click', (event) => {
            if (!termsCheckbox.checked) {
                event.preventDefault();
                messageError.textContent = 'Please agree with the terms and conditions';
                setTimeout(() => {
                    messageError.textContent = '';
                }, 10000);
            } else {
                messageError.textContent = '';
            }
        });
    }
});
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

// terms and conditions js
document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('terms-checkbox');
    const paymentLink = document.getElementById('payment-link');
    const errorMessages = document.getElementById('error-message');
    if(paymentLink){
        paymentLink.addEventListener('click', (event) => {
            if (!checkbox.checked) {
                event.preventDefault();
                errorMessage.textContent = 'Please agree with the terms and conditions';
                setTimeout(() => {
                    errorMessage.textContent = '';
                }, 10000);
            } else {
                errorMessages.textContent = '';
            }
        });
    }
});


//dashboard javascript code for displaying the sell shares button
const form = document.getElementById('form');
const input1 = document.getElementById("shares-for-sale-input-1");
const input2 = document.getElementById("shares-for-sale-input-2");
const result = document.getElementById("shares-on-sale-total-amount");
const totalAmount = document.getElementById("total-amount-of-shares");
const memberCommission = document.getElementById("member-commission");
const errorMessage = document.getElementById("error-message");
const errorShareEmpty = document.getElementById("error-message-share-empty");

const commission = memberCommission.value;
const totalCommission = Number(commission/100 * input1.value).toFixed(2);

function updateResult() {
    const totalShares = Number(totalAmount.textContent);
    const sharesForSale = Number(input1.value);
    const salePrice = Number(input2.value);
    const saleValue = (sharesForSale * salePrice) + Number(totalCommission);

    if (sharesForSale > totalShares) {
        errorMessage.style.display = "block";
        input1.value = 0;
        result.value = 0;
        input1.style.border = "1px solid red";
        result.style.border = "1px dashed red";
    } else {
        errorMessage.style.display = "none";
        result.value = Number(saleValue);
    }

}

function onSubmit(event) {
    if (Number(result.value) === 0) {
        event.preventDefault();
        input1.style.border = "1px solid red";
        result.style.border = "1px dashed red";
    } else {
        input1.style.border = "";
        result.style.border = "";
    }
    if(input1.value === ""){
        event.preventDefault();
        errorShareEmpty.style.display = "block";
        input1.style.border = "1px solid red";
        result.style.border = "1px dashed red";
    }
    if(input1.value === '0'){
        event.preventDefault();
        errorShareEmpty.style.display = "block";
    }
}

input1.addEventListener("input", updateResult);
form.addEventListener("submit", onSubmit);


// shares status

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

