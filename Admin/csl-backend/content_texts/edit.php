<?php
require '../../../config/database.php';

// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les détails de l'élément depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM content_text_management WHERE id = ?");
    $stmt->execute([$id]);
    $content = $stmt->fetch();

    // Vérifier si l'élément existe
    if ($content) {
        // Si le formulaire a été soumis pour mettre à jour
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $content_fr = $_POST['content_fr'];
            $content_en = $_POST['content_en'];

            $stmt = $pdo->prepare("UPDATE content_text_management SET name = ?, content_fr = ?, content_en = ? WHERE id = ?");
            $stmt->execute([$name, $content_fr, $content_en, $id]);

            // Rediriger vers la page des détails après la mise à jour
            header("Location: edit.php?id=" . $id);
            exit;
        }
    } else {
        echo "L'élément demandé n'existe pas.";
        exit;
    }
} else {
    echo "Aucun identifiant spécifié.";
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
                    <!-- Formulaire d'édition -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Modifier A propos</h6>
                        </div>
                        <div class="card-body">
                            <form action="edit.php?id=<?php echo $content['id']; ?>" method="post" class="form my-2" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input class="form-control my-2" type="text" name="name" id="name" value="<?php echo htmlspecialchars($content['name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="content_fr">content_fr</label>
                                    <textarea class="form-control my-2" name="content_fr" id="content_fr" required><?php echo htmlspecialchars($content['content_fr']); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content_en">content_en</label>
                                    <textarea class="form-control my-2" name="content_en" id="content_en" required><?php echo htmlspecialchars($content['content_en']); ?></textarea>
                                </div>
                                <button class="btn btn-warning" type="submit">Modifier</button>
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
