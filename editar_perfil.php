<?php 
session_start();
require('includes/connection.php'); 
require('includes/header.php'); 

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id'];
$stmt = $dbh->prepare("SELECT * FROM utilizadores WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_OBJ);
?>

<main class="max-w-4xl mx-auto px-4 py-10">

    <div class="mb-8">
        <a href="perfil.php" class="text-gray-500 hover:text-green-600 font-bold flex items-center gap-2 no-underline transition">
            &larr; Voltar ao Perfil
        </a>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Editar Perfil</h1>
            <p class="text-gray-500">Atualiza os teus dados pessoais e credenciais.</p>
        </div>

        <form action="trataEditarPerfil.php" method="POST" class="space-y-6 max-w-2xl mx-auto">
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nome Completo</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($user->nome) ?>" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 outline-none transition bg-gray-50 focus:bg-white" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user->email) ?>" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 outline-none transition bg-gray-50 focus:bg-white" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">País</label>
                    <input type="text" name="pais" value="<?= htmlspecialchars($user->pais ?? '') ?>" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 outline-none transition bg-gray-50 focus:bg-white" placeholder="Portugal">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Género</label>
                    <select name="genero" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 outline-none transition bg-gray-50 focus:bg-white">
                        <option value="Masculino" <?= ($user->genero == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                        <option value="Feminino" <?= ($user->genero == 'Feminino') ? 'selected' : '' ?>>Feminino</option>
                        <option value="Outro" <?= ($user->genero == 'Outro') ? 'selected' : '' ?>>Outro</option>
                    </select>
                </div>
            </div>

            <hr class="border-gray-100 my-6">

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nova Palavra-passe</label>
                <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 outline-none transition bg-gray-50 focus:bg-white" placeholder="Deixa em branco para manter a atual">
                <p class="text-xs text-gray-400 mt-1">Só preenchas se quiseres mudar a password.</p>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white font-bold py-4 rounded-xl hover:bg-green-700 transition shadow-lg flex items-center justify-center gap-2">
                Guardar Alterações
            </button>

            <div class="mt-12 pt-8 border-t border-gray-100">
                <h3 class="text-lg font-bold text-red-600 mb-2">Zona de Perigo</h3>
                <p class="text-sm text-gray-500 mb-4">Esta ação é irreversível. Todos os teus dados, reservas e histórico serão apagados.</p>
                
                <button type="button" onclick="confirmarEliminacao()" class="text-red-500 font-bold text-sm border border-red-200 px-4 py-2 rounded-lg hover:bg-red-50 transition">
                    Eliminar Conta Definitivamente
                </button>
            </div>

        </form>

</main>

<script>
    function confirmarEliminacao() {
        if (confirm("Tens a certeza absoluta? Esta ação não pode ser desfeita e perderás todas as tuas reservas.")) {
            window.location.href = "apagar_conta.php";
        }
    }
</script>

<?php require('includes/footer.php'); ?>