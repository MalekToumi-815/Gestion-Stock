<?php
$host = 'localhost';
$db = 'gestion_stock';
$user = 'kinza';
$pass = '123'; // Mot de passe de phpMyAdmin

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
} catch (PDOException $e) {
    die("Erreur connexion DB : " . $e->getMessage());
}
?>
