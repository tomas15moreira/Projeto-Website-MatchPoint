

// 1. Define aqui a lista das imagens
const listaImagens = [
    'img/2ªimagem_campo_fontelo.jpg', 
    'img/foto_fundo.jpg',         
    'img/campos_tenis_Viseu.jpg',     
    'img/2ªimagem de fundo.jpg',
    'img/3ªimagem de fundo.jpg'     
];

// 2. Define o tempo de espera
const tempoTroca = 4000; // 5 segundos

// --- Lógica do slider ---
const imgElement = document.getElementById('hero-image');
let indexAtual = 0;

// 4. Verifica se a imagem existe mesmo (só por segurança)
if (imgElement) {
    
    function trocarImagem() {
        imgElement.style.opacity = 0; // Desaparece

        setTimeout(() => {
            indexAtual = (indexAtual + 1) % listaImagens.length;
            imgElement.src = listaImagens[indexAtual];
            imgElement.style.opacity = 1; // Aparece
        }, 500); // 0.5s (tem de ser igual ao 'transition' do CSS)
    }

    // Inicia a troca
    setInterval(trocarImagem, tempoTroca);

} else {
    // Se vires isto na CONSOLA, é porque o ID no HTML está errado.
    console.error("Erro: Não encontrei o elemento com id 'hero-image'.");
}