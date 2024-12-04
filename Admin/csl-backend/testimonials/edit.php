<?php
require '../../../config/database.php';

// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les détails du témoignage depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = ?");
    $stmt->execute([$id]);
    $testimonial = $stmt->fetch();

    // Vérifier si l'élément existe
    if (!$testimonial) {
        if (!$testimonial) {
            $_SESSION['error'] = "Le testimonial demandé n'existe pas.";
            header("Location: index.php");
            exit;
        }
    }
} else {
    $_SESSION['error'] = "Aucun identifiant spécifié.";
    // exit;
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $message = $_POST['message'];
    $note = $_POST['note'];

    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Récupérer les informations sur le fichier téléchargé
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageOriginalName = $_FILES['image']['name'];
        $imageExtension = strtolower(pathinfo($imageOriginalName, PATHINFO_EXTENSION));

        // Validation de l'extension de fichier
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageExtension, $allowedExtensions)) {
            $_SESSION['error'] = "L'extension de l'image n'est pas autorisée.";
            // exit;
        }

        // Créer un nom unique pour l'image
        $imageName = $name . '-' . uniqid() . '.' . $imageExtension;

        // Définir le chemin du dossier où enregistrer l'image
        $targetDirectory = '../../../image/';
        $targetFilePath = $targetDirectory . $imageName;

        // Déplacer le fichier téléchargé vers le dossier images/
        if (move_uploaded_file($imageTmpName, $targetFilePath)) {
            // Supprimer l'ancienne image
            if (file_exists($targetDirectory . $testimonial['image'])) {
                unlink($targetDirectory . $testimonial['image']);
            }
        } else {
            $_SESSION['error'] = "Erreur lors du téléchargement de l'image.";
            // exit;
        }
    } else {
        // Si aucune nouvelle image n'est téléchargée, conserver l'ancienne
        $imageName = $testimonial['image'];
    }

    // Mettre à jour les données dans la base de données
    $stmt = $pdo->prepare("UPDATE testimonials SET name = ?, message = ?, note = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $message, $note, $imageName, $id]);

    // Rediriger vers la page des détails après la mise à jour
    header("Location: detail.php?id=" . $id);
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
                            <h6 class="m-0 font-weight-bold text-primary">Modifier le Témoignage</h6>
                        </div>
                        <div class="card-body">
                            <form action="edit.php?id=<?php echo $testimonial['id']; ?>" method="post" class="form my-2" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input class="form-control my-2" type="text" name="name" id="name" value="<?php echo htmlspecialchars($testimonial['name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="message">message</label>
                                    <textarea class="form-control my-2" name="message" id="message" required><?php echo htmlspecialchars($testimonial['message']); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="note">Évaluation</label>
                                    <input class="form-control my-2" type="number" name="note" id="note" min="1" max="5" value="<?php echo htmlspecialchars($testimonial['note']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image actuelle</label><br>
                                    <img src="../../../image/<?php echo htmlspecialchars($testimonial['image']); ?>" alt="Image actuelle" width="150"><br>
                                    <label for="image">Télécharger une nouvelle image (facultatif)</label>
                                    <input class="form-control my-2" type="file" accept="image/*" name="image" id="image">
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
