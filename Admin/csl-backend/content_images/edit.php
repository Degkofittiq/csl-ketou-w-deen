<?php
require '../../../config/database.php';

// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les détails de l'élément depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM content_image_management WHERE id = ?");
    $stmt->execute([$id]);
    $aboutUs = $stmt->fetch();

    // Vérifier si l'élément existe
    if (!$aboutUs) {
        echo "L'élément demandé n'existe pas.";
        exit;
    }
} else {
    echo "Aucun identifiant spécifié.";
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
$timestamp = time(); // Temps actuel en secondes depuis 1970 (UNIX timestamp)

// Générer une chaîne aléatoire de 8 caractères
$randomString = generateRandomString(8);

// Combiner le timestamp avec la chaîne aléatoire pour générer un identifiant unique
$uniqueId = $timestamp . '_' . $randomString;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_POST['name'] . '_' . time();
        $fileType = $_FILES['image']['type'];

        // Extraire l'extension du fichier
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Créer un nom de fichier unique
        $newFileName = $uniqueId . '.' . $fileExtension;

        // Déplacer l'image dans le dossier ../../../image/
        $destinationPath = '../../../image/' . $newFileName;
        if (move_uploaded_file($fileTmpPath, $destinationPath)) {
            // Mettre à jour le nom de l'image dans la base de données
            $imageId =  $_GET['id'];
            $query = "UPDATE content_image_management SET path = ?, type = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$newFileName, $fileType, $imageId]);
            echo "L'image a été mise à jour.";
        } else {
            echo "Erreur lors du téléchargement de l'image.";
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
