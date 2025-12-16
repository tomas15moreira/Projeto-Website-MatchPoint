<?php
session_start();
require('includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: login.php?erro=1");
        exit;
    }

    $stmt = $dbh->prepare("SELECT id, nome, password FROM utilizadores WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        
        header("Location: index.php");
        exit;

    } else {
        header("Location: login.php?erro=1");
        exit;
    }

} else {
    header("Location: login.php");
    exit;
}
?>