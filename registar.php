<?php 
require('includes/connection.php'); 
require('includes/header.php'); 
?>

    <main class="max-w-7xl mx-auto px-4 py-10">
        
        <div class="text-center mb-12">
            <div class="flex justify-center mb-4">
                <img src="img/icones/Logotipo.png" alt="MatchPoint Logotipo" class="h-24 w-auto object-contain">
            </div>
            <h1 class="text-4xl text-gray-800 mb-4 font-bold">Criar conta de jogador</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                O MatchPoint é perfeito tanto para quem está a começar a praticar desporto, como para quem procura jogar com mais frequência.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <div class="lg:col-span-2">
                <form action="trataRegisto.php" method="POST" class="space-y-8">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                            <input type="text" name="nome" class="w-full border-b-2 border-gray-300 focus:border-green-600 outline-none py-2 transition-colors" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                            <input type="email" name="email" class="w-full border-b-2 border-gray-300 focus:border-green-600 outline-none py-2 transition-colors" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Data de Nascimento</label>
                            <div class="flex gap-2">
                                <select name="birth_day" id="birth_day" class="w-1/3 border-b-2 border-gray-300 bg-white py-2 text-sm outline-none focus:border-green-600 transition-colors cursor-pointer" required>
                                    <option value="">Dia</option>
                                </select>
                                <select name="birth_month" id="birth_month" class="w-1/3 border-b-2 border-gray-300 bg-white py-2 text-sm outline-none focus:border-green-600 transition-colors cursor-pointer" required>
                                    <option value="">Mês</option>
                                </select>
                                <select name="birth_year" id="birth_year" class="w-1/3 border-b-2 border-gray-300 bg-white py-2 text-sm outline-none focus:border-green-600 transition-colors cursor-pointer" required>
                                    <option value="">Ano</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Género</label>
                            <select name="gender" class="w-full border border-gray-300 rounded p-2 bg-white outline-none focus:border-green-600">
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">País</label>
                            <select name="country" class="w-full border border-gray-300 rounded p-2 bg-white outline-none focus:border-green-600">
                                <option value="Portugal">Portugal</option>
                                <option value="Espanha">Espanha</option>
                                <option value="França">França</option>
                                <option value="Brasil">Brasil</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Palavra-passe</label>
                            <input type="password" name="password" class="w-full border-b-2 border-gray-300 focus:border-green-600 outline-none py-2 transition-colors" required>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 mt-6">
                        <input type="checkbox" id="terms" name="terms" class="w-5 h-5 border-gray-300 rounded text-green-600 focus:ring-green-600" required>
                        <label for="terms" class="text-sm text-gray-600">
                            Ao registar-se, concorda com os nossos <a href="termos.php" class="text-green-600 hover:underline">Termos de Serviço</a>
                        </label>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 mt-8">
                        <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded shadow transition uppercase text-sm flex justify-center items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            Registar
                        </button>
                    </div>

                </form>
            </div>

            <div class="lg:col-span-1 pl-0 lg:pl-8 mt-10 lg:mt-0">
                <h2 class="text-3xl text-gray-800 mb-8 font-bold">Porquê juntar-se?</h2>
                
                <div class="space-y-6">
                    <div class="flex gap-4 items-start">
                        <div class="bg-green-600 p-2 rounded text-white h-10 w-10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </div>
                        <p class="text-gray-600 text-sm pt-2">Encontra jogadores e organiza partidas.</p>
                    </div>

                    <div class="flex gap-4 items-start">
                        <div class="bg-green-600 p-2 rounded text-white h-10 w-10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <p class="text-gray-600 text-sm pt-2">Descobre locais para jogar onde quer que estejas.</p>
                    </div>

                    <div class="flex gap-4 items-start">
                        <div class="bg-green-600 p-2 rounded text-white h-10 w-10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                        </div>
                        <p class="text-gray-600 text-sm pt-2">Regista os teus resultados, acompanha o teu progresso e partilha com amigos.</p>
                    </div>
                    
                    <div class="flex gap-4 items-start">
                        <div class="bg-green-600 p-2 rounded text-white h-10 w-10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path></svg>
                        </div>
                        <p class="text-gray-600 text-sm pt-2">Inscreve-te em torneios locais e melhora a tua classificação!</p>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <script src="js/registar.js" defer></script>

<?php require('includes/footer.php'); ?>