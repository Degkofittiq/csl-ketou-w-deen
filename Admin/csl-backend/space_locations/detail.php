<?php
require '../../../config/database.php';

// Récupérer toutes les réservations d'espace avec les informations d'espace associées
$stmt = $pdo->prepare("SELECT sl.id, sl.client_name, sl.client_email, sl.client_number, s.name AS space_name 
                       FROM space_locations sl
                       INNER JOIN spaces s ON sl.space_id = s.id");
$stmt->execute();
$locations = $stmt->fetchAll();
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
                    <!-- Liste des réservations d'espace -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des réservations d'espace</h6>
                        </div>
                        <div class="card-body">
                            <?php if ($locations): ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom du client</th>
                                            <th>Email</th>
                                            <th>Numéro</th>
                                            <th>Espace réservé</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($locations as $location): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($location['id']); ?></td>
                                                <td><?php echo htmlspecialchars($location['client_name']); ?></td>
                                                <td><?php echo htmlspecialchars($location['client_email']); ?></td>
                                                <td><?php echo htmlspecialchars($location['client_number']); ?></td>
                                                <td><?php echo htmlspecialchars($location['space_name']); ?></td>
                                                <td>
                                                    <a href="edit.php?id=<?php echo $location['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                                    <a href="delete.php?id=<?php echo $location['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">Supprimer</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>Aucune réservation trouvée.</p>
                            <?php endif; ?>
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
