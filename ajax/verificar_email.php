<?php
require('../includes/connection.php');

header('Content-Type: application/json');

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);

    $stmt = $dbh->prepare("SELECT id FROM utilizadores WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['existe' => true]);
    } else {
        echo json_encode(['existe' => false]);
    }
} else {
    echo json_encode(['existe' => false]);
}
?>