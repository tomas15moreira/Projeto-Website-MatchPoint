<?php 
session_start();
require('includes/connection.php'); 
require('includes/header.php'); 

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['user_id'];

$stmt = $dbh->prepare("SELECT * FROM utilizadores WHERE id = ?");
$stmt->execute([$id_user]);
$user = $stmt->fetch(PDO::FETCH_OBJ);

$sql_reservas = "SELECT r.*, c.nome as nome_campo, c.imagem_hero, c.subtitulo 
                 FROM reservas r 
                 JOIN campos c ON r.campo_id = c.id 
                 WHERE r.user_id = ? 
                 ORDER BY r.data_jogo DESC, r.hora_inicio DESC";
$stmt_res = $dbh->prepare($sql_reservas);
$stmt_res->execute([$id_user]);
$reservas = $stmt_res->fetchAll(PDO::FETCH_OBJ);

$sql_torneios = "SELECT t.*, it.data_inscricao 
                 FROM inscricoes_torneios it 
                 JOIN torneios t ON it.torneio_id = t.id 
                 WHERE it.user_id = ? 
                 ORDER BY t.data_evento ASC";
$stmt_torn = $dbh->prepare($sql_torneios);
$stmt_torn->execute([$id_user]);
$meus_torneios = $stmt_torn->fetchAll(PDO::FETCH_OBJ);


$sql_favs = "SELECT c.id, c.nome, c.imagem_hero, c.preco_por_hora 
             FROM favoritos f 
             JOIN campos c ON f.campo_id = c.id 
             WHERE f.user_id = ?";
$stmt_fav = $dbh->prepare($sql_favs);
$stmt_fav->execute([$id_user]);
$meus_favoritos = $stmt_fav->fetchAll(PDO::FETCH_OBJ);


$total_jogos = count($reservas);
$nivel_nome = "Iniciado";
$nivel_cor = "bg-gray-100 text-gray-600"; 

if ($total_jogos >= 5) {
    $nivel_nome = "Amador";
    $nivel_cor = "bg-blue-100 text-blue-700";
}
if ($total_jogos >= 10) {
    $nivel_nome = "Veterano";
    $nivel_cor = "bg-green-100 text-green-700";
}
if ($total_jogos >= 20) {
    $nivel_nome = "Lenda do Clube";
    $nivel_cor = "bg-yellow-100 text-yellow-700 border border-yellow-300";
}

$stmt_news = $dbh->prepare("SELECT id FROM newsletter WHERE email = ?");
$stmt_news->execute([$user->email]);
$newsletter_ativa = $stmt_news->rowCount() > 0;
?>

