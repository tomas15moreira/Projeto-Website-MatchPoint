<?php
require('../includes/connection.php');

header('Content-Type: application/json');

if (isset($_GET['campo_id']) && isset($_GET['data_jogo'])) {
    
    $campo_id = $_GET['campo_id'];
    $data_jogo = $_GET['data_jogo'];

    $stmt = $dbh->prepare("SELECT hora_inicio, duracao FROM reservas WHERE campo_id = ? AND data_jogo = ?");
    $stmt->execute([$campo_id, $data_jogo]);
    $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $horas_ocupadas = [];

    foreach ($reservas as $reserva) {
        $hora_inicio = date('H:i', strtotime($reserva['hora_inicio']));
        $horas_ocupadas[] = $hora_inicio;

        if ($reserva['duracao'] == 2) {
            $hora_seguinte = date('H:i', strtotime($reserva['hora_inicio']) + 3600); 
            $horas_ocupadas[] = $hora_seguinte;
        }
    }

    // Devolve a lista ao JavaScript
    echo json_encode($horas_ocupadas);

} else {
    echo json_encode([]);
}
?>