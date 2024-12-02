<?php
require '../../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $amount = $_POST['amount'];

    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
        // Récupérer les informations sur le fichier téléchargé
        $imageTmpName = $_FILES['images']['tmp_name'];
        $imageOriginalName = $_FILES['images']['name'];
        $imageExtension = strtolower(pathinfo($imageOriginalName, PATHINFO_EXTENSION));

        // Validation de l'extension de fichier
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageExtension, $allowedExtensions)) {
            echo "L'extension de l'image n'est pas autorisée.";
            exit;
        }

        // Créer un nom unique pour l'image (concatenation du name et du nom original)
        $imageName = $name . '-' . uniqid() . '.' . $imageExtension;

        // Définir le chemin du dossier où enregistrer l'image
        $targetDirectory = '../../../image/';
        $targetFilePath = $targetDirectory . $imageName;

        // Vérifier si le dossier "images/" existe, sinon le créer
        if (!is_dir($targetDirectory)) {
            if (!mkdir($targetDirectory, 0777, true)) {
                echo "Erreur lors de la création du dossier d'images.";
                exit;
            }
        }

        // Déplacer le fichier téléchargé vers le dossier images/
        if (move_uploaded_file($imageTmpName, $targetFilePath)) {
            // Insérer les données dans la base de données, avec le nom de l'image
            $stmt = $pdo->prepare("INSERT INTO spaces (name, amount, images) VALUES (?, ?, ?)");
            $stmt->execute([$name, $amount, $imageName]);

            // Rediriger vers la liste des éléments
            header("Location: index.php");
            exit;
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } else {
        echo "Aucun fichier image téléchargé ou erreur lors du téléchargement.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include('../includes/links.php')
    ?>
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ajouter un nouvel espace</h6>
                            
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form my-2"  enctype="multipart/form-data">
                                <input class="form-control my-2" type="text" name="name" placeholder="Nom" required>
                                <input class="form-control my-2" type="number" min="0" name="amount" placeholder="Montant" required>
                                <input  class="form-control my-2"  type="file" accept="images/" name="images" placeholder="Image" required>
                                <button  class="btn btn-success"  type="submit">Créer</button>
                            </form>
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