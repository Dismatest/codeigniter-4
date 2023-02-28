
const checkbox = document.getElementById('terms-and-conditions');
const button = document.getElementById('terms-of-use');

button.disabled = true;
button.style.cursor = 'not-allowed';

checkbox.addEventListener('change', function() {
    if (this.checked) {
        button.disabled = false;
        button.style.cursor = 'pointer';
    } else {
        button.disabled = true;
        button.style.cursor = 'not-allowed';
    }
})




