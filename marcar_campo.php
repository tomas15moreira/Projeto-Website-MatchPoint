<?php 
session_start();
require('includes/connection.php'); 
require('includes/header.php'); 

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php?aviso=1");
    exit;
}

$campo_selecionado_id = isset($_GET['campo_id']) ? $_GET['campo_id'] : null;

$sql = "SELECT * FROM campos";
$stmt = $dbh->query($sql);
$campos = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<main class="max-w-7xl mx-auto px-4 py-10">

    <div class="text-center mb-12">
        <h1 class="text-4xl text-gray-800 mb-4 font-bold">Marcar Campo</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Escolhe o teu clube favorito, define a duração e entra em campo.
        </p>
    </div>

    <form id="form-reserva" action="trataMarcacao.php" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            
            <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="bg-green-100 text-green-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                    Onde e quanto tempo?
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Campo</label>
                        <select name="campo_id" id="campo_select" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 outline-none bg-white cursor-pointer">
                            <?php foreach($campos as $campo): ?>
                                <option value="<?= $campo->id ?>" 
                                        data-img="<?= $campo->imagem_hero ?>" 
                                        data-local="<?= htmlspecialchars($campo->subtitulo) ?>" 
                                        data-preco="<?= $campo->preco_por_hora ?>" 
                                        data-fecho="<?= $campo->fecho ?>" 
                                        <?= ($campo_selecionado_id == $campo->id) ? 'selected' : '' ?>>
                                    <?= $campo->nome ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Duração</label>
                        <select name="duracao" id="duracao_select" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 outline-none bg-white cursor-pointer">
                            <option value="1">1 Hora</option>
                            <option value="2">2 Horas</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="bg-green-100 text-green-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">2</span>
                    Quando?
                </h2>

                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Data do Jogo</label>
                    <input type="date" name="data_jogo" id="data_jogo" min="<?= date('Y-m-d') ?>" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 outline-none text-gray-700 cursor-pointer" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Horário de Início</label>
                    
                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3" id="time-grid">
                        <?php 
                        $start = 8; $end = 22; 
                        for($h = $start; $h <= $end; $h++): 
                            $horaFormatada = sprintf("%02d:00", $h);
                        ?>
                            <button type="button" class="time-slot py-2 px-4 rounded-lg border border-gray-200 text-gray-600 bg-white hover:bg-green-50 hover:border-green-500 hover:text-green-700 transition text-sm font-bold" 
                                    data-time="<?= $horaFormatada ?>" 
                                    data-hora-int="<?= $h ?>">
                                <?= $horaFormatada ?>
                            </button>
                        <?php endfor; ?>
                    </div>
                    
                    <p id="time-error-message" class="text-red-500 text-sm font-bold mt-3 hidden flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span id="error-text">Horário inválido.</span>
                    </p>

                    <input type="hidden" name="hora_inicio" id="selected_time" required>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-2xl shadow-xl border border-green-100 sticky top-24">
                
                <div class="aspect-video rounded-xl overflow-hidden mb-6 relative bg-gray-100">
                    <img id="resumo_img" src="" alt="Campo" class="w-full h-full object-cover">
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-1" id="resumo_nome">--</h3>
                <p class="text-sm text-gray-500 mb-6 line-clamp-2" id="resumo_local">--</p>

                <div class="space-y-3 border-t border-gray-100 pt-4 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Data</span>
                        <span class="font-bold text-gray-900" id="resumo_data_display">--/--/----</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Início</span>
                        <span class="font-bold text-gray-900" id="resumo_hora">--:--</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Duração</span>
                        <span class="font-bold text-gray-900" id="resumo_duracao">1 Hora</span>
                    </div>
                </div>

                <div class="flex justify-between items-center border-t border-gray-100 pt-4 mb-8">
                    <span class="text-lg font-bold text-gray-800">Total</span>
                    <span class="text-2xl font-bold text-green-600" id="resumo_preco">--€</span>
                </div>

                <button type="submit" class="w-full bg-green-600 text-white font-bold h-14 rounded-xl hover:bg-green-700 transition shadow-lg text-lg flex items-center justify-center">
                    Confirmar Reserva
                </button>
                
                <p id="submit-error-message" class="text-red-500 text-xs font-bold text-center mt-4 hidden">
                    Por favor, selecione um horário válido.
                </p>

                <p class="text-xs text-gray-400 text-center mt-4" id="msg_pagamento">
                    Pagamento realizado no local.
                </p>
            </div>
        </div>

    </form>

</main>

<script src="js/marcar_campo.js" defer></script>

<?php require('includes/footer.php'); ?>