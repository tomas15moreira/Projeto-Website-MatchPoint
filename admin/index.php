<?php
require 'auth.php';

$total_users = $dbh->query("SELECT COUNT(*) FROM utilizadores")->fetchColumn();
$msgs_novas = $dbh->query("SELECT COUNT(*) FROM mensagens WHERE lida = 0")->fetchColumn();
$torneios_abertos = $dbh->query("SELECT COUNT(*) FROM torneios WHERE estado = 'Aberto'")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MatchPoint Admin</title>
    <link rel="short icon" href="../img/icones/pequeno_icone.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <?php include 'menu.php'; ?>

    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Visão Geral</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 uppercase font-bold tracking-wide">Utilizadores</p>
                        <p class="text-4xl font-bold text-gray-800 mt-2"><?= $total_users ?></p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                </div>
            </div>

            <a href="mensagens.php" class="block bg-white p-6 rounded-xl shadow-md border-l-4 border-yellow-500 hover:shadow-lg transition transform hover:-translate-y-1 no-underline">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 uppercase font-bold tracking-wide">Mensagens Novas</p>
                        <p class="text-4xl font-bold text-yellow-600 mt-2"><?= $msgs_novas ?></p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full text-yellow-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                </div>
                <div class="mt-4 text-xs text-blue-600 font-bold uppercase">Ver caixa de entrada →</div>
            </a>

            <a href="torneios.php" class="block bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500 hover:shadow-lg transition transform hover:-translate-y-1 no-underline">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 uppercase font-bold tracking-wide">Torneios Abertos</p>
                        <p class="text-4xl font-bold text-green-600 mt-2"><?= $torneios_abertos ?></p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8">
                            <path fill-rule="evenodd" d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.112-3.173 6.73 6.73 0 002.743-1.347 6.753 6.753 0 006.139-5.6.75.75 0 00-.585-.858 47.077 47.077 0 00-3.07-.543V2.62a.75.75 0 00-.658-.744 49.22 49.22 0 00-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 00-.657.744zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 013.16 5.337a45.6 45.6 0 012.006-.348v.262zm13.668 0c.668.121 1.335.237 2.006.348-.533 1.16-1.529 2.122-2.863 2.635.545-.974.857-2.098.857-3.294v-.262z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 text-xs text-blue-600 font-bold uppercase">Gerir estados →</div>
            </a>

        </div>
    </div>
</body>
</html>