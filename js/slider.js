const listaImagens = [
    'img/2ªimagem_campo_fontelo.jpg', 
    'img/foto_fundo.jpg',         
    'img/campos_tenis_Viseu.jpg',     
    'img/2ªimagem de fundo.jpg',
    'img/3ªimagem de fundo.jpg'     
];

const tempoTroca = 4000; 

const imgElement = document.getElementById('hero-image');
let indexAtual = 0;

if (imgElement) {
        
        function trocarImagem() {
            imgElement.style.opacity = 0; 

            setTimeout(() => {
                indexAtual = (indexAtual + 1) % listaImagens.length;
                imgElement.src = listaImagens[indexAtual];
                
                imgElement.style.opacity = 0.6; 
            }, 500); 
        }
        setInterval(trocarImagem, tempoTroca);
    }


