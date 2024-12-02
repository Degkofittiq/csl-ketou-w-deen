<?php
require '../../../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer la réservation
    $stmt = $pdo->prepare("DELETE FROM space_locations WHERE id = ?");
    $stmt->execute([$id]);

    echo "Réservation supprimée avec succès.";
    // Rediriger vers la page principale ou la liste des éléments
    header("Location: index.php"); // Rediriger vers la page de la liste (ou une autre page de votre choix)
}
?>
