<?php
require '../../../config/database.php';

// Récupérer l'ID de l'horaire à mettre à jour
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtenez l'horaire existant pour pré-remplir le formulaire
    $stmt = $pdo->prepare("SELECT * FROM hourlies WHERE id = ?");
    $stmt->execute([$id]);
    $hourly = $stmt->fetch();

    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $days = $_POST['days'];
        $h_open = $_POST['h_open'];
        $h_close = $_POST['h_close'];

        // Mettre à jour l'horaire dans la base de données
        $updateStmt = $pdo->prepare("UPDATE hourlies SET days = ?, h_open = ?, h_close = ? WHERE id = ?");
        $updateStmt->execute([$days, $h_open, $h_close, $id]);

        echo "Horaire mis à jour avec succès.";
    }
} else {
    echo "Aucun horaire trouvé.";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('../includes/links.php'); ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('../includes/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('../includes/navbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Formulaire pour modifier un horaire -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Modifier un horaire</h6>
                        </div>
                        <div class="card-body">
                            <?php if ($hourly): ?>
                                <form action="" method="post" class="form my-2">
                                    <select class="form-control my-2" name="days" required>
                                        <option value="" disabled>Choisir un jour</option>
                                        <option value="Lundi" <?php echo ($hourly['days'] === 'Lundi') ? 'selected' : ''; ?>>Lundi</option>
                                        <option value="Mardi" <?php echo ($hourly['days'] === 'Mardi') ? 'selected' : ''; ?>>Mardi</option>
                                        <option value="Mercredi" <?php echo ($hourly['days'] === 'Mercredi') ? 'selected' : ''; ?>>Mercredi</option>
                                        <option value="Jeudi" <?php echo ($hourly['days'] === 'Jeudi') ? 'selected' : ''; ?>>Jeudi</option>
                                        <option value="Vendredi" <?php echo ($hourly['days'] === 'Vendredi') ? 'selected' : ''; ?>>Vendredi</option>
                                        <option value="Samedi" <?php echo ($hourly['days'] === 'Samedi') ? 'selected' : ''; ?>>Samedi</option>
                                        <option value="Dimanche" <?php echo ($hourly['days'] === 'Dimanche') ? 'selected' : ''; ?>>Dimanche</option>
                                    </select>
                                    <label for="h_open">Heure d'ouverture :</label>
                                    <input class="form-control my-2" type="time" name="h_open" value="<?php echo $hourly['h_open']; ?>" required>
                                    <label for="h_close">Heure de fermeture :</label>
                                    <input class="form-control my-2" type="time" name="h_close" value="<?php echo $hourly['h_close']; ?>" required>
                                    <button class="btn btn-warning" type="submit">Mettre à jour</button>
                                </form>
                            <?php else: ?>
                                <p>Aucun horaire trouvé.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('../includes/footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include('../includes/scripts.php'); ?>

</body>

</html>
