<?php
// admin/auth.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Verificar se está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// 2. Ligar à Base de Dados
// O '../' serve para sair da pasta admin e ir buscar a conexão à pasta includes
if (file_exists('../includes/connection.php')) {
    require_once '../includes/connection.php';
} else {
    die("Erro: Não foi possível encontrar o ficheiro de conexão.");
}

// 3. Verificar na BD se é mesmo Admin
// Usamos a variável $dbh que vem do teu ficheiro connection.php
$stmt = $dbh->prepare("SELECT is_admin FROM utilizadores WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Se não for encontrado ou não for admin (is_admin != 1)
if (!$user || $user['is_admin'] != 1) {
    echo "<script>alert('Acesso Restrito! Apenas para Administradores.'); window.location.href='../index.php';</script>";
    exit;
}
?>