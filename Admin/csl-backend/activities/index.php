<?php
require '../../../config/database.php';

$stmt = $pdo->query("SELECT * FROM activities");
$aboutUs = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                            <h6 class="m-0 font-weight-bold text-primary">Liste des activités <a href="create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i></a></h6>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Noms</th>
                                            <th>Descriptions</th>
                                            <th>Images</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($aboutUs as $item): ?>
                                            <tr>
                                                <td><?= $item['id'] ?></td>
                                                <td><?= htmlspecialchars($item['name']) ?></td>
                                                <td><?= htmlspecialchars($item['description']) ?></td>
                                                <td>
                                                    <center>
                                                        <img src="../../../image/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="100">
                                                    </center>
                                                </td>
                                                <td>
                                                    <a href="detail.php?id=<?= $item['id'] ?>">Détails</a> |
                                                    <a href="edit.php?id=<?= $item['id'] ?>">Modifier</a> |
                                                    <a href="delete.php?id=<?= $item['id'] ?>" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
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