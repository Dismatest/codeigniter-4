
$(document).ready(function(){
    var table = $('#dashboardDataTable').DataTable({
        buttons: ['copy', 'csv', 'pdf', 'print']
    });
    table.buttons().container().appendTo('#example');
});

//dashboard javascript code for displaying the sell shares button

const showFormButton = document.getElementById('display-sell-now-btn');
const myForm = document.getElementById('col-content-section-confirm-selling');

showFormButton.addEventListener('click', function() {
    myForm.style.display = 'block';
});

//javascript code for adding the value of the shares-on-sales-input-field and shares-for-sale-input-field


const input1 = document.getElementById("shares-for-sale-input-1");
const input2 = document.getElementById("shares-for-sale-input-2");
const result = document.getElementById("shares-on-sale-total-amount");
const totalAmount = document.getElementById("total-amount-of-shares");
const sellBtn = document.getElementById("sell-now-btn");

function updateResult() {
    result.value = String(Number(input1.value) * Number(input2.value));
    if(Number(input1.value) > Number(totalAmount.textContent)){
        input1.value = 0;
        result.value = 0;
        input1.style.border = "1px solid red";

    }

}

input1.addEventListener("input", updateResult);

