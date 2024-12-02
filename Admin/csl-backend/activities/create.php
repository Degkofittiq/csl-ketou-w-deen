<?php
require '../../../config/database.php';

// Créer une nouvelle activité
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $little_title = $_POST['little_title'];

    // Vérifier si une image a été téléchargée
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $image_name = time() . "_" . basename($image['name']);  // Nom unique pour l'image
        $image_path = '../../../image/' . $image_name;

        // Déplacer l'image vers le dossier
        if (move_uploaded_file($image['tmp_name'], $image_path)) {
            // Enregistrer les données dans la base de données
            $stmt = $pdo->prepare("INSERT INTO activities (name, description, little_title, image) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $description, $little_title, $image_name]);

            echo "Activité ajoutée avec succès.";
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } else {
        // Si pas de nouvelle image, utiliser une valeur par défaut
        $stmt = $pdo->prepare("INSERT INTO activities (name, description, little_title, image) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $description, $little_title, 'default_image.jpg']); // Par défaut une image
        echo "Activité ajoutée avec l'image par défaut.";
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
                            <h6 class="m-0 font-weight-bold text-primary">Ajouter une nouvelle activité</h6>
                            
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form my-2"  enctype="multipart/form-data">
                                <input class="form-control my-2" type="text" name="name" placeholder="Nom" required>
                                <input class="form-control my-2" type="text" name="little_title" placeholder="petit titre" required>
                                <textarea  class="form-control my-2"  name="description" placeholder="Description" required></textarea>
                                <input  class="form-control my-2"  type="file" accept="images/" name="image" placeholder="Image">
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