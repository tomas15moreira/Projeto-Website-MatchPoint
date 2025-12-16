<?php
session_start();
require('includes/connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_SESSION['user_id'];
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $pais = trim($_POST['pais']);
    $genero = $_POST['genero'];
    $password_nova = $_POST['password'];

    if (empty($nome) || empty($email)) {
        echo "<script>alert('Nome e Email são obrigatórios.'); window.history.back();</script>";
        exit;
    }

    try {
        
        if (!empty($password_nova)) {
            $hash = password_hash($password_nova, PASSWORD_DEFAULT);
            $sql = "UPDATE utilizadores SET nome=?, email=?, pais=?, genero=?, password=? WHERE id=?";
            $stmt = $dbh->prepare($sql);
            $executou = $stmt->execute([$nome, $email, $pais, $genero, $hash, $id]);
        } else {
            $sql = "UPDATE utilizadores SET nome=?, email=?, pais=?, genero=? WHERE id=?";
            $stmt = $dbh->prepare($sql);
            $executou = $stmt->execute([$nome, $email, $pais, $genero, $id]);
        }

        if ($executou) {
            $_SESSION['nome'] = $nome;
            
            header("Location: perfil.php?msg=perfil_atualizado");
            exit;
        } else {
            echo "<script>alert('Erro ao atualizar perfil.'); window.history.back();</script>";
        }

    } catch (PDOException $e) {
        echo "Erro BD: " . $e->getMessage();
    }

} else {
    header("Location: perfil.php");
}
?>