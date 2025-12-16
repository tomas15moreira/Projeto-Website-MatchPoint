<?php
session_start();
require('includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Receber Dados
    $nome = $_POST['nome'];
    $local = $_POST['local'];
    $data = $_POST['data_evento'];
    $hora = $_POST['hora'];
    $preco = $_POST['preco'];
    $nivel = $_POST['nivel'];
    $descricao = $_POST['descricao'];
    $estado = 'Aberto';


    if ($data < date('Y-m-d')) {
        echo "<script>alert('Erro: A data do torneio não pode ser no passado.'); window.history.back();</script>";
        exit;
    }

    
    if ($preco < 0 || $preco > 25) {
        echo "<script>alert('Erro: O preço deve ser entre 0€ e 25€.'); window.history.back();</script>";
        exit;
    }


    $imagem_nome = "";
    
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $pasta_destino = "img/";
        $nome_ficheiro = basename($_FILES['imagem']['name']);
        $caminho_completo = $pasta_destino . $nome_ficheiro;
        
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_completo)) {
            $imagem_nome = $caminho_completo;
        } else {
            echo "<script>alert('Erro ao carregar a imagem.'); window.history.back();</script>";
            exit;
        }
    }

    try {
        $sql = "INSERT INTO torneios (nome, local, data_evento, hora, preco, nivel, descricao, imagem, estado) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        
        if ($stmt->execute([$nome, $local, $data, $hora, $preco, $nivel, $descricao, $imagem_nome, $estado])) {
            
            header("Location: perfil.php?msg=torneio_criado");
            exit;

        } else {
            echo "<script>alert('Erro ao guardar na base de dados.'); window.history.back();</script>";
        }

    } catch (PDOException $e) {
        echo "Erro SQL: " . $e->getMessage();
    }

} else {
    header("Location: criar_torneio.php");
}
?>