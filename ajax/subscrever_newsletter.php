<?php
require('../includes/connection.php');

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Email inválido.']);
        exit;
    }

    try {
        $stmt = $dbh->prepare("INSERT INTO newsletter (email) VALUES (?)");
        $stmt->execute([$email]);
        echo json_encode(['status' => 'success', 'message' => 'Subscrito com sucesso!']);
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo json_encode(['status' => 'error', 'message' => 'Este email já está subscrito.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao guardar.']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Pedido inválido.']);
}
?>