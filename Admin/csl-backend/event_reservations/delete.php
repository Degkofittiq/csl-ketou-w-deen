<?php
require '../../../config/database.php';

// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les détails de l'élément à supprimer depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM event_reservations WHERE id = ?");
    $stmt->execute([$id]);
    $aboutUs = $stmt->fetch();

    // Vérifier si l'élément existe
    if (!$aboutUs) {
        echo "L'élément demandé n'existe pas.";
        exit;
    }

    // Suppression de l'image associée (si elle existe)
    $imagePath = '../../../images/' . $aboutUs['image'];
    if (file_exists($imagePath)) {
        unlink($imagePath); // Supprimer l'image
    }

    // Suppression de l'élément dans la base de données
    $stmt = $pdo->prepare("DELETE FROM event_reservations WHERE id = ?");
    $stmt->execute([$id]);

    // Rediriger vers la page principale ou la liste des éléments
    header("Location: index.php"); // Rediriger vers la page de la liste (ou une autre page de votre choix)
    exit;
} else {
    echo "Aucun identifiant spécifié.";
    exit;
}
