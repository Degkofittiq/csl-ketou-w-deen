<?php
session_start();

// Configuration de la base de données
$host = 'localhost';
$dbname = 'cls-ak';
$username = 'root';
$password = '';

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérification de l'authentification si l'URL contient '/admin/csl-backend/'
    if (strpos($_SERVER['REQUEST_URI'], '/Admin/csl-backend/') !== false) {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
            header('Location: ../../../Admin/login.php');
            // exit; // Arrêter l'exécution après la redirection
        }
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
