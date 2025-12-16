<?php
session_start();
require('../includes/connection.php');

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !isset($_POST['campo_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Login necessário']);
    exit;
}

$user_id = $_SESSION['user_id'];
$campo_id = $_POST['campo_id'];

$check = $dbh->prepare("SELECT id FROM favoritos WHERE user_id = ? AND campo_id = ?");
$check->execute([$user_id, $campo_id]);

if ($check->rowCount() > 0) {
    $stmt = $dbh->prepare("DELETE FROM favoritos WHERE user_id = ? AND campo_id = ?");
    $stmt->execute([$user_id, $campo_id]);
    echo json_encode(['status' => 'removed']);
} else {
    $stmt = $dbh->prepare("INSERT INTO favoritos (user_id, campo_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $campo_id]);
    echo json_encode(['status' => 'added']);
}
?>