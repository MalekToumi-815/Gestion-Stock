<?php
$host = 'localhost';
$db = 'gestion_systeme';
$user = 'root';
$pass = 'malik123'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    echo("done");
} catch (PDOException $e) {
    echo("Erreur connexion DB : " . $e->getMessage());
}
?>