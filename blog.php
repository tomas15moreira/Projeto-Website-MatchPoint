<?php 
require('includes/connection.php'); 
require('includes/header.php'); 

$sql = "SELECT * FROM blog ORDER BY data_publicacao DESC";
$stmt = $dbh->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

$destaque = null;
$grelha = [];

if (count($posts) > 0) {
    $destaque = $posts[0]; 
    $grelha = array_slice($posts, 1);
}
?>

<main class="max-w-7xl mx-auto px-4 py-10">
    
    <div class="text-center mb-12">
        <h1 class="text-4xl text-gray-800 mb-4 font-bold">Blog MatchPoint</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Notícias, dicas de treino e histórias da nossa comunidade de ténis.
        </p>
    </div>

    <?php if ($destaque): ?>
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-16 hover:shadow-xl transition duration-300">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="h-64 md:h-auto relative">
                <img src="<?= htmlspecialchars($destaque->imagem) ?>" alt="Destaque" class="absolute inset-0 w-full h-full object-cover">
            </div>
            <div class="p-8 md:p-12 flex flex-col justify-center">
                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded uppercase">
                        <?= htmlspecialchars($destaque->categoria) ?>
                    </span>
                    <span class="text-gray-400 text-sm">
                        <?= date('d M, Y', strtotime($destaque->data_publicacao)) ?>
                    </span>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4"><?= htmlspecialchars($destaque->titulo) ?></h2>
                <p class="text-gray-600 mb-6 text-lg line-clamp-3">
                    <?= htmlspecialchars($destaque->resumo) ?>
                </p>
                <a href="artigo.php?id=<?= $destaque->id ?>" class="inline-flex items-center text-green-600 font-bold hover:text-green-700 transition no-underline">
                    Ler artigo completo 
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <?php foreach($grelha as $post): ?>
        <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition flex flex-col">
            <div class="h-48 overflow-hidden">
                <img src="<?= htmlspecialchars($post->imagem) ?>" alt="Imagem" class="w-full h-full object-cover hover:scale-105 transition duration-500">
            </div>
            <div class="p-6 flex-1 flex flex-col">
                <div class="text-sm text-green-600 font-bold mb-2"><?= htmlspecialchars($post->categoria) ?></div>
                <h3 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($post->titulo) ?></h3>
                <p class="text-gray-600 text-sm mb-4 flex-1 line-clamp-3">
                    <?= htmlspecialchars($post->resumo) ?>
                </p>
                <a href="artigo.php?id=<?= $post->id ?>" class="text-sm font-bold text-gray-900 hover:text-green-600 transition no-underline">
                    Ler mais &rarr;
                </a>
            </div>
        </article>
        <?php endforeach; ?>

    </div>

    <div class="mt-20 bg-gray-900 rounded-2xl p-8 md:p-12 text-center relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Não percas nenhuma novidade</h2>
            <p class="text-gray-400 mb-8">Recebe as últimas notícias sobre torneios e dicas exclusivas diretamente no teu email.</p>
            
            <form id="form-newsletter" class="max-w-md mx-auto flex gap-2">
                <input type="email" id="news_email" placeholder="O teu email" class="flex-1 px-4 py-3 rounded-lg border-none outline-none focus:ring-2 focus:ring-green-500 text-gray-900" required>
                <button type="submit" class="px-6 py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition disabled:opacity-50">
                    Subscrever
                </button>
            </form>

            <p id="news_feedback" class="text-sm mt-4 font-bold hidden"></p>
        </div>
    </div>

    <script src="js/blog.js"></script>

</main>

<?php require('includes/footer.php'); ?>