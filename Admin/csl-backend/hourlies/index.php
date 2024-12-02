<?php
require '../../../config/database.php';

// Récupérer tous les horaires de la table hourlies
$stmt = $pdo->prepare("SELECT * FROM hourlies");
$stmt->execute();
$hourlies = $stmt->fetchAll();
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
                    <!-- Liste des horaires -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des horaires <a href="create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i></a></h6>
                        </div>
                        <div class="card-body">
                            <?php if ($hourlies): ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jours</th>
                                            <th>Heure d'ouverture</th>
                                            <th>Heure de fermeture</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($hourlies as $hourly): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($hourly['id']); ?></td>
                                                <td><?php echo htmlspecialchars($hourly['days']); ?></td>
                                                <td><?php echo htmlspecialchars($hourly['h_open']); ?></td>
                                                <td><?php echo htmlspecialchars($hourly['h_close']); ?></td>
                                                <td>
                                                    <a href="edit.php?id=<?php echo $hourly['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                                    <a href="delete.php?id=<?php echo $hourly['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet horaire ?')">Supprimer</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>Aucun horaire trouvé.</p>
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
