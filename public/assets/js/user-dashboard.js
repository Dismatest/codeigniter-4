
// js for the accordion
const accordionItems = document.querySelectorAll('.my-accordion-item');

accordionItems.forEach(item => {
    const header = item.querySelector('.my-accordion-header');
    const content = item.querySelector('.my-accordion-content');
    const toggle = item.querySelector('.my-accordion-toggle');

    header.addEventListener('click', () => {
        item.classList.toggle('active');
        if (item.classList.contains('active')) {
            content.style.maxHeight = content.scrollHeight + 'px';
        } else {
            content.style.maxHeight = 0;
        }
    });

    toggle.addEventListener('click', (e) => {
        e.stopPropagation();
    });
});

//end of accordion js