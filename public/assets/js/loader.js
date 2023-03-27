window.addEventListener('load', function(){
    const loader = document.querySelector('.load');
    loader.classList.add('load-hidden');

    loader.addEventListener('transitionend', function(){
        loader.classList.remove("load");
    })
})