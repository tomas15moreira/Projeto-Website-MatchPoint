<?php 
require('includes/connection.php'); 
require('includes/header.php'); 

$sql = "SELECT t.*, 
        (SELECT COUNT(*) FROM inscricoes_torneios WHERE torneio_id = t.id) as total_inscritos
        FROM torneios t 
        ORDER BY t.data_evento ASC";
$stmt = $dbh->query($sql);
$torneios = $stmt->fetchAll(PDO::FETCH_OBJ);

$minhas_inscricoes = [];
if (isset($_SESSION['user_id'])) {
    $stmt_ins = $dbh->prepare("SELECT torneio_id FROM inscricoes_torneios WHERE user_id = ?");
    $stmt_ins->execute([$_SESSION['user_id']]);
    $minhas_inscricoes = $stmt_ins->fetchAll(PDO::FETCH_COLUMN);
}

function dataParaPortugues($data) {
    $meses = [1 => 'JAN', 2 => 'FEV', 3 => 'MAR', 4 => 'ABR', 5 => 'MAI', 6 => 'JUN', 7 => 'JUL', 8 => 'AGO', 9 => 'SET', 10 => 'OUT', 11 => 'NOV', 12 => 'DEZ'];
    $timestamp = strtotime($data);
    return ['dia' => date('d', $timestamp), 'mes' => $meses[(int)date('m', $timestamp)]];
}
?>

