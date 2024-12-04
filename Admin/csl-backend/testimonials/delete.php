<?php
require '../../../config/database.php';

// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les détails du testimonial à supprimer depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = ?");
    $stmt->execute([$id]);
    $testimonial = $stmt->fetch();

    // Vérifier si le testimonial existe
    if (!$testimonial) {
        $_SESSION['error'] = "Le testimonial demandé n'existe pas.";
        header("Location: index.php");
        exit;
    }

    // Suppression de l'image associée (si elle existe)
    $imagePath = '../../../image/' . $testimonial['image'];
    if (!empty($testimonial['image']) && file_exists($imagePath)) {
        if (!unlink($imagePath)) {
            $_SESSION['error'] = "Impossible de supprimer l'image associée.";
            header("Location: index.php");
            exit;
        }
    }

    // Suppression du testimonial dans la base de données
    $stmt = $pdo->prepare("DELETE FROM testimonials WHERE id = ?");
    $stmt->execute([$id]);

    // Rediriger vers la page principale ou la liste des testimonials
    $_SESSION['success'] = "Le testimonial a été supprimé avec succès.";
    header("Location: index.php");
    exit;
} else {
    $_SESSION['error'] = "Aucun identifiant spécifié.";
    header("Location: index.php");
    exit;
}
