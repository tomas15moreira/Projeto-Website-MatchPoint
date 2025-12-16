<?php
session_start();
require('includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = trim($_POST['email']);

    $stmt = $dbh->prepare("SELECT id FROM utilizadores WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        header("Location: login.php?msg=enviado");
        exit;
    } else {
        header("Location: recuperar_password.php?erro=nao_encontrado");
        exit;
    }
} else {
    header("Location: recuperar_password.php");
    exit;
}
?>