<main class="max-w-7xl mx-auto px-4 py-10 relative">
    
    <?php if (isset($_GET['msg'])): ?>
        <?php if ($_GET['msg'] == 'sucesso_inscricao'): ?>
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded shadow-sm flex justify-between items-center animate-fade-in-down">
                <div class="flex items-center">
                    <span class="text-green-500 text-xl mr-2">🎉</span>
                    <div><p class="text-sm text-green-700 font-bold">Inscrição confirmada!</p></div>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">✕</button>
            </div>
        <?php elseif ($_GET['msg'] == 'inscricao_cancelada'): ?>
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-8 rounded shadow-sm flex justify-between items-center animate-fade-in-down">
                <div class="flex items-center">
                    <span class="text-yellow-500 text-xl mr-2">info</span>
                    <div><p class="text-sm text-yellow-700 font-bold">Inscrição cancelada.</p></div>
                </div>
                <button onclick="this.parentElement.remove()" class="text-yellow-700 font-bold">✕</button>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="text-center mb-12">
        <h1 class="text-4xl text-gray-800 mb-4 font-bold">Torneios e Competições</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Desafia-te e sobe no ranking.</p>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-10">
        <div class="flex flex-wrap justify-center gap-4">
            <button class="px-6 py-2 bg-green-600 text-white rounded-full font-medium shadow hover:bg-green-700 transition">Todos</button>
            <button class="px-6 py-2 bg-white text-gray-600 border border-gray-300 rounded-full font-medium hover:border-green-600 hover:text-green-600 transition">Ténis</button>
        </div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="criar_torneio.php" class="flex items-center gap-2 bg-gray-900 text-white px-6 py-2 rounded-full font-bold hover:bg-black transition shadow-lg no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Criar Torneio
            </a>
        <?php endif; ?>
    </div>

    <div class="space-y-6">
        <?php if (count($torneios) > 0): ?>
            <?php foreach ($torneios as $torneio): 
                $dataPT = dataParaPortugues($torneio->data_evento);
                
                $estadoVisual = $torneio->estado;
                $agora = date('Y-m-d H:i:s');
                if (($torneio->data_evento . ' ' . $torneio->hora) < $agora) {
                    $estadoVisual = 'Terminado';
                }

                $corBorda = 'border-green-500';
                $corTextoMes = 'text-green-600';
                $corBadge = 'bg-green-100 text-green-700';
                
                $botaoAcao = ''; 

                if ($estadoVisual == 'Fechado' || $estadoVisual == 'Terminado') {
                    $corBorda = 'border-gray-400 opacity-75';
                    $corTextoMes = 'text-gray-500';
                    $corBadge = 'bg-gray-200 text-gray-600';
                    $botaoAcao = '<button disabled class="w-full md:w-auto px-8 py-3 rounded font-bold bg-gray-300 text-gray-500 cursor-not-allowed">'.$estadoVisual.'</button>';
                } 
                
                elseif (in_array($torneio->id, $minhas_inscricoes)) {
                    $botaoAcao = '
                        <div class="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto">
                            <span class="px-6 py-3 rounded font-bold bg-purple-100 text-purple-700 cursor-default border border-purple-200 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Inscrito
                            </span>
                            <button onclick="abrirModal(\'cancelar\', \'cancelar_inscricao.php?id='.$torneio->id.'\')" 
                                    class="text-red-500 hover:text-red-700 text-sm font-bold underline px-4 py-2 hover:bg-red-50 rounded transition">
                                Cancelar
                            </button>
                        </div>';
                }
                else {
                    $link = isset($_SESSION['user_id']) ? "javascript:abrirModal('inscrever', 'inscrever_torneio.php?id={$torneio->id}')" : "login.php?aviso=1";
                    
                    if ($estadoVisual == 'Decorrer') {
                        $corBorda = 'border-yellow-400';
                        $corBadge = 'bg-yellow-100 text-yellow-700';
                        $textoBtn = 'Últimas Vagas';
                    } else {
                        $textoBtn = 'Inscrever';
                    }

                    $botaoAcao = '<a href="'.$link.'" class="w-full md:w-auto px-8 py-3 rounded font-bold bg-green-600 text-white hover:bg-green-700 shadow-md transition no-underline inline-block text-center">'.$textoBtn.'</a>';
                }
            ?>

            <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-8 <?= $corBorda ?> flex flex-col md:flex-row hover:shadow-lg transition duration-300">
                <div class="bg-gray-100 p-6 flex flex-col items-center justify-center min-w-[120px] border-b md:border-b-0 md:border-r border-gray-200">
                    <span class="<?= $corTextoMes ?> font-bold text-xl"><?= $dataPT['mes'] ?></span>
                    <span class="text-gray-800 font-bold text-4xl"><?= $dataPT['dia'] ?></span>
                    <span class="text-gray-500 text-sm"><?= date('H:i', strtotime($torneio->hora)) ?></span>
                </div>
                
                <div class="p-6 flex-1 flex flex-col justify-center">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="<?= $corBadge ?> text-xs font-bold px-2 py-1 rounded uppercase"><?= $estadoVisual ?></span>
                        
                        <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <?= htmlspecialchars($torneio->local) ?>
                            </span>
                            <span class="hidden md:inline">•</span>
                            <span class="flex items-center gap-1 font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded-full" title="Total de inscrições">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                <?= $torneio->total_inscritos ?> Inscritos
                            </span>
                        </div>

                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($torneio->nome) ?></h3>
                    <p class="text-gray-600 mb-4 md:mb-0 leading-relaxed"><?= htmlspecialchars($torneio->descricao) ?></p>
                </div>

                <div class="p-6 flex items-center justify-center md:justify-end">
                    <?= $botaoAcao ?>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-10 bg-gray-50 rounded-xl border border-gray-200">
                <p class="text-gray-500">Sem torneios de momento.</p>
            </div>
        <?php endif; ?>
    </div>

    <div id="modal-confirmacao" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex items-center justify-center backdrop-blur-sm">
        <div class="bg-white rounded-2xl p-6 shadow-2xl max-w-sm w-full mx-4 transform transition-all scale-100">
            
            <div class="text-center">
                <div id="modal-icon-bg" class="rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                    <svg id="modal-icon" class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                </div>
                
                <h3 id="modal-titulo" class="text-lg font-bold text-gray-900 mb-2">--</h3>
                <p id="modal-texto" class="text-gray-500 text-sm mb-6">--</p>
                
                <div class="flex gap-3">
                    <button onclick="fecharModal()" class="flex-1 bg-gray-100 text-gray-700 font-bold py-2.5 rounded-xl hover:bg-gray-200 transition">
                        Voltar
                    </button>
                    <a id="btn-confirmar-modal" href="#" class="flex-1 text-white font-bold py-2.5 rounded-xl transition flex items-center justify-center no-underline">
                        Confirmar
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="mt-20 border-t border-gray-100 pt-16">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Vencedores do Mês</h2>
        <p class="text-gray-500 text-center mb-12">Os atletas que dominaram o ranking em Novembro.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto text-center items-end px-4">
            
            <div class="order-2 md:order-1 bg-white p-6 rounded-t-2xl shadow-sm border-b-8 border-gray-300 h-64 flex flex-col justify-end transform hover:-translate-y-1 transition">
                <div class="w-20 h-20 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold text-gray-500 border-4 border-white shadow-sm">
                    2
                </div>
                <h3 class="font-bold text-lg text-gray-800">Pedro Santos</h3>
                <p class="text-gray-500 text-sm font-medium">Finalista Open</p>
                <div class="mt-3 text-xs text-gray-400 font-mono">1850 PTS</div>
            </div>

            <div class="order-1 md:order-2 bg-white p-6 rounded-t-2xl shadow-lg border-b-8 border-yellow-400 h-80 flex flex-col justify-end relative z-10 transform md:-translate-y-4 hover:-translate-y-6 transition">
                
                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-white p-3 rounded-full shadow-md border-2 border-yellow-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
                
                <div class="w-24 h-24 bg-yellow-50 rounded-full mx-auto mb-4 flex items-center justify-center text-4xl font-bold text-yellow-600 border-4 border-white shadow-sm">
                    1
                </div>
                <h3 class="font-bold text-xl text-gray-900">João Silva</h3>
                <p class="text-green-600 font-bold text-sm">Campeão Inverno</p>
                <div class="mt-3 text-xs text-yellow-600 font-bold font-mono bg-yellow-50 inline-block mx-auto px-3 py-1 rounded-full">2100 PTS</div>
            </div>

            <div class="order-3 md:order-3 bg-white p-6 rounded-t-2xl shadow-sm border-b-8 border-orange-300 h-56 flex flex-col justify-end transform hover:-translate-y-1 transition">
                <div class="w-20 h-20 bg-orange-50 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold text-orange-500 border-4 border-white shadow-sm">
                    3
                </div>
                <h3 class="font-bold text-lg text-gray-800">Miguel Costa</h3>
                <p class="text-gray-500 text-sm font-medium">Semifinalista</p>
                <div class="mt-3 text-xs text-gray-400 font-mono">1620 PTS</div>
            </div>

        </div>
    </div>
</main>

<script src="js/torneios.js"></script>

<?php require('includes/footer.php'); ?>