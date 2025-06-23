<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];

    $stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE login = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch();

    if ($user && $mdp === $user['mdp']) {
        $_SESSION['user'] = $user;

        // Vérification rôle
        $id = $user['matricule'];
        if ($pdo->query("SELECT * FROM Administrateurs WHERE id_admin = $id")->fetch()) {
            $_SESSION['role'] = 'admin';
            header("Location: C:\xampp\htdocs\Gestion-Stock\views\dashboard_admin.html");
        } elseif ($pdo->query("SELECT * FROM Agents WHERE id_agent = $id")->fetch()) {
            $_SESSION['role'] = 'agent';
            header("Location: C:\xampp\htdocs\Gestion-Stock\views\dashboard_agent.html");
        } else {
            $_SESSION['role'] = 'utilisateur';
            header("Location: C:\xampp\htdocs\Gestion-Stock\views\dashboard_user.html");
        }

    } else {
        echo "Login ou mot de passe incorrect";
    }
}
?>
