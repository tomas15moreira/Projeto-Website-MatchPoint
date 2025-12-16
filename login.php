<?php 
require('includes/connection.php'); 
require('includes/header.php'); 
?>

    <main class="max-w-7xl mx-auto px-4 py-10">
        
        <div class="text-center mb-12">
            <div class="flex justify-center mb-4">
                <img src="img/icones/Logotipo.png" alt="MatchPoint Logotipo" class="h-24 w-auto object-contain">
            </div>
            <h1 class="text-4xl text-gray-800 mb-4 font-bold">Bem-vindo de volta</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Entre na sua conta para gerir reservas, ver resultados e conectar-se com outros jogadores.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <div class="lg:col-span-2">
                
                <?php if (isset($_GET['aviso']) && $_GET['aviso'] == 1): ?>
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r shadow-sm flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-bold text-blue-800">Login Necessário</p>
                            <p class="text-sm text-blue-700">Para efetuar uma reserva, precisas de entrar na tua conta.</p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['erro']) && $_GET['erro'] == 1): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r shadow-sm flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-bold text-red-800">Erro de Autenticação</p>
                            <p class="text-sm text-red-700">O e-mail ou a palavra-passe estão incorretos.</p>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="trataLogin.php" method="POST" class="space-y-8">
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                        <input type="email" id="email" name="email" autocomplete="email" class="w-full border-b-2 border-gray-300 focus:border-green-600 outline-none py-2 transition-colors" placeholder="exemplo@email.com" required>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Palavra-passe</label>
                        <input type="password" id="password" name="password" autocomplete="current-password" class="w-full border-b-2 border-gray-300 focus:border-green-600 outline-none py-2 transition-colors" required>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="remember" name="remember" class="w-5 h-5 border-gray-300 rounded text-green-600 focus:ring-green-600">
                            <label for="remember" class="text-sm text-gray-600">Lembrar-me</label>
                        </div>
                        <a href="#" class="text-sm text-green-600 hover:underline font-medium">Esqueceu-se da palavra-passe?</a>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 mt-8">
                        <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded shadow transition uppercase text-sm flex justify-center items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
                            Entrar
                        </button>
                    </div>

                </form>
            </div>

            <div class="lg:col-span-1 pl-0 lg:pl-8 mt-10 lg:mt-0 border-l-0 lg:border-l border-gray-200">
                <h2 class="text-3xl text-gray-800 mb-6 font-bold">Novo no MatchPoint?</h2>
                <p class="text-gray-600 mb-8">Junte-se à maior comunidade de desportos de raquete em Viseu.</p>
                
                <div class="space-y-6 mb-8">
                    <div class="flex gap-4 items-center">
                        <div class="bg-green-100 p-2 rounded-full text-green-600 h-10 w-10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                        </div>
                        <p class="text-gray-700 text-sm font-medium">Registo simples e rápido</p>
                    </div>
                    <div class="flex gap-4 items-center">
                        <div class="bg-green-100 p-2 rounded-full text-green-600 h-10 w-10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <p class="text-gray-700 text-sm font-medium">Acesso a todos os campos</p>
                    </div>
                </div>

                <a href="registar.php" class="block w-full text-center border-2 border-green-600 text-green-600 hover:bg-green-50 font-bold h-14 rounded-xl shadow transition uppercase text-sm flex justify-center items-center">
                    Criar Conta 
                </a>
            </div>

        </div>
    </main>

<?php require('includes/footer.php'); ?>