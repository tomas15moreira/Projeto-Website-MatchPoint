<?php
session_start();
require('includes/connection.php');


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $torneio_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $dbh->prepare("SELECT estado FROM torneios WHERE id = ?");
    $stmt->execute([$torneio_id]);
    $torneio = $stmt->fetch(PDO::FETCH_OBJ);

    if (!$torneio || $torneio->estado != 'Aberto') {
        echo "<script>alert('Lamentamos, mas as inscrições para este torneio já encerraram.'); window.location.href='torneios.php';</script>";
        exit;
    }

    $check = $dbh->prepare("SELECT id FROM inscricoes_torneios WHERE user_id = ? AND torneio_id = ?");
    $check->execute([$user_id, $torneio_id]);

    if ($check->rowCount() == 0) {
        $sql = "INSERT INTO inscricoes_torneios (user_id, torneio_id) VALUES (?, ?)";
        $inscrever = $dbh->prepare($sql);
        
        if ($inscrever->execute([$user_id, $torneio_id])) {
            header("Location: torneios.php?msg=sucesso_inscricao");
        } else {
            echo "<script>alert('Erro ao processar inscrição.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Já te encontras inscrito neste torneio!'); window.location.href='torneios.php';</script>";
    }

} else {
    header("Location: torneios.php");
}
?>