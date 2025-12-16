function abrirModal(tipo, url) {
    const modal = document.getElementById('modal-confirmacao');
    const titulo = document.getElementById('modal-titulo');
    const texto = document.getElementById('modal-texto');
    const btn = document.getElementById('btn-confirmar-modal');
    const iconBg = document.getElementById('modal-icon-bg');
    const icon = document.getElementById('modal-icon');

    btn.href = url;

    if (tipo === 'inscrever') {
        titulo.textContent = 'Confirmar Inscrição?';
        texto.textContent = 'Garante o teu lugar neste torneio e prepara a raquete!';
        
        iconBg.className = 'rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4 bg-green-100';
        icon.className = 'h-8 w-8 text-green-600';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
        
        btn.className = 'flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 rounded-xl transition flex items-center justify-center no-underline';
        btn.textContent = 'Sim, Inscrever';

    } else if (tipo === 'cancelar') {
        titulo.textContent = 'Cancelar Inscrição?';
        texto.textContent = 'Tens a certeza? Vais perder o teu lugar e terás de te inscrever novamente.';
        
        iconBg.className = 'rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4 bg-red-100';
        icon.className = 'h-8 w-8 text-red-600';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>';
        
        btn.className = 'flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-xl transition flex items-center justify-center no-underline';
        btn.textContent = 'Sim, Cancelar';
    }

    modal.classList.remove('hidden');
}

function fecharModal() {
    document.getElementById('modal-confirmacao').classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal-confirmacao');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) fecharModal();
        });
    }
});