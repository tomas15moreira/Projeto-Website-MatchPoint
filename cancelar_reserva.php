<?php
session_start();
require('includes/connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $reserva_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $dbh->prepare("SELECT id FROM reservas WHERE id = ? AND user_id = ?");
    $stmt->execute([$reserva_id, $user_id]);
    
    if ($stmt->rowCount() > 0) {
        $delete = $dbh->prepare("DELETE FROM reservas WHERE id = ?");
        $delete->execute([$reserva_id]);
        
        header("Location: perfil.php?msg=cancelado");
    } else {
        header("Location: perfil.php?erro=ilegal");
    }
} else {
    header("Location: perfil.php");
}
?>