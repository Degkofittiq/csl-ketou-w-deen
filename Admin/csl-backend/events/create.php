<?php
require '../../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    // Validation des champs texte
    if (strlen($name) > 50) {
        $_SESSION['error'] = "Le nom dépasse 50 caractères.";
    } elseif (strlen($description) > 160) {
        $_SESSION['error'] = "La description dépasse 160 caractères.";
    } else {
        // Vérifier si un fichier a été téléchargé
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Récupérer les informations sur le fichier téléchargé
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imageOriginalName = $_FILES['image']['name'];
            $imageExtension = strtolower(pathinfo($imageOriginalName, PATHINFO_EXTENSION));

            // Extensions autorisées
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($imageExtension, $allowedExtensions)) {
                $_SESSION['error'] = "L'extension de l'image n'est pas autorisée.";
            } else {
                // Créer un nom unique pour l'image
                $imageName = $name . '-' . uniqid() . '.' . $imageExtension;

                // Chemin du dossier des images
                $targetDirectory = '../../../image/';
                $targetFilePath = $targetDirectory . $imageName;

                // Vérifier si le dossier existe, sinon le créer
                if (!is_dir($targetDirectory)) {
                    if (!mkdir($targetDirectory, 0777, true)) {
                        $_SESSION['error'] = "Erreur lors de la création du dossier d'images.";
                    }
                }

                // Déplacer le fichier téléchargé
                if (move_uploaded_file($imageTmpName, $targetFilePath)) {
                    // Insérer dans la base de données
                    $stmt = $pdo->prepare("INSERT INTO events (name, date, description, image) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$name, $date, $description, $imageName]);

                    $_SESSION['success'] = "Événement ajouté avec succès.";
                } else {
                    $_SESSION['error'] = "Erreur lors du téléchargement de l'image.";
                }
            }
        } else {
            $_SESSION['error'] = "Aucun fichier image téléchargé ou erreur lors du téléchargement.";
        }
    }
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ajouter un nouvel événement</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form my-2" enctype="multipart/form-data">
                                <input class="form-control my-2" type="text" name="name" placeholder="Nom" required>
                                <input class="form-control my-2" type="date" name="date" placeholder="Date" required>
                                <textarea class="form-control my-2" name="description" placeholder="Description" required></textarea>
                                <input class="form-control my-2" type="file" accept="image/*" name="image" required>
                                <button class="btn btn-success" type="submit">Créer</button>
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
    <a class="scroll-to-top rounded" href="../../#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include('../includes/scripts.php'); ?>

</body>

</html>
