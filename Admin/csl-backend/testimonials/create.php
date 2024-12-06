<?php
require '../../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $title = $_POST['title'];
    $note = intval($_POST['note']);
    $message = $_POST['message'];

    // Validation de la note
    if ($note < 1 || $note > 5) {
        $_SESSION['error'] = "La note doit être un entier entre 1 et 5.";
        header("Location: create.php");
        // exit;
    }

    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageOriginalName = $_FILES['image']['name'];
        $imageExtension = strtolower(pathinfo($imageOriginalName, PATHINFO_EXTENSION));

        // Extensions autorisées
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageExtension, $allowedExtensions)) {
            $_SESSION['error'] = "L'extension de l'image n'est pas autorisée.";
            header("Location: create.php");
            // exit;
        }

        // Créer un nom unique pour l'image
        $imageName = $name . '-' . uniqid() . '.' . $imageExtension;

        // Chemin de destination
        $targetDirectory = '../../../image/';
        $targetFilePath = $targetDirectory . $imageName;

        // Créer le dossier s'il n'existe pas
        if (!is_dir($targetDirectory)) {
            if (!mkdir($targetDirectory, 0777, true)) {
                $_SESSION['error'] = "Erreur lors de la création du dossier d'images.";
                header("Location: create.php");
                // exit;
            }
        }

        // Déplacer le fichier vers le dossier images
        if (move_uploaded_file($imageTmpName, $targetFilePath)) {
            // Insérer les données dans la base
            $stmt = $pdo->prepare("INSERT INTO testimonials (name, image, title, note, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $imageName, $title, $note, $message]);

            // Redirection
            header("Location: index.php");
            // exit;
        } else {
            $_SESSION['error'] = "Erreur lors du téléchargement de l'image.";
            header("Location: create.php");
            // exit;
        }
    } else {
        $_SESSION['error'] = "Aucun fichier image téléchargé ou erreur lors du téléchargement.";
        header("Location: create.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../includes/links.php') ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('../includes/sidebar.php') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('../includes/navbar.php') ?>
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ajouter un nouveau testimonial</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form my-2" enctype="multipart/form-data">
                                <input class="form-control my-2" type="text" name="name" placeholder="Nom" required>
                                <input class="form-control my-2" type="text" name="title" placeholder="Titre" required>
                                <input class="form-control my-2" type="number" name="note" placeholder="Note (1-5)" min="1" max="5" required>
                                <textarea class="form-control my-2" name="message" placeholder="Message" required></textarea>
                                <input class="form-control my-2" type="file" accept="image/*" name="image" required>
                                <button class="btn btn-success" type="submit">Créer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('../includes/footer.php'); ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="../../#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php include('../includes/scripts.php'); ?>
</body>

</html>
