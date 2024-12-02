<?php
require '../../../config/database.php';

// Validation de l'ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Récupérer les détails de l'élément
    $stmt = $pdo->prepare("SELECT * FROM content_image_management WHERE id = ?");
    $stmt->execute([$id]);
    $aboutUs = $stmt->fetch();

    if (!$aboutUs) {
        $_SESSION['error'] = "L'élément demandé n'existe pas.";
        exit;
    }
} else {
    $_SESSION['error'] = "Aucun identifiant spécifié ou identifiant invalide.";
    exit;
}

// Fonction pour générer une chaîne aléatoire
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

// Obtenez le timestamp actuel
$timestamp = time();
$randomString = generateRandomString(8);
$uniqueId = $timestamp . '_' . $randomString;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Vérifier le type de fichier
        if (!in_array($fileExtension, $allowedExtensions)) {
            $_SESSION['error'] = "Format de fichier non valide. Les formats autorisés sont : jpg, jpeg, png, gif.";
            exit;
        }

        // Créer un nom de fichier unique
        $newFileName = $uniqueId . '.' . $fileExtension;
        $destinationDir = realpath('../../../image/');

        if (!$destinationDir || !is_writable($destinationDir)) {
            $_SESSION['error'] = "Impossible d'écrire dans le répertoire cible.";
            exit;
        }

        $destinationPath = $destinationDir . '/' . $newFileName;
        if (move_uploaded_file($fileTmpPath, $destinationPath)) {
            // Mettre à jour la base de données
            $query = "UPDATE content_image_management SET path = ?, type = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$newFileName, $_FILES['image']['type'], $id]);
            $_SESSION['message'] = "L'image a été mise à jour avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors du téléchargement de l'image.";
        }
    } else {
        $_SESSION['error'] = "Aucune image valide téléchargée.";
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
                    <!-- Formulaire d'édition -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Modifier l'image</h6>
                        </div>
                        <div class="card-body">
                            <form action="edit.php?id=<?php echo $aboutUs['id']; ?>" method="post" class="form my-2" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input readonly class="form-control my-2" type="text" name="name" id="name" value="<?php echo htmlspecialchars($aboutUs['name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image actuelle</label><br>
                                    <img src="../../../image/<?php echo htmlspecialchars($aboutUs['path']); ?>" alt="Image actuelle" width="150"><br>
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
