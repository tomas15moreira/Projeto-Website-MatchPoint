<?php
session_start();
require('includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $assunto = $_POST['assunto'];
    $mensagem = trim($_POST['mensagem']);

    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo "<script>alert('Por favor, preencha todos os campos.'); window.history.back();</script>";
        exit;
    }

    try {
        $sql = "INSERT INTO mensagens (nome, email, assunto, mensagem) VALUES (?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        
        if ($stmt->execute([$nome, $email, $assunto, $mensagem])) {
            header("Location: contactos.php?msg=enviada");
        } else {
            echo "<script>alert('Erro ao enviar mensagem.'); window.history.back();</script>";
        }

    } catch (PDOException $e) {
        echo "Erro BD: " . $e->getMessage();
    }

} else {
    header("Location: contactos.php");
}
?>