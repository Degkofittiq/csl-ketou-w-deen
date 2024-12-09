<?php
// session_start();  // Démarre la session si elle n'est pas déjà démarrée

require('../../../config/database.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    // Rediriger vers la page de login si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit;
}

// Récupérer l'identifiant de l'utilisateur connecté
$username = $_SESSION['username'];

// Initialiser les variables pour les erreurs
$error = "";

// Vérifier si le formulaire a été soumis pour la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les informations soumises
    $new_username = trim($_POST['username']);
    $new_password = trim($_POST['password']);
    
    // Valider les données utilisateur
    if (empty($new_username)) {
        $error = "Le nom d'utilisateur est requis.";
    } elseif (empty($new_password)) {
        $error = "Le mot de passe est requis.";
    } else {
        try {
            // Mettre à jour les informations de l'utilisateur dans la base de données
            $sql = "UPDATE users SET username = :username, password = :password WHERE username = :current_username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $new_username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $new_password, PDO::PARAM_STR);
            $stmt->bindParam(':current_username', $username, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Mettre à jour la session avec le nouveau nom d'utilisateur
                $_SESSION['username'] = $new_username;
                $_SESSION['success'] = "Votre profil a été mis à jour avec succès.";
                // Rediriger l'utilisateur vers la page de profil
                header('Location: ../../logout.php');
                exit;
            } else {
                $error = "Une erreur est survenue lors de la mise à jour de votre profil.";
            }
        } catch (PDOException $e) {
            $error = "Erreur : " . $e->getMessage();
        }
    }
}

// Charger les informations actuelles de l'utilisateur
try {
    $sql = "SELECT username, password FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $current_username = $user['username'];
        $current_password = $user['password'];
    } else {
        $error = "Utilisateur introuvable.";
    }
} catch (PDOException $e) {
    $error = "Erreur : " . $e->getMessage();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include('../includes/links.php')
    ?>
    <title>CSL - Mise à jour du profil</title>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
         <?php
            include('../includes/sidebar.php')
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                 <?php
                    include('../includes/navbar.php')
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 p-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                if (isset($error) && !empty($error)) {
                                    echo "<div class='alert alert-danger'>{$error}</div>";
                                }
                                if (isset($_SESSION['success'])) {
                                    echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
                                    unset($_SESSION['success']);
                                }
                                ?>
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Mise à jour de votre profil</h1>
                                    </div>
                                    <form method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" value="<?= htmlspecialchars($current_username) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" value="" required>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-user btn-block">
                                            Mettre à jour
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
             <?php
                include('../includes/footer.php');
             ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="../../#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php
        include('../includes/scripts.php');
    ?>

</body>

</html>
