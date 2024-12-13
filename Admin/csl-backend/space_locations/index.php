<?php
require '../../../config/database.php';

// Récupérer tous les enregistrements de space_locations
$stmt = $pdo->prepare("SELECT * FROM space_locations");
$stmt->execute();
$space_locations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('../includes/links.php'); ?>
</head>

<body id="page-top">

    <div id="wrapper">
        <?php include('../includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('../includes/navbar.php'); ?>
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des espaces <a href="create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i></a></h6>
                        </div>
                        <div class="card-body">
                            <?php if ($space_locations): ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom du client</th>
                                            <th>Email du client</th>
                                            <th>Numéro du client</th>
                                            <th>ID de l'espace</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($space_locations as $location): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($location['id']); ?></td>
                                                <td><?php echo htmlspecialchars($location['client_name']); ?></td>
                                                <td><?php echo htmlspecialchars($location['client_email']); ?></td>
                                                <td><?php echo htmlspecialchars($location['client_number']); ?></td>
                                                <td><?php echo htmlspecialchars($location['space_id']); ?></td>
                                                <td>
                                                    <a href="edit.php?id=<?php echo $location['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                                    <a href="delete.php?id=<?php echo $location['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')">Supprimer</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>Aucun enregistrement trouvé.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('../includes/scripts.php'); ?>
</body>

</html>
