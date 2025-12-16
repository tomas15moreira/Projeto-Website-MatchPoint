<?php 
require('includes/connection.php'); 

if(isset($_GET['id'])){
    $campoId = $_GET['id'];
} else {
    header('Location: localizações.php');
    exit;
}

$sql = 'SELECT * FROM campos WHERE id = :id';
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $campoId);
$stmt->execute();

if(!$stmt || $stmt->rowCount() != 1){
    header('Location: localizações.php');
    exit;
}

$campo = $stmt->fetchObject();

require('includes/header.php'); 
?>

    <link rel="stylesheet" href="css/detalhe.css">
    <link rel="stylesheet" href="css/detalhes_campos.css">

    <section class="hero-detalhes relative h-[400px] md:h-[500px] flex items-end pb-24 bg-cover bg-center" style="background-image: url('<?= $campo->imagem_hero ?>');">
        
        <div class="absolute inset-0 bg-black/50"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 w-full flex flex-col items-start">
            <h1 class="text-4xl md:text-5xl font-bold text-white drop-shadow-lg text-left">
                <?= $campo->nome ?>
            </h1>
            <p class="text-gray-200 text-lg mt-2 max-w-2xl drop-shadow-md">
                <?= $campo->subtitulo ?>
            </p>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-4 pb-16 -mt-16 relative z-20">
        
        <div class="mb-4">
            <a href="localizacoes.php" class="inline-flex items-center text-white hover:text-green-400 font-bold transition text-sm bg-black/60 hover:bg-black/80 px-4 py-2 rounded-full backdrop-blur-sm shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="m15 18-6-6 6-6"/></svg>
                Voltar aos Campos
            </a>
        </div>

        <div class="discover-container bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

            <section class="discover-description p-8 lg:p-12">
                
                <p class="text-gray-600 leading-relaxed mb-8 text-lg">
                    <?= $campo->descricao_principal ?>
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <div class="bg-green-50 p-5 rounded-xl border border-green-100">
                        <h3 class="flex items-center text-green-800 font-bold mb-3">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            Infraestruturas
                        </h3>
                        <ul class="text-sm text-green-700 space-y-2">
                            <?= $campo->infraestruturas_html ?>
                        </ul>
                    </div>

                    <div class="bg-blue-50 p-5 rounded-xl border border-blue-100">
                        <h3 class="flex items-center text-blue-800 font-bold mb-3">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                            Dimensões
                        </h3>
                        <p class="text-sm text-blue-700 leading-relaxed">
                            <?= $campo->dimensoes_texto ?>
                        </p>
                    </div>
                </div>
                
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Localização no Mapa
                    </h3>
                    
                    <div class="relative w-full h-64 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                        <iframe src="<?= $campo->mapa_src ?>"
                            class="absolute inset-0 w-full h-full border-0" 
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    
                    <div class="mt-4 text-sm text-gray-500 space-y-1">
                        <?= $campo->coordenadas_html ?>
                    </div>
                </div>
                
                <div class="mt-10 border-t border-gray-100 pt-8">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-6">
                        <div class="flex items-center gap-2 text-sm text-gray-600 bg-gray-50 p-3 rounded-lg w-full">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span><?= $campo->horario_texto ?></span>
                        </div>
                    </div>

                    <a href="marcar_campo.php?campo_id=<?= $campo->id ?>" class="btn-marcar block w-full text-center bg-green-600 text-white font-bold py-4 rounded-xl hover:bg-green-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1 text-lg uppercase tracking-wide">
                        Marcar Campo Agora
                    </a>
                </div>
                
            </section>

        </div>

    </main>

<?php require('includes/footer.php'); ?>