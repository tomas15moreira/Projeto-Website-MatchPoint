<?php 
require('includes/connection.php'); 
require('includes/header.php'); 
?>

<main class="max-w-md mx-auto px-4 py-20">
    
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Recuperar Conta</h1>
        <p class="text-gray-600">Introduz o teu email para receberes instruções de reposição.</p>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        
        <?php if (isset($_GET['erro']) && $_GET['erro'] == 'nao_encontrado'): ?>
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm font-bold mb-6 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Email não encontrado no sistema.
            </div>
        <?php endif; ?>

        <form action="trataRecuperacao.php" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Email associado</label>
                <input type="email" name="email" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 outline-none bg-gray-50 focus:bg-white transition" placeholder="exemplo@email.com" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition shadow-md">
                Enviar Link de Recuperação
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="login.php" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition no-underline">
                &larr; Voltar ao Login
            </a>
        </div>
    </div>

</main>

<script src="js/nav.js"></script>
</body>
</html>