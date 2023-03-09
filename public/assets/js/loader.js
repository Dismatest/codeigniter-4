window.addEventListener('load', function(){
    const loader = document.querySelector('.load');
    loader.classList.add('load-hidden');

    loader.addEventListener('transitionend', function(){
        document.body.removeChild("load");
    })
})