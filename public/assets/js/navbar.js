window.onload = function() {
    let navigation_bar = document.querySelector('.navbar2');
    let menus_btn = document.querySelector('.menu-btn');
    let close_btn = document.querySelector('.close-btn');

    menus_btn.addEventListener('click', function () {
        navigation_bar.classList.add('active2');

    });

    close_btn.addEventListener('click', function () {
        navigation_bar.classList.remove('active2');
    });

    const navLink = window.location.pathname;
    const allNavLink = document.querySelectorAll('.navbar2 a');
    allNavLink.forEach(link =>{
        if(link.href.includes(`${navLink}`)){
            link.classList.add('active')
            console.log(`${navLink}`)
        }
    }
    )
}