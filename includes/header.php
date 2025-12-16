<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatchPoint</title>
    <link rel="short icon" href="img/icones/pequeno_icone.png">
    
    <link rel="stylesheet" href="css/comum.css">
    
    <script src="js/tailwind3.4.17.js"></script>
    
    <script src="js/nav.js" defer></script>
    <script src="js/slider.js" defer></script>

    <style>
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700 !important; 
        }
        
        strong, b {
            font-weight: 700 !important;
        }

        .prose h2, .prose h3 {
            margin-top: 1.5em;
            margin-bottom: 0.5em;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">

    <header class="bg-white relative z-50 w-full flex justify-between items-center px-6 md:px-10 py-4 shadow-sm">
        
        <a href="index.php" class="logo flex-shrink-0">
            <img src="img/icones/Logotipo.png" alt="MatchPoint Logo" class="h-10 md:h-12 w-auto">
        </a>
        
        <button class="hamburger-btn md:hidden p-2 text-gray-700" id="hamburger-toggle" aria-label="Abrir menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>

        <nav id="main-nav" class="hidden md:flex items-center gap-8">
            <a class="menu-item text-gray-700 font-bold hover:text-green-600 transition" href="torneios.php">Torneios</a>
            <a class="menu-item text-gray-700 font-bold hover:text-green-600 transition" href="blog.php">Blog</a>
            <a class="menu-item text-gray-700 font-bold hover:text-green-600 transition" href="contactos.php">Contactos</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                
                <div class="flex items-center gap-4">
                    <a href="perfil.php" class="text-green-600 font-bold no-underline flex items-center gap-0 hover:text-green-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Perfil
                    </a>
                    <a href="logout.php" class="text-red-500 font-bold hover:text-red-700 no-underline text-sm border border-red-200 px-3 py-1 rounded-full hover:bg-red-50 transition">
                        Sair
                    </a>
                </div>

            <?php else: ?>

                <a class="menu-item text-gray-700 font-bold hover:text-green-600 transition" href="login.php">Login</a>
                
                <a class="btn-registar bg-blue-700 text-white font-bold py-2 px-6 rounded-md hover:bg-blue-800 transition shadow-md" href="registar.php">
                    Registar
                </a>

            <?php endif; ?>
        </nav>

        <nav id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white shadow-xl border-t border-gray-100 z-40 flex flex-col p-6 space-y-4 text-center md:hidden">
            <a class="text-gray-700 font-bold text-xl py-2 border-b border-gray-100 hover:text-green-600 no-underline" href="torneios.php">Torneios</a>
            <a class="text-gray-700 font-bold text-xl py-2 border-b border-gray-100 hover:text-green-600 no-underline" href="blog.php">Blog</a>
            <a class="text-gray-700 font-bold text-xl py-2 border-b border-gray-100 hover:text-green-600 no-underline" href="contactos.php">Contactos</a>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="text-green-600 font-bold text-xl py-2 border-b border-gray-100 no-underline flex items-center justify-center gap-0" href="perfil.php">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Perfil
                </a>
                <a class="text-red-500 font-bold text-xl py-2 no-underline" href="logout.php">Sair</a>
            <?php else: ?>
                <a class="text-gray-700 font-bold text-xl py-2 border-b border-gray-100 hover:text-green-600 no-underline" href="login.php">Login</a>
                <a class="bg-blue-700 text-white font-bold py-3 rounded hover:bg-blue-800 shadow-md block mx-4 mt-2 no-underline" href="registar.php">
                    Registar
                </a>
            <?php endif; ?>
        </nav>

    </header>