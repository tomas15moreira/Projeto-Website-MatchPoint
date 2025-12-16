<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}


if (file_exists('../includes/connection.php')) {
    require_once '../includes/connection.php';
} else {
    die("Erro: Não foi possível encontrar o ficheiro de conexão.");
}

$stmt = $dbh->prepare("SELECT is_admin FROM utilizadores WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || $user['is_admin'] != 1) {
    echo "<script>alert('Acesso Restrito! Apenas para Administradores.'); window.location.href='../index.php';</script>";
    exit;
}
?>