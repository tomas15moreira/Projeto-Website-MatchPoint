<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require('includes/connection.php'); 
require('includes/header.php'); 

$stmt = $dbh->prepare("SELECT * FROM campos WHERE preco_por_hora > 0");
$stmt->execute();
$clubes = $stmt->fetchAll(PDO::FETCH_OBJ);

$stmt = $dbh->prepare("SELECT * FROM campos WHERE preco_por_hora = 0");
$stmt->execute();
$urbanos = $stmt->fetchAll(PDO::FETCH_OBJ);

$meus_favoritos = [];
if (isset($_SESSION['user_id'])) {
    $stmt_fav = $dbh->prepare("SELECT campo_id FROM favoritos WHERE user_id = ?");
    $stmt_fav->execute([$_SESSION['user_id']]);
    $meus_favoritos = $stmt_fav->fetchAll(PDO::FETCH_COLUMN);
}
?>

    <link rel="stylesheet" href="css/localizacoes.css">

    <div class="bg-white border-b border-gray-200 py-12 mb-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Encontra o Teu Campo Ideal</h1>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                Explora os melhores clubes e campos públicos em Viseu. Adiciona aos favoritos para jogares mais tarde.
            </p>
        </div>
    </div>

    <div class="main-content max-w-7xl mx-auto px-4 pb-20">

        <?php if(count($clubes) > 0): ?>
        <div class="mb-16">
            <div class="flex items-center justify-between mb-6 border-b border-gray-200 pb-4">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <span class="bg-green-100 p-2 rounded-lg flex justify-center items-center"><img src="img/icones/icone campo de tenis.png" class="h-6 w-6 object-contain"></span>
                    Clubes de Ténis
                </h2>
                <span class="text-sm text-gray-500 font-medium"><?= count($clubes) ?> Locais</span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($clubes as $campo): 
                    $isFav = in_array($campo->id, $meus_favoritos);
                    $heartClass = $isFav ? 'text-red-500 fill-current' : 'text-white stroke-2';
                ?>
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-300 group flex flex-col h-full relative">
                    <button onclick="toggleFavorito(<?= $campo->id ?>, this)" class="absolute top-4 left-4 z-20 p-2 bg-black/20 backdrop-blur-md rounded-full hover:bg-white/20 transition group-heart focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 <?= $heartClass ?> transition-colors duration-300" fill="<?= $isFav ? 'currentColor' : 'none' ?>" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>

                    <a href="detalhe_campo.php?id=<?= $campo->id ?>" class="flex flex-col h-full no-underline text-inherit">
                        <div class="h-56 relative overflow-hidden">
                            <img src="<?= htmlspecialchars($campo->imagem_hero) ?>" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-green-700 shadow-sm">Clube Oficial</div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors"><?= htmlspecialchars($campo->nome) ?></h3>
                                <p class="flex items-start gap-2 text-gray-500 text-sm mt-2">
                                    <svg class="w-4 h-4 mt-0.5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <?= htmlspecialchars($campo->subtitulo) ?>
                                </p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-100 text-sm text-gray-600 font-medium flex justify-between items-center">
                                <span>Disponível</span>
                                <span class="text-green-600 font-bold"><?= str_replace('.', ',', $campo->preco_por_hora) ?>€/h</span>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div> 
        </div>
        <?php endif; ?>

        <?php if(count($urbanos) > 0): ?>
        <div class="mb-16">
            <div class="flex items-center justify-between mb-6 border-b border-gray-200 pb-4">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <span class="bg-blue-100 p-2 rounded-lg flex justify-center items-center"><img src="img/icones/icone da localização2.png" class="h-6 w-6 object-contain"></span>
                    Campos Urbanos
                </h2>
                <span class="text-sm text-gray-500 font-medium"><?= count($urbanos) ?> Locais</span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($urbanos as $campo): 
                    $isFav = in_array($campo->id, $meus_favoritos);
                    $heartClass = $isFav ? 'text-red-500 fill-current' : 'text-white stroke-2';
                ?>
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-300 group flex flex-col h-full relative">
                    <button onclick="toggleFavorito(<?= $campo->id ?>, this)" class="absolute top-4 left-4 z-20 p-2 bg-black/20 backdrop-blur-md rounded-full hover:bg-white/20 transition focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 <?= $heartClass ?> transition-colors duration-300" fill="<?= $isFav ? 'currentColor' : 'none' ?>" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>

                    <a href="detalhe_campo.php?id=<?= $campo->id ?>" class="flex flex-col h-full no-underline text-inherit">
                        <div class="h-56 relative overflow-hidden">
                            <img src="<?= htmlspecialchars($campo->imagem_hero) ?>" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                            <div class="absolute top-4 right-4 bg-blue-600/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-white shadow-sm">Público</div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors"><?= htmlspecialchars($campo->nome) ?></h3>
                                <p class="flex items-start gap-2 text-gray-500 text-sm mt-2">
                                    <svg class="w-4 h-4 mt-0.5 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <?= htmlspecialchars($campo->subtitulo) ?>
                                </p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-100 text-sm text-gray-600 font-medium flex justify-between items-center">
                                <span>Acesso Livre</span>
                                <span class="text-blue-600 font-bold">Grátis</span>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>

                <a href="contactos.php" class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-2xl flex flex-col items-center justify-center text-center p-8 hover:border-green-500 hover:bg-green-50 transition duration-300 group h-full min-h-[350px] no-underline">
                    <div class="bg-white p-4 rounded-full shadow-sm mb-4 group-hover:scale-110 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Conheces outro?</h3>
                    <p class="text-gray-500 text-sm px-4">Ajuda a comunidade. Sugere um novo campo.</p>
                    <span class="mt-6 text-green-600 font-bold text-sm group-hover:underline">Sugerir Campo &rarr;</span>
                </a>

            </div> 
        </div>
        <?php endif; ?>

    </div> 

    <script>
        const isLoggedIn = <?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>;
    </script>
    
    <script src="js/localizacoes.js"></script>

<?php require('includes/footer.php'); ?>