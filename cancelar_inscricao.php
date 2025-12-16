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

    $sql = "DELETE FROM inscricoes_torneios WHERE user_id = ? AND torneio_id = ?";
    $stmt = $dbh->prepare($sql);
    
    if ($stmt->execute([$user_id, $torneio_id])) {
        header("Location: torneios.php?msg=inscricao_cancelada");
    } else {
        header("Location: torneios.php?msg=erro");
    }

} else {
    header("Location: torneios.php");
}
?>