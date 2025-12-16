<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require('includes/connection.php'); 
require('includes/header.php'); 

$sql_torneio = "SELECT * FROM torneios WHERE data_evento >= CURDATE() AND estado != 'Fechado' ORDER BY data_evento ASC LIMIT 1";
$stmt = $dbh->query($sql_torneio);
$prox_torneio = $stmt->fetch(PDO::FETCH_OBJ);


$sql_blog = "SELECT * FROM blog ORDER BY data_publicacao DESC LIMIT 3";
$stmt_blog = $dbh->query($sql_blog);
$noticias = $stmt_blog->fetchAll(PDO::FETCH_OBJ);


$sql_campos = "SELECT * FROM campos LIMIT 3";
$stmt_campos = $dbh->query($sql_campos);
$campos_destaque = $stmt_campos->fetchAll(PDO::FETCH_OBJ);
?>

<main>

    <div class="imagem_de_fundo relative h-[85vh] min-h-[600px] flex items-center justify-center overflow-hidden bg-gray-900">
        
        <img src="img/2ªimagem_campo_fontelo.jpg" alt="Campo de Ténis" id="hero-image" class="absolute inset-0 w-full h-full object-cover opacity-60 transition-opacity duration-500">  
        
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/60"></div>

        <div class="conteudo-sobreposto relative z-10 text-center px-4 max-w-5xl mx-auto box-border animate-fade-in-up">
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 drop-shadow-2xl tracking-tight leading-tight">
                    Olá, <span class="text-green-500 capitalize"><?= explode(' ', $_SESSION['nome'])[0] ?></span>!
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-10 font-light max-w-2xl mx-auto drop-shadow-md">
                    Pronto para voltar ao court? O teu próximo jogo está à distância de um clique.
                </p>
                
                <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                    <a href="localizacoes.php" class="w-full md:w-auto px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-full transition transform hover:scale-105 shadow-xl no-underline flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Localizações
                    </a>
                    
                    <a href="perfil.php" class="w-full md:w-auto px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-gray-900 transition no-underline flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        Meu Perfil
                    </a>
                </div>

            <?php else: ?>
                <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 drop-shadow-2xl tracking-tight leading-tight">
                    Joga Ténis<br><span class="text-green-500">Perto de Ti</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-10 font-light max-w-2xl mx-auto drop-shadow-md">
                    A maior comunidade de desportos de raquete em Viseu. Reserva campos, entra em torneios e evolui o teu jogo.
                </p>
                
                <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                    <a href="registar.php" class="w-full md:w-auto px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-full transition transform hover:scale-105 shadow-xl no-underline">
                        Começar Gratuitamente
                    </a>
                    <a href="localizacoes.php" class="w-full md:w-auto px-8 py-4 bg-white hover:bg-gray-100 text-gray-900 font-bold rounded-full transition no-underline flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Localizações
                    </a>
                    <a href="torneios.php" class="w-full md:w-auto px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-gray-900 transition no-underline">
                        Ver Torneios
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <?php if ($prox_torneio): ?>
    <section class="bg-gray-900 text-white py-4 shadow-lg border-b border-green-900 relative z-20">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-center gap-6">
            <div class="flex items-center gap-4">
                <div class="bg-green-600 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                        <path fill-rule="evenodd" d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.112-3.173 6.73 6.73 0 002.743-1.347 6.753 6.753 0 006.139-5.6.75.75 0 00-.585-.858 47.077 47.077 0 00-3.07-.543V2.62a.75.75 0 00-.658-.744 49.22 49.22 0 00-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 00-.657.744zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 013.16 5.337a45.6 45.6 0 012.006-.348v.262zm13.668 0c.668.121 1.335.237 2.006.348-.533 1.16-1.529 2.122-2.863 2.635.545-.974.857-2.098.857-3.294v-.262z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="text-center md:text-left">
                    <p class="text-green-400 font-bold text-xs uppercase tracking-wide">Próximo Grande Evento</p>
                    <p class="text-lg">
                        <span class="font-bold text-white"><?= htmlspecialchars($prox_torneio->nome) ?></span> 
                        <span class="text-gray-400 text-sm ml-2"><?= date('d/m/Y', strtotime($prox_torneio->data_evento)) ?> • <?= $prox_torneio->local ?></span>
                    </p>
                </div>
            </div>
            <a href="torneios.php" class="px-6 py-2 bg-white text-gray-900 font-bold rounded-lg hover:bg-gray-200 transition text-sm no-underline whitespace-nowrap">
                Garantir Lugar &rarr;
            </a>
        </div>
    </section>
    <?php endif; ?>

    <div class="bg-white py-12 shadow-sm border-b border-gray-100 relative z-10">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-3xl md:text-4xl font-bold text-green-600">15+</p>
                <p class="text-sm text-gray-500 uppercase tracking-wide font-semibold">Campos Disponíveis</p>
            </div>
            <div>
                <p class="text-3xl md:text-4xl font-bold text-green-600">500+</p>
                <p class="text-sm text-gray-500 uppercase tracking-wide font-semibold">Jogadores Ativos</p>
            </div>
            <div>
                <p class="text-3xl md:text-4xl font-bold text-green-600">50+</p>
                <p class="text-sm text-gray-500 uppercase tracking-wide font-semibold">Torneios Realizados</p>
            </div>
            <div>
                <p class="text-3xl md:text-4xl font-bold text-green-600">24/7</p>
                <p class="text-sm text-gray-500 uppercase tracking-wide font-semibold">Reservas Online</p>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-4 py-24">
        <div class="flex flex-col md:flex-row items-center gap-16">
            <div class="flex-1 relative group">
                <div class="absolute -inset-4 bg-green-100 rounded-2xl transform rotate-3 group-hover:rotate-0 transition duration-500"></div>
                <img src="img/Campos_fontelo.jpg" alt="Jogador de ténis" class="relative w-full rounded-xl shadow-2xl transform group-hover:-translate-y-2 transition duration-500 object-cover h-[400px]">
            </div>
            
            <div class="flex-1">
                <span class="text-green-600 font-bold uppercase text-sm tracking-wider">Sobre Nós</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 mt-2">O que é o MatchPoint?</h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                    O MatchPoint é uma plataforma para jogadores e clubes de desportos de raquete em Viseu. Ajudamos-te a encontrar campos, a ligar-te a outros jogadores e a focar-te no mais importante: <span class="font-semibold text-green-700">desfrutar do jogo</span>.
                </p>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-gray-700 text-lg"><svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Reservas em tempo real</li>
                    <li class="flex items-center text-gray-700 text-lg"><svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Organização de torneios</li>
                    <li class="flex items-center text-gray-700 text-lg"><svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Blog e Dicas</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-green-600 font-bold uppercase text-sm tracking-wider">Onde Jogar</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Campos em Destaque</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($campos_destaque as $campo): ?>
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-2 transition duration-300 group flex flex-col h-full">
                    <div class="h-64 overflow-hidden relative">
                        <a href="detalhe_campo.php?id=<?= $campo->id ?>">
                            <img src="<?= $campo->imagem_hero ?>" alt="<?= $campo->nome ?>" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        </a>
                        <div class="absolute top-4 right-4 bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                            <?= $campo->preco_por_hora > 0 ? $campo->preco_por_hora . '€/h' : 'Grátis' ?>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col flex-grow">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition">
                            <a href="detalhe_campo.php?id=<?= $campo->id ?>" class="no-underline text-gray-900 hover:text-green-600">
                                <?= $campo->nome ?>
                            </a>
                        </h3>
                        <p class="text-gray-500 flex items-center text-base mb-6">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <?= $campo->subtitulo ?>
                        </p>
                        <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center gap-4">
                            <a href="marcar_campo.php?campo_id=<?= $campo->id ?>" class="flex-1 text-center py-2 bg-green-600 text-white font-bold rounded hover:bg-green-700 transition no-underline">
                                Reservar
                            </a>
                            <a href="detalhe_campo.php?id=<?= $campo->id ?>" class="flex-1 text-center py-2 border border-gray-300 text-gray-600 font-bold rounded hover:border-green-600 hover:text-green-600 transition no-underline">
                                Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <span class="text-green-600 font-bold uppercase text-sm tracking-wider">Blog</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Últimas Novidades</h2>
                </div>
                <a href="blog.php" class="hidden md:inline-flex items-center text-green-600 font-bold hover:text-green-700 no-underline">
                    Ver todo o blog <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach($noticias as $post): ?>
                <article class="flex flex-col group cursor-pointer" onclick="window.location.href='artigo.php?id=<?= $post->id ?>'">
                    <div class="rounded-xl overflow-hidden mb-4 h-56 relative shadow-md">
                        <img src="<?= $post->imagem ?>" alt="<?= $post->titulo ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="flex items-center gap-2 mb-2 text-xs">
                        <span class="bg-green-100 text-green-800 font-bold px-2 py-1 rounded uppercase"><?= $post->categoria ?></span>
                        <span class="text-gray-400"><?= date('d M', strtotime($post->data_publicacao)) ?></span>
                    </div>
                    <h3 class="font-bold text-xl text-gray-900 group-hover:text-green-600 transition mb-2">
                        <?= $post->titulo ?>
                    </h3>
                    <p class="text-gray-500 text-sm line-clamp-2">
                        <?= strip_tags($post->resumo) ?>
                    </p>
                </article>
                <?php endforeach; ?>
            </div>
            
            <div class="mt-8 text-center md:hidden">
                <a href="blog.php" class="inline-block px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-bold hover:border-green-600 hover:text-green-600 transition no-underline">
                    Ver todo o blog
                </a>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-900 text-white text-center px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="relative z-10 max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">Pronto para entrar em campo?</h2>
            <p class="text-gray-300 text-lg mb-10">Junta-te a centenas de jogadores em Viseu. Regista-te hoje e marca o teu primeiro jogo.</p>
            
            <?php if(!isset($_SESSION['user_id'])): ?>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="registar.php" class="bg-green-600 text-white font-bold py-4 px-8 rounded-full hover:bg-green-700 transition shadow-lg text-lg no-underline">
                        Criar Conta 
                    </a>
                    <a href="torneios.php" class="bg-transparent border-2 border-white text-white font-bold py-4 px-8 rounded-full hover:bg-white hover:text-gray-900 transition text-lg no-underline">
                        Ver Torneios
                    </a>
                </div>
            <?php else: ?>
                <p class="text-green-400 font-bold text-xl mb-6">Já fazes parte da equipa! 🎾</p>
                <a href="marcar_campo.php" class="inline-block bg-white text-gray-900 font-bold py-4 px-8 rounded-full hover:bg-gray-100 transition shadow-lg text-lg no-underline">
                    Marcar Jogo Agora
                </a>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php require('includes/footer.php'); ?>