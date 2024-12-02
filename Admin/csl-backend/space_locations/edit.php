<?php
require '../../../config/database.php';

// Récupérer l'ID de la réservation
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations de la réservation
    $stmt = $pdo->prepare("SELECT * FROM space_locations WHERE id = ?");
    $stmt->execute([$id]);
    $location = $stmt->fetch();

    // Récupérer la liste des espaces
    $stmt_spaces = $pdo->prepare("SELECT * FROM spaces");
    $stmt_spaces->execute();
    $spaces = $stmt_spaces->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les nouvelles valeurs
        $client_name = $_POST['client_name'];
        $client_email = $_POST['client_email'];
        $client_number = $_POST['client_number'];
        $space_id = $_POST['space_id'];

        // Mettre à jour la réservation
        $stmt_update = $pdo->prepare("UPDATE space_locations SET client_name = ?, client_email = ?, client_number = ?, space_id = ? WHERE id = ?");
        $stmt_update->execute([$client_name, $client_email, $client_number, $space_id, $id]);

        echo "Réservation mise à jour avec succès.";
    }
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
                    <!-- Formulaire de modification -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Modifier la réservation</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form my-2">
                                <input class="form-control my-2" type="text" name="client_name" value="<?php echo htmlspecialchars($location['client_name']); ?>" required>
                                <input class="form-control my-2" type="email" name="client_email" value="<?php echo htmlspecialchars($location['client_email']); ?>" required>
                                <input class="form-control my-2" type="text" name="client_number" value="<?php echo htmlspecialchars($location['client_number']); ?>" required>
                                <select class="form-control my-2" name="space_id" required>
                                    <option value="">Choisissez un espace</option>
                                    <?php foreach ($spaces as $space): ?>
                                        <option value="<?php echo $space['id']; ?>" <?php echo ($space['id'] == $location['space_id']) ? 'selected' : ''; ?>><?php echo $space['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button class="btn btn-success my-3" type="submit">Mettre à jour</button>
                            </form>
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
