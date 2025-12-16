<?php 
$user = 'root';
$pass = '';
$dbname = 'matchpoint';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=' . $dbname, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro na ligação: ' . $e->getMessage();
    die();
}
?>