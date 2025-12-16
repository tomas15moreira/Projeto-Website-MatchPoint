<?php
require 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['novo_estado'])) {
    $id = intval($_POST['torneio_id']);
    $estado = $_POST['novo_estado'];
    
    
    $stmt = $dbh->prepare("UPDATE torneios SET estado = ? WHERE id = ?");
    $stmt->execute([$estado, $id]);
    
    header("Location: torneios.php");
    exit;
}


$torneios = $dbh->query("SELECT * FROM torneios ORDER BY data_evento DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Torneios - Admin</title>
    <link rel="short icon" href="../img/icones/pequeno_icone.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <?php include 'menu.php'; ?>

    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Gestão de Torneios</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($torneios as $t): ?>
                
                <?php 
                    $borderClass = 'border-gray-300';
                    $bgStatus = 'bg-gray-200 text-gray-600';
                    
                    if($t['estado'] == 'Aberto') {
                        $borderClass = 'border-green-500';
                        $bgStatus = 'bg-green-100 text-green-800';
                    } elseif($t['estado'] == 'Decorrer') {
                        $borderClass = 'border-blue-500';
                        $bgStatus = 'bg-blue-100 text-blue-800';
                    } elseif($t['estado'] == 'Terminado') {
                        $borderClass = 'border-red-500';
                        $bgStatus = 'bg-red-100 text-red-800';
                    }
                ?>

                <div class="bg-white rounded-lg shadow-sm p-5 border-t-4 <?= $borderClass ?>">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="font-bold text-lg text-gray-800 leading-tight"><?= htmlspecialchars($t['nome']) ?></h3>
                        <span class="text-xs font-bold px-2 py-1 rounded uppercase <?= $bgStatus ?>">
                            <?= $t['estado'] ?>
                        </span>
                    </div>
                    
                    <div class="text-sm text-gray-600 mb-4 space-y-1">
                        <p><span class="font-bold">Data:</span> <?= date('d/m/Y', strtotime($t['data_evento'])) ?> às <?= date('H:i', strtotime($t['hora'])) ?></p>
                        <p><span class="font-bold">Local:</span> <?= htmlspecialchars($t['local']) ?></p>
                        <p><span class="font-bold">Nível:</span> <?= htmlspecialchars($t['nivel']) ?></p>
                    </div>

                    <form method="POST" class="bg-gray-50 p-3 rounded border border-gray-200">
                        <input type="hidden" name="torneio_id" value="<?= $t['id'] ?>">
                        <label class="block text-[10px] font-bold text-gray-500 mb-1 uppercase tracking-wide">Alterar Estado:</label>
                        <div class="flex gap-2">
                            <select name="novo_estado" class="flex-1 text-sm border-gray-300 rounded p-1 border focus:border-blue-500 focus:outline-none bg-white">
                                <option value="Aberto" <?= $t['estado'] == 'Aberto' ? 'selected' : '' ?>>🟢 Aberto</option>
                                <option value="Decorrer" <?= $t['estado'] == 'Decorrer' ? 'selected' : '' ?>>🔵 A Decorrer</option>
                                <option value="Terminado" <?= $t['estado'] == 'Terminado' ? 'selected' : '' ?>>🔴 Terminado</option>
                            </select>
                            <button type="submit" class="bg-gray-800 text-white text-sm px-3 py-1 rounded hover:bg-black transition font-medium cursor-pointer">OK</button>
                        </div>
                    </form>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>