<main class="max-w-7xl mx-auto px-4 py-10 relative">

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'cancelado'): ?>
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded shadow-sm flex justify-between items-center animate-fade-in-down">
            <div class="flex items-center">
                <span class="text-green-500 text-xl mr-2">✓</span>
                <p class="text-sm text-green-700 font-bold">Reserva cancelada com sucesso.</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900 font-bold">✕</button>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'perfil_atualizado'): ?>
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8 rounded shadow-sm flex justify-between items-center animate-fade-in-down">
            <div class="flex items-center">
                <span class="text-blue-500 text-xl mr-2">✏️</span>
                <p class="text-sm text-blue-700 font-bold">Dados atualizados com sucesso.</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-blue-700 hover:text-blue-900 font-bold">✕</button>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'reserva_sucesso'): ?>
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded shadow-sm flex justify-between items-center animate-fade-in-down">
            <div class="flex items-center">
                <span class="text-green-500 text-xl mr-2">🎉</span>
                <div>
                    <p class="text-sm text-green-700 font-bold">Reserva confirmada!</p>
                    <p class="text-xs text-green-600">O campo está à tua espera. Bom jogo!</p>
                </div>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900 font-bold">✕</button>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'torneio_criado'): ?>
        <div class="bg-purple-50 border-l-4 border-purple-500 p-4 mb-8 rounded shadow-sm flex justify-between items-center animate-fade-in-down">
            <div class="flex items-center">
                <span class="text-purple-500 text-xl mr-2">🏆</span>
                <div>
                    <p class="text-sm text-purple-700 font-bold">Torneio criado com sucesso!</p>
                    <p class="text-xs text-purple-600">O teu torneio já está visível para inscrições.</p>
                </div>
            </div>
            <button onclick="this.parentElement.remove()" class="text-purple-700 hover:text-purple-900 font-bold">✕</button>
        </div>
    <?php endif; ?>
        
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Olá, <?= ucfirst(explode(' ', $user->nome)[0]) ?>!</h1>
            <p class="text-gray-600">Este é o teu painel de atleta.</p>
        </div>
        <div class="hidden md:block">
            <span class="<?= $nivel_cor ?> text-sm font-bold px-4 py-2 rounded-full shadow-sm cursor-default">
                <?= $nivel_nome ?>
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <div class="lg:col-span-4 xl:col-span-3">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden sticky top-24">
                
                <div class="h-32 bg-gradient-to-r from-green-600 to-green-400 relative"></div>
                <div class="px-6 relative">
                    <div class="absolute -top-12 left-1/2 transform -translate-x-1/2">
                        <div class="h-24 w-24 bg-white rounded-full flex items-center justify-center border-4 border-white shadow-md text-3xl font-bold text-green-600 uppercase">
                            <?= strtoupper(substr($user->nome, 0, 1)) ?>
                        </div>
                    </div>
                </div>

                <div class="pt-16 pb-8 px-6 text-center">
                    <h2 class="text-xl font-bold text-gray-900"><?= htmlspecialchars(ucwords($user->nome)) ?></h2>
                    <p class="text-sm text-gray-500 mb-3"><?= htmlspecialchars($user->email) ?></p>
                    
                    <?php if($newsletter_ativa): ?>
                        <div class="mb-6">
                            <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 text-xs font-bold px-3 py-1 rounded-full border border-green-200 cursor-help" title="Recebes as nossas novidades">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                Newsletter Ativa
                            </span>
                        </div>
                    <?php else: ?>
                        <div class="mb-6">
                            <a href="blog.php" class="inline-flex items-center gap-1 bg-gray-50 text-gray-500 hover:text-green-600 hover:bg-green-50 text-xs font-bold px-3 py-1 rounded-full border border-gray-200 transition no-underline">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Subscrever News
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="flex justify-between border-b border-gray-100 pb-4 mb-4">
                        <div class="text-center w-1/2 border-r border-gray-100">
                            <span class="block text-xl font-bold text-gray-800"><?= count($reservas) ?></span>
                            <span class="text-xs text-gray-500 uppercase">Jogos</span>
                        </div>
                        <div class="text-center w-1/2">
                            <span class="block text-xl font-bold text-gray-800"><?= count($meus_torneios) ?></span>
                            <span class="text-xs text-gray-500 uppercase">Torneios</span>
                        </div>
                    </div>

                    <div class="space-y-3 text-left text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">País</span>
                            <span class="font-medium text-gray-800"><?= $user->pais ?? 'Portugal' ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Membro desde</span>
                            <span class="font-medium text-gray-800"><?= date('M Y', strtotime($user->data_registo)) ?></span>
                        </div>
                    </div>

                    <div class="mt-8 space-y-3">
                        <a href="editar_perfil.php" class="block w-full py-2 bg-gray-50 text-gray-600 font-bold rounded-lg hover:bg-gray-100 transition text-sm border border-gray-200 no-underline text-center">
                            Editar Dados
                        </a>
                        <a href="logout.php" class="block w-full py-2 text-red-500 font-bold rounded-lg hover:bg-red-50 transition text-sm border border-transparent hover:border-red-100 no-underline text-center">
                            Terminar Sessão
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-8 xl:col-span-9 space-y-10">
            
            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    As tuas Reservas
                </h2>

                <?php if (count($reservas) > 0): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php foreach($reservas as $reserva): 
                            $timestamp_jogo = strtotime($reserva->data_jogo . ' ' . $reserva->hora_inicio);
                            $jogoPassado = $timestamp_jogo < time();
                            $corStatus = $jogoPassado ? 'bg-gray-100 text-gray-500 border-gray-200' : 'bg-green-50 text-green-700 border-green-200';
                            $textoStatus = $jogoPassado ? 'Concluído' : 'Confirmado';
                        ?>
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex gap-4 items-center hover:shadow-md transition relative overflow-hidden group">
                                <div class="absolute left-0 top-0 bottom-0 w-1 <?= $jogoPassado ? 'bg-gray-300' : 'bg-green-500' ?>"></div>
                                <img src="<?= $reserva->imagem_hero ?>" class="w-16 h-16 rounded-lg object-cover bg-gray-100">
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-gray-800 truncate"><?= $reserva->nome_campo ?></h4>
                                    <p class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                        📅 <?= date('d/m/Y', strtotime($reserva->data_jogo)) ?> • ⏰ <?= date('H:i', strtotime($reserva->hora_inicio)) ?>
                                    </p>
                                    <div class="mt-2 flex items-center justify-between">
                                        <span class="inline-block text-xs font-bold px-2 py-0.5 rounded border <?= $corStatus ?>"><?= $textoStatus ?></span>
                                        <?php if(!$jogoPassado): ?>
                                            <button onclick="abrirModalCancelamento('cancelar_reserva.php?id=<?= $reserva->id ?>')" class="text-red-400 hover:text-red-600 text-xs font-bold underline ml-2 cursor-pointer bg-transparent border-none">Cancelar</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="block font-bold text-gray-900"><?= str_replace('.', ',', $reserva->preco_total) ?>€</span>
                                    <span class="text-xs text-gray-400"><?= $reserva->duracao ?>h</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="bg-white rounded-xl p-8 text-center border-2 border-dashed border-gray-200">
                        <p class="text-gray-500 mb-4">Ainda não tens jogos marcados.</p>
                        <a href="marcar_campo.php" class="text-green-600 font-bold hover:underline">Marcar o primeiro jogo &rarr;</a>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3.25 7.502 3.25c1.54 0 3.044.667 4.098 1.748a.75.75 0 001.096-.002c1.096-1.127 2.657-1.832 4.296-1.748 2.87.143 5.258 2.373 5.258 5.252 0 3.924-2.438 7.11-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" /></svg>
                    A tua Wishlist
                </h2>

                <?php if (count($meus_favoritos) > 0): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php foreach($meus_favoritos as $fav): ?>
                            <a href="detalhe_campo.php?id=<?= $fav->id ?>" class="bg-white rounded-xl p-3 shadow-sm border border-gray-100 hover:shadow-md transition flex items-center gap-3 no-underline group">
                                <img src="<?= $fav->imagem_hero ?>" class="w-16 h-16 rounded-lg object-cover bg-gray-100 group-hover:scale-105 transition">
                                <div class="min-w-0">
                                    <h4 class="font-bold text-gray-800 text-sm truncate group-hover:text-green-600 transition"><?= $fav->nome ?></h4>
                                    <p class="text-xs text-gray-500"><?= $fav->preco_por_hora > 0 ? 'Clube Oficial' : 'Campo Gratuito' ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="bg-white rounded-xl p-6 text-center border border-dashed border-gray-200">
                        <p class="text-gray-500 text-sm mb-2">Ainda não tens campos favoritos.</p>
                        <a href="localizacoes.php" class="text-red-500 font-bold hover:underline text-sm">Explorar campos &rarr;</a>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-purple-600">
                        <path fill-rule="evenodd" d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.112-3.173 6.73 6.73 0 002.743-1.347 6.753 6.753 0 006.139-5.6.75.75 0 00-.585-.858 47.077 47.077 0 00-3.07-.543V2.62a.75.75 0 00-.658-.744 49.22 49.22 0 00-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 00-.657.744zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 013.16 5.337a45.6 45.6 0 012.006-.348v.262zm13.668 0c.668.121 1.335.237 2.006.348-.533 1.16-1.529 2.122-2.863 2.635.545-.974.857-2.098.857-3.294v-.262z" clip-rule="evenodd" />
                    </svg>
                    Os teus Torneios
                </h2>

                <?php if (count($meus_torneios) > 0): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php foreach($meus_torneios as $t): ?>
                            <div class="bg-white rounded-xl p-4 shadow-sm border-l-4 border-purple-500 flex justify-between items-center hover:shadow-md transition">
                                <div>
                                    <h4 class="font-bold text-gray-800"><?= $t->nome ?></h4>
                                    <p class="text-sm text-gray-500"><?= date('d/m/Y', strtotime($t->data_evento)) ?> • <?= $t->local ?></p>
                                </div>
                                <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full">Inscrito</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="bg-gray-50 rounded-xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4 border border-gray-200">
                        <div class="text-center sm:text-left">
                            <h3 class="font-bold text-gray-800">Sem competições à vista?</h3>
                            <p class="text-sm text-gray-500">Inscreve-te nos próximos torneios e sobe no ranking!</p>
                        </div>
                        <a href="torneios.php" class="px-5 py-2 bg-purple-600 text-white font-bold rounded-lg hover:bg-purple-700 transition shadow-sm text-sm no-underline whitespace-nowrap">
                            Ver Torneios
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <div id="modal-cancelar" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex items-center justify-center backdrop-blur-sm">
        <div class="bg-white rounded-2xl p-6 shadow-2xl max-w-sm w-full mx-4 transform transition-all scale-100">
            <div class="text-center">
                <div class="bg-red-100 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Cancelar Reserva?</h3>
                <p class="text-gray-500 text-sm mb-6">Tens a certeza? Esta ação não pode ser desfeita e libertará o campo para outros jogadores.</p>
                <div class="flex gap-3">
                    <button onclick="fecharModal()" class="flex-1 bg-gray-100 text-gray-700 font-bold py-2.5 rounded-xl hover:bg-gray-200 transition">Não, voltar</button>
                    <a id="btn-confirmar-cancelar" href="#" class="flex-1 bg-red-600 text-white font-bold py-2.5 rounded-xl hover:bg-red-700 transition flex items-center justify-center no-underline">Sim, cancelar</a>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
    function abrirModalCancelamento(url) {
        document.getElementById('btn-confirmar-cancelar').href = url;
        document.getElementById('modal-cancelar').classList.remove('hidden');
    }
    function fecharModal() {
        document.getElementById('modal-cancelar').classList.add('hidden');
    }
    document.getElementById('modal-cancelar').addEventListener('click', function(e) {
        if (e.target === this) { fecharModal(); }
    });
</script>

<?php require('includes/footer.php'); ?>