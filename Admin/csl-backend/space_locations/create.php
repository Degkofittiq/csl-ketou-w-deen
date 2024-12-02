<?php
require '../../../config/database.php';

// Récupérer la liste des espaces
$stmt = $pdo->prepare("SELECT * FROM spaces");
$stmt->execute();
$spaces = $stmt->fetchAll();

// Créer un nouvel élément dans space_locations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_name = $_POST['client_name'];
    $client_email = $_POST['client_email'];
    $client_number = $_POST['client_number'];
    $space_id = $_POST['space_id'];

    $stmt = $pdo->prepare("INSERT INTO space_locations (client_name, client_email, client_number, space_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$client_name, $client_email, $client_number, $space_id]);

    echo "Espace réservé avec succès.";
}
?>

<!DOCTYPE html>
<html lang="fr">

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
                    <!-- Formulaire d'ajout d'espace -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ajouter une nouvelle réservation d'espace</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form my-2" enctype="multipart/form-data">
                                <input class="form-control my-2" type="text" name="client_name" placeholder="Nom du client" required>
                                <input class="form-control my-2" type="email" name="client_email" placeholder="Email du client" required>
                                <input class="form-control my-2" type="text" name="client_number" placeholder="Numéro du client" required>
                                <select class="form-control my-2" name="space_id" required>
                                    <option value="">Choisissez un espace</option>
                                    <?php foreach ($spaces as $space): ?>
                                        <option value="<?php echo $space['id']; ?>"><?php echo $space['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button class="btn btn-success my-3" type="submit">Réserver</button>
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
