function toggleFavorito(campoId, btn) {

    if (typeof isLoggedIn !== 'undefined' && !isLoggedIn) {
        window.location.href = 'login.php?aviso=1';
        return;
    }

    const svg = btn.querySelector('svg');
    
    btn.style.transform = "scale(0.8)";
    setTimeout(() => btn.style.transform = "scale(1)", 200);

    const formData = new FormData();
    formData.append('campo_id', campoId);

    fetch('ajax/toggle_favorito.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'added') {
            svg.classList.remove('text-white', 'stroke-2');
            svg.classList.add('text-red-500', 'fill-current');
            svg.setAttribute('fill', 'currentColor');
        } else if (data.status === 'removed') {
            svg.classList.remove('text-red-500', 'fill-current');
            svg.classList.add('text-white', 'stroke-2');
            svg.setAttribute('fill', 'none');
        }
    })
    .catch(err => {
        console.error('Erro ao atualizar favorito:', err);
        alert('Erro de ligação. Tenta novamente.');
    });
}