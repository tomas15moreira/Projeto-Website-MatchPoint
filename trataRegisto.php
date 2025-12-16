<?php
session_start();
require('includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $genero = $_POST['gender'];
    $pais = $_POST['country'];

    $dia = $_POST['birth_day'];
    $mes = $_POST['birth_month'];
    $ano = $_POST['birth_year'];
    
    $data_nascimento = null;
    
    if(empty($dia) || empty($mes) || empty($ano)) {
        echo "<script>alert('A data de nascimento é obrigatória.'); window.history.back();</script>";
        exit;
    }
    
    $data_nascimento = "$ano-$mes-$dia";

    if (empty($nome) || empty($email) || empty($password)) {
        echo "<script>alert('Preencha os campos obrigatórios.'); window.history.back();</script>";
        exit;
    }

    $stmt = $dbh->prepare("SELECT id FROM utilizadores WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Este email já existe. Tente entrar.'); window.location.href='login.php';</script>";
        exit;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO utilizadores (nome, email, password, data_nascimento, genero, pais) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        
        if ($stmt->execute([$nome, $email, $password_hash, $data_nascimento, $genero, $pais])) {
            
            $novo_id = $dbh->lastInsertId();
            $_SESSION['user_id'] = $novo_id;
            $_SESSION['nome'] = $nome;

            echo "<script>
                // alert('Bem-vindo ao MatchPoint, " . $nome . "!'); // Podes tirar o // se quiseres o alerta
                window.location.href = 'index.php'; 
            </script>";
            exit;

        } else {
            echo "<script>alert('Erro técnico ao criar conta.'); window.history.back();</script>";
        }
    } catch (PDOException $e) {
        echo "Erro de BD: " . $e->getMessage();
    }
} else {
    header("Location: registar.php");
    exit;
}
?>