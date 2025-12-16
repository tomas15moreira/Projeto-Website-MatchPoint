<?php
require 'auth.php';

if (isset($_GET['marcar_lida'])) {
    $id = intval($_GET['marcar_lida']);
    
    $stmt = $dbh->prepare("UPDATE mensagens SET lida = 1 WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: mensagens.php"); 
    exit;
}


$sql = "SELECT * FROM mensagens ORDER BY lida ASC, data_envio DESC";
$mensagens = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Mensagens - Admin</title>
    <link rel="short icon" href="../img/icones/pequeno_icone.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <?php include 'menu.php'; ?>

    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Caixa de Entrada</h2>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold border-b">
                    <tr>
                        <th class="p-4 w-24">Estado</th>
                        <th class="p-4 w-1/4">De</th>
                        <th class="p-4">Assunto / Mensagem</th>
                        <th class="p-4 w-32">Data</th>
                        <th class="p-4 w-32 text-right">Ação</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <?php foreach($mensagens as $msg): ?>
                        <tr class="border-b hover:bg-gray-50 transition <?= $msg['lida'] == 0 ? 'bg-yellow-50' : '' ?>">
                            <td class="p-4 align-top">
                                <?php if ($msg['lida'] == 0): ?>
                                    <span class="inline-block px-2 py-1 text-[10px] font-bold text-yellow-800 bg-yellow-200 rounded-full">NOVA</span>
                                <?php else: ?>
                                    <span class="inline-block px-2 py-1 text-[10px] font-bold text-green-800 bg-green-200 rounded-full">LIDA</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-4 align-top">
                                <div class="font-bold text-gray-800"><?= htmlspecialchars($msg['nome']) ?></div>
                                <div class="text-xs text-gray-500 mt-1"><?= htmlspecialchars($msg['email']) ?></div>
                            </td>
                            <td class="p-4 align-top">
                                <div class="font-bold text-gray-700 mb-1"><?= htmlspecialchars($msg['assunto']) ?></div>
                                <details class="text-gray-600">
                                    <summary class="cursor-pointer text-blue-500 text-xs hover:underline select-none">Ler mensagem completa</summary>
                                    <p class="mt-2 p-3 bg-white border border-gray-200 rounded text-gray-700 whitespace-pre-wrap shadow-sm text-left">
                                        <?= nl2br(htmlspecialchars($msg['mensagem'])) ?>
                                    </p>
                                </details>
                            </td>
                            <td class="p-4 text-gray-500 whitespace-nowrap text-xs align-top">
                                <?= date('d/m/Y', strtotime($msg['data_envio'])) ?><br>
                                <?= date('H:i', strtotime($msg['data_envio'])) ?>
                            </td>
                            <td class="p-4 text-right align-top">
                                <?php if ($msg['lida'] == 0): ?>
                                    <a href="?marcar_lida=<?= $msg['id'] ?>" class="text-green-600 hover:text-green-800 font-bold text-xs border border-green-600 hover:bg-green-50 px-3 py-1 rounded transition no-underline whitespace-nowrap inline-block">
                                        ✓ Marcar Lida
                                    </a>
                                <?php else: ?>
                                    <span class="text-gray-400 text-xs italic whitespace-nowrap">Arquivada</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <?php if (count($mensagens) == 0): ?>
                        <tr><td colspan="5" class="p-8 text-center text-gray-500">A caixa de entrada está vazia.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>