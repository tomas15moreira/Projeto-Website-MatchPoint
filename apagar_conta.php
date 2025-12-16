<?php
session_start();
require('includes/connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id'];

try {
    $dbh->beginTransaction();

    $stmt1 = $dbh->prepare("DELETE FROM reservas WHERE user_id = ?");
    $stmt1->execute([$id]);

    $stmt2 = $dbh->prepare("DELETE FROM inscricoes_torneios WHERE user_id = ?");
    $stmt2->execute([$id]);

    $stmt3 = $dbh->prepare("DELETE FROM favoritos WHERE user_id = ?");
    $stmt3->execute([$id]);

    $stmtEmail = $dbh->prepare("SELECT email FROM utilizadores WHERE id = ?");
    $stmtEmail->execute([$id]);
    $emailUser = $stmtEmail->fetchColumn();
    
    if ($emailUser) {
        $stmt4 = $dbh->prepare("DELETE FROM newsletter WHERE email = ?");
        $stmt4->execute([$emailUser]);
    }

    $stmtFinal = $dbh->prepare("DELETE FROM utilizadores WHERE id = ?");
    $stmtFinal->execute([$id]);

    $dbh->commit();

    session_destroy();

    echo "<script>alert('A tua conta foi eliminada com sucesso. Foi um prazer ter-te connosco!'); window.location.href='index.php';</script>";

} catch (Exception $e) {
    $dbh->rollBack();
    echo "Erro ao apagar conta: " . $e->getMessage();
}
?>