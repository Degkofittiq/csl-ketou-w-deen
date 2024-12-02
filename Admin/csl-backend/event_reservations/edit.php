<?php
require '../../../config/database.php';

// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les détails de l'élément depuis la base de données
    $stmt = $pdo->prepare("SELECT er.id AS reservation_id, er.client_name, er.client_num, er.event_id, e.name AS event_name, e.date AS event_date
        FROM 
            event_reservations er
        JOIN 
            events e ON er.event_id = e.id
        WHERE er.id = ?");
    $stmt->execute([$id]);
    $reservation = $stmt->fetch();

    $stmt2 = $pdo->query("SELECT * FROM events");
    $events = $stmt2->fetchAll();
    // Vérifier si l'élément existe
    if ($reservation) {
        // Si le formulaire a été soumis pour mettre à jour

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_GET['id'];
            $client_name = $_POST['client_name'];
            $client_num = $_POST['client_num'];
            $event_id = $_POST['event_id'];

            // Valider les entrées (ajoute des validations supplémentaires si nécessaire)
            if (empty($client_name) || empty($client_num) || empty($event_id)) {
                die("Tous les champs sont requis.");
            }

            // Effectuer la mise à jour
            $query = "UPDATE event_reservations SET client_name = ?, client_num = ?, event_id = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);

            try {
                $stmt->execute([$client_name, $client_num, $event_id, $id]);
                echo "La réservation a été mise à jour avec succès.";
            } catch (Exception $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }
    } else {
        echo "L'élément demandé n'existe pas.";
        exit;
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
                            <h6 class="m-0 font-weight-bold text-primary">Modifier la reservation</h6>
                        </div>
                        <div class="card-body">
                            <form action="edit.php?id=<?php echo $reservation['reservation_id']; ?>" method="post" class="form my-2" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="client_name">Nom Client</label>
                                    <input class="form-control my-2" type="text" name="client_name" id="client_name" value="<?php echo htmlspecialchars($reservation['client_name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="client_num">Numero Client</label>
                                    <input class="form-control my-2" type="text" name="client_num" id="client_num" value="<?php echo htmlspecialchars($reservation['client_num']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="event_id">Evenement</label>
                                    <select name="event_id" class="form-control" id="event_id" required>
                                        <?php foreach ($events as $event): ?>
                                        <option value="<?= $event['id'] ?>" <?= $event['id'] == $reservation['event_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($event['name']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
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
