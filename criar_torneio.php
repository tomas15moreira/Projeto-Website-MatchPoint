<?php 
session_start();
require('includes/connection.php'); 
require('includes/header.php'); 
?>

<main class="max-w-4xl mx-auto px-4 py-10">

    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800">Criar Novo Torneio</h1>
        <p class="text-gray-600">Adiciona um novo evento competitivo ao calendário.</p>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100">
        
        <form action="trataCriarTorneio.php" method="POST" enctype="multipart/form-data" class="space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nome do Torneio</label>
                    <input type="text" name="nome" class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none" required placeholder="Ex: Open de Verão">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Local / Clube</label>
                    <input type="text" name="local" class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none" required placeholder="Ex: Ténis Clube Viseu">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Data</label>
                    <input type="date" name="data_evento" min="<?= date('Y-m-d') ?>" class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Hora</label>
                    <input type="time" name="hora" class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Preço (€)</label>
                    <input type="number" name="preco" min="0" max="25" step="0.01" class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none" required placeholder="0.00">
                    <p class="text-xs text-gray-400 mt-1">Máximo permitido: 25€</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nível</label>
                    <select name="nivel" class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none bg-white">
                        <option value="Amador">Amador</option>
                        <option value="Intermédio">Intermédio</option>
                        <option value="Avançado">Avançado</option>
                        <option value="Pro">Pro</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Imagem do Cartaz</label>
                    <input type="file" name="imagem" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Descrição</label>
                <textarea name="descricao" rows="4" class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none" placeholder="Detalhes sobre o torneio..."></textarea>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-xl hover:bg-green-700 transition shadow-lg">
                Publicar Torneio
            </button>

        </form>
    </div>

</main>

<?php require('includes/footer.php'); ?>