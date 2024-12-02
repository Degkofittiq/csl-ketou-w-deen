<?php
require '../../../config/database.php';

// Traiter le formulaire d'ajout de réservation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_name = $_POST['client_name'];
    $client_num = $_POST['client_num'];
    $event_id = $_POST['event_id'];

    // Insérer les données dans la table `event_reservations`
    $stmt = $pdo->prepare("INSERT INTO event_reservations (client_name, client_num, event_id) VALUES (?, ?, ?)");
    $stmt->execute([$client_name, $client_num, $event_id]);

    echo "Réservation ajoutée avec succès.";
}

// Récupérer la liste des événements pour le dropdown
$eventsStmt = $pdo->query("SELECT id, name FROM events");
$events = $eventsStmt->fetchAll(PDO::FETCH_ASSOC);
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
                    <!-- Formulaire pour ajouter une réservation -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ajouter une nouvelle réservation</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form my-2">
                                <input class="form-control my-2" type="text" name="client_name" placeholder="Nom du client" required>
                                <input class="form-control my-2" type="text" name="client_num" placeholder="Numéro de téléphone" required>
                                
                                <select class="form-control my-2" name="event_id" required>
                                    <option value="" disabled selected>Choisir un événement</option>
                                    <?php foreach ($events as $event): ?>
                                        <option value="<?= htmlspecialchars($event['id']) ?>">
                                            <?= htmlspecialchars($event['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

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
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include('../includes/scripts.php'); ?>

</body>

</html>
