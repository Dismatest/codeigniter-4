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




