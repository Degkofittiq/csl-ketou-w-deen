<?php
require '../../../config/database.php';

// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les détails de l'élément depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM content_text_management WHERE id = ?");
    $stmt->execute([$id]);
    $aboutUs = $stmt->fetch();

    // Vérifier si l'élément existe
    if (!$aboutUs) {
         $_SESSION['error'] =  "L'élément demandé n'existe pas.";
        exit;
    }
} else {
     $_SESSION['error'] =  "Aucun identifiant spécifié.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

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
                    <!-- Détails de l'élément -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Détails de A propos</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input class="form-control my-2" type="text" name="name" id="name" value="<?php echo htmlspecialchars($aboutUs['name']); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="content_fr">content_fr</label>
                                <textarea class="form-control my-2" name="content_fr" id="content_fr" readonly><?php echo htmlspecialchars($aboutUs['content_fr']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="content_en">content_en</label>
                                <textarea class="form-control my-2" name="content_en" id="content_en" readonly><?php echo htmlspecialchars($aboutUs['content_en']); ?></textarea>
                            </div>
                            <a href="index.php" class="btn btn-primary mt-3">Retour à la liste</a>
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
