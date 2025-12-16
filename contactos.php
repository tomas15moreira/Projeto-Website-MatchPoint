<?php 
require('includes/connection.php'); 
require('includes/header.php'); 
?>

<main class="max-w-7xl mx-auto px-4 py-10">

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'enviada'): ?>
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded shadow-sm flex justify-between items-center animate-fade-in-down">
            <div class="flex items-center">
                <span class="text-green-500 text-xl mr-2">📩</span>
                <div>
                    <p class="text-sm text-green-700 font-bold">Mensagem enviada!</p>
                    <p class="text-xs text-green-600">Obrigado pelo contacto. Responderemos o mais breve possível.</p>
                </div>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">✕</button>
        </div>
    <?php endif; ?>

    <div class="text-center mb-12">
        <h1 class="text-4xl text-gray-800 mb-4 font-bold">Fala Connosco</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Tens dúvidas sobre os torneios, aluguer de campos ou o perfil? Estamos aqui para ajudar.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

        <div class="space-y-8">
            
            <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100">
                <h3 class="text-xl font-bold text-gray-800 mb-6">Onde estamos</h3>
                
                <div class="flex items-start gap-4 mb-6">
                    <div class="bg-green-100 p-3 rounded-full text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Complexo Desportivo do Fontelo</h4>
                        <p class="text-gray-600 text-sm">Av. José Relvas, 3500-000 Viseu</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 mb-6">
                    <div class="bg-green-100 p-3 rounded-full text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Email</h4>
                        <p class="text-gray-600 text-sm">geral@matchpoint.pt</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 mb-6">
                    <div class="bg-green-100 p-3 rounded-full text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Telefone</h4>
                        <p class="text-gray-600 text-sm">+351 912 345 678</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="bg-green-100 p-3 rounded-full text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Redes Sociais</h4>
                        <div class="flex gap-4 mt-2">
                            <a href="#" class="text-gray-400 hover:text-pink-600 transition" title="Instagram">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-blue-600 transition" title="Facebook">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="rounded-2xl overflow-hidden shadow-md h-64 border border-gray-100">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3029.654854378906!2d-7.915012684598555!3d40.66755497933664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd23364eb8355555%3A0x6ad4259333555555!2sFontelo%2C%20Viseu!5e0!3m2!1spt-PT!2spt!4v1638200000000!5m2!1spt-PT!2spt" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

        </div>

        <div class="bg-white p-8 rounded-2xl shadow-lg border border-green-100">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Envia-nos uma mensagem</h3>
            
            <form action="trataContacto.php" method="POST" class="space-y-6">
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nome Completo</label>
                    <input type="text" name="nome" value="<?= isset($_SESSION['nome']) ? $_SESSION['nome'] : '' ?>" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 outline-none transition bg-gray-50 focus:bg-white" required placeholder="O teu nome">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 outline-none transition bg-gray-50 focus:bg-white" required placeholder="exemplo@email.com">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Assunto</label>
                    <select name="assunto" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 outline-none transition bg-gray-50 focus:bg-white cursor-pointer">
                        <option value="Informações Gerais">Informações Gerais</option>
                        <option value="Dúvidas Torneios">Dúvidas sobre Torneios</option>
                        <option value="Problemas Técnicos">Problemas Técnicos</option>
                        <option value="Parcerias">Sugestão de Court</option>
                        <option value="Outro">Outro Assunto</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Mensagem</label>
                    <textarea name="mensagem" rows="5" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-green-500 outline-none transition bg-gray-50 focus:bg-white resize-none" required placeholder="Como podemos ajudar?"></textarea>
                </div>

                <button type="submit" class="w-full bg-green-600 text-white font-bold py-4 rounded-xl hover:bg-green-700 transition shadow-lg flex items-center justify-center gap-2">
                    <span>Enviar Mensagem</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>

            </form>
        </div>

    </div>

</main>

<?php require('includes/footer.php'); ?>