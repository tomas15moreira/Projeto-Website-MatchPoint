document.addEventListener('DOMContentLoaded', function() {
    
    const hamburgerBtn = document.getElementById('hamburger-toggle');
    const mainNav = document.getElementById('main-nav');

    if (hamburgerBtn && mainNav) {
        
        hamburgerBtn.addEventListener('click', function() {
            mainNav.classList.toggle('open');
        });
    }
});