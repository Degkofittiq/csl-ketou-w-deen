<?php
require '../../../config/database.php';

// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les détails de l'élément depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$id]);
    $content = $stmt->fetch();

    // Vérifier si l'élément existe
    if ($content) {
        // Si le formulaire a été soumis pour mettre à jour
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $date = $_POST['date'];
            $description = $_POST['description'];
            $image = $content['image']; // Valeur par défaut : conserver l'image existante

            // Vérification des contraintes
            if (strlen($name) > 50) {
                $_SESSION['error'] = "Le nom dépasse 50 caractères.";
            } elseif (strlen($description) > 160) {
                $_SESSION['error'] = "La description dépasse 160 caractères.";
            } else {
                // Si une nouvelle image est téléchargée
                if (!empty($_FILES['image']['name'])) {
                    $targetDir = "../../../image/";
                    $image = time() . "_" . basename($_FILES['image']['name']);
                    $targetFile = $targetDir . $image;

                    // Déplacer l'image téléchargée vers le répertoire cible
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                        // Supprimer l'ancienne image si différente
                        if ($content['image'] && file_exists($targetDir . $content['image'])) {
                            unlink($targetDir . $content['image']);
                        }
                    } else {
                        $_SESSION['error'] = "Erreur lors du téléchargement de l'image.";
                        header("Location: edit.php?id=" . $id);
                        exit;
                    }
                }

                // Mise à jour des données dans la base de données
                $stmt = $pdo->prepare("UPDATE events SET name = ?, date = ?, description = ?, image = ? WHERE id = ?");
                $stmt->execute([$name, $date, $description, $image, $id]);

                // Rediriger vers la page de modification après la mise à jour
                $_SESSION['success'] = "Les détails de l'événement ont été mis à jour.";
                header("Location: edit.php?id=" . $id);
                exit;
            }
        }
    } else {
        $_SESSION['error'] = "L'élément demandé n'existe pas.";
    }
} else {
    $_SESSION['error'] = "Aucun identifiant spécifié.";
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
                            <h6 class="m-0 font-weight-bold text-primary">Modifier l'événement</h6>
                        </div>
                        <div class="card-body">
                            <form action="edit.php?id=<?php echo $content['id']; ?>" method="post" class="form my-2" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input class="form-control my-2" type="text" name="name" id="name" value="<?php echo htmlspecialchars($content['name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input class="form-control my-2" type="date" name="date" id="date" value="<?php echo htmlspecialchars($content['date']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control my-2" name="description" id="description" required><?php echo htmlspecialchars($content['description']); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image (optionnel)</label>
                                    <?php if (!empty($content['image'])): ?>
                                        <div class="mb-2">
                                            <img src="../../../image/<?php echo htmlspecialchars($content['image']); ?>" alt="Image actuelle" class="img-fluid" style="max-height: 200px;">
                                        </div>
                                    <?php endif; ?>
                                    <?php if (empty($content['image'])): ?>
                                        <div class="mb-2">
                                            Pas encore d'image
                                        </div>
                                    <?php endif; ?>
                                    <input class="form-control my-2" type="file" name="image" id="image">
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
