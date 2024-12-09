<?php
session_start();
    $host = 'localhost';
    $dbname = 'cslketou_data';
    $username = 'cslketou_admin';
    $password = 'Myketou@15';


    try {
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

<?php
// Vérifiez si l'URL actuelle contient '/admin/csl-backend/'
if (strpos($_SERVER['REQUEST_URI'], '/admin/csl-backend/') !== false) {
    // Si oui, vérifier l'authentification
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: ../../../Admin/login.php'); // Redirige vers la page de login
        exit;
    }
}
?>
