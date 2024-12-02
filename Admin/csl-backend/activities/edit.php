<?php
require '../../../config/database.php';

// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les détails de l'élément depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM activities WHERE id = ?");
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

// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les détails de l'activité depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM activities WHERE id = ?");
    $stmt->execute([$id]);
    $activity = $stmt->fetch();

    // Vérifier si l'activité existe
    if ($activity) {
        // Si le formulaire a été soumis pour mettre à jour
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $little_title = $_POST['little_title'];

            // Vérifier si une nouvelle image a été téléchargée
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = $_FILES['image'];
                $image_name = time() . "_" . basename($image['name']);  // Nom unique pour l'image
                $image_path = '../../../image/' . $image_name;

                // Déplacer l'image vers le dossier
                if (move_uploaded_file($image['tmp_name'], $image_path)) {
                    // Mettre à jour l'image dans la base de données
                    $stmt = $pdo->prepare("UPDATE activities SET name = ?, description = ?, little_title = ?, image = ? WHERE id = ?");
                    $stmt->execute([$name, $description, $little_title, $image_name, $id]);
                    echo "Activité mise à jour avec la nouvelle image.";
                } else {
                    echo "Erreur lors du téléchargement de l'image.";
                }
            } else {
                // Si aucune nouvelle image, conserver l'ancienne image
                $stmt = $pdo->prepare("UPDATE activities SET name = ?, description = ?, little_title = ? WHERE id = ?");
                $stmt->execute([$name, $description, $little_title, $id]);
                echo "Activité mise à jour sans changement d'image.";
            }
        }
    } else {
        echo "L'activité demandée n'existe pas.";
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
                            <h6 class="m-0 font-weight-bold text-primary">Modifier L'activité: <?= $activity['name'] ?? "" ?> </h6>
                        </div>
                        <div class="card-body">
                            <form action="edit.php?id=<?php echo $aboutUs['id']; ?>" method="post" class="form my-2" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="little_title">Nom</label>
                                    <input class="form-control my-2" type="text" placeholder="Petit titre" name="little_title" id="little_title" value="<?php echo htmlspecialchars($aboutUs['little_title']); ?>" required>
                                    <input class="form-control my-2" type="text" placeholder="nom" name="name" id="name" value="<?php echo htmlspecialchars($aboutUs['name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control my-2" name="description" id="description" required><?php echo htmlspecialchars($aboutUs['description']); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image actuelle</label><br>
                                    <img src="../../../image/<?php echo htmlspecialchars($aboutUs['image']); ?>" alt="Image actuelle" width="150"><br>
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
