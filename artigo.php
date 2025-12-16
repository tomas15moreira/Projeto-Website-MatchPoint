<?php 
require('includes/connection.php'); 
require('includes/header.php'); 

if (!isset($_GET['id'])) {
    header("Location: blog.php");
    exit;
}

$id = $_GET['id'];
$stmt = $dbh->prepare("SELECT * FROM blog WHERE id = ?");
$stmt->execute([$id]);
$artigo = $stmt->fetch(PDO::FETCH_OBJ);

if (!$artigo) {
    header("Location: blog.php");
    exit;
}
?>

<main class="max-w-4xl mx-auto px-4 py-12">
    
    <a href="blog.php" class="inline-flex items-center text-gray-500 hover:text-green-600 font-bold mb-8 transition no-underline">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Voltar ao Blog
    </a>

    <div class="text-center mb-10">
        <div class="flex justify-center items-center gap-3 mb-4">
            <span class="bg-green-100 text-green-700 text-sm font-bold px-3 py-1 rounded-full uppercase">
                <?= htmlspecialchars($artigo->categoria) ?>
            </span>
            <span class="text-gray-400 font-medium">
                <?= date('d M, Y', strtotime($artigo->data_publicacao)) ?>
            </span>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
            <?= htmlspecialchars($artigo->titulo) ?>
        </h1>
    </div>

    <div class="rounded-2xl overflow-hidden shadow-lg mb-12 h-[400px] w-full">
        <img src="<?= htmlspecialchars($artigo->imagem) ?>" alt="Capa do Artigo" class="w-full h-full object-cover">
    </div>

    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
        <?= $artigo->conteudo ?>
    </div>

    <div class="border-t border-gray-200 mt-12 pt-8 text-center">
        <p class="text-gray-500 italic">Gostaste deste artigo? Partilha com os teus parceiros de jogo!</p>
    </div>

</main>

<?php require('includes/footer.php'); ?>