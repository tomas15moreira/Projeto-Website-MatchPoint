// Ficheiro: js/nav.js

document.addEventListener('DOMContentLoaded', function() {
    
    const hamburgerBtn = document.getElementById('hamburger-toggle');
    const mainNav = document.getElementById('main-nav');

    // Verifica se os dois elementos existem na página
    if (hamburgerBtn && mainNav) {
        
        // Quando o botão é clicado...
        hamburgerBtn.addEventListener('click', function() {
            // ...alterna a classe 'open' no menu
            mainNav.classList.toggle('open');
        });
    }
});