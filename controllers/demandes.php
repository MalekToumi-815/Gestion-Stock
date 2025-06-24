<?php
session_start();
require_once '../config/db.php'; // make sure $pdo is defined here

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    die("Accès refusé. Veuillez vous connecter.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $idProduit = $_POST['idProduit'] ?? null;
    $quantite = $_POST['quantite'] ?? null;
    $utilisateur_id = $_SESSION['user']['matricule'];

    // Validation simple
    if (!$idProduit || !$quantite || $quantite <= 0) {
        die("Erreur : Veuillez remplir tous les champs correctement.");
    }

    try {
        // Préparer et exécuter l'insertion
        $stmt = $pdo->prepare("INSERT INTO Demandes (quantite, etat, description, utilisateur_id, idProduit) VALUES (?, 'En attente', NULL, ?, ?)");
        $stmt->execute([$quantite, $utilisateur_id, $idProduit]);

        echo "✅ Demande ajoutée avec succès.";
        // Optionally redirect:
        header("Location: ../views/dashboard_user.php");
        exit;
    } catch (PDOException $e) {
        echo "❌ Erreur lors de l'insertion : " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "Méthode non autorisée.";
}
?>
