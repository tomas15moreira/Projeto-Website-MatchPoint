<?php
session_start();
require('includes/connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?aviso=1");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['user_id'];
    $campo_id = $_POST['campo_id'];
    $data_jogo = $_POST['data_jogo'];
    $hora_inicio = $_POST['hora_inicio'];
    $duracao = $_POST['duracao'];

    if (empty($data_jogo) || empty($hora_inicio)) {
        header("Location: marcar_campo.php?erro=dados_em_falta");
        exit;
    }

    $stmt = $dbh->prepare("SELECT preco_por_hora FROM campos WHERE id = ?");
    $stmt->execute([$campo_id]);
    $campo = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $preco_hora = $campo['preco_por_hora'];
    $preco_total = $preco_hora * $duracao;

    try {
        $sql = "INSERT INTO reservas (user_id, campo_id, data_jogo, hora_inicio, duracao, preco_total) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        
        if ($stmt->execute([$user_id, $campo_id, $data_jogo, $hora_inicio, $duracao, $preco_total])) {
            
            header("Location: perfil.php?msg=reserva_sucesso");
            exit;

        } else {
            header("Location: marcar_campo.php?erro=falha_sql");
            exit;
        }

    } catch (PDOException $e) {
        header("Location: marcar_campo.php?erro=excecao_bd");
        exit;
    }

} else {
    header("Location: marcar_campo.php");
}
?>