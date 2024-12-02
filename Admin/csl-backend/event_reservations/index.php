<?php
require '../../../config/database.php';




    $stmt = $pdo->query("SELECT er.id AS reservation_id, er.client_name, er.client_num, er.event_id, e.name AS event_name, e.date AS event_date
            FROM 
                event_reservations er
            JOIN 
                events e ON er.event_id = e.id
    ");
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
                            <h6 class="m-0 font-weight-bold text-primary">Liste des events reservations <a href="create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i></a></h6>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Noms Clients</th>
                                            <th>Numero clients</th>
                                            <th>Events</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($aboutUs as $item): ?>
                                            <tr>
                                                <td><?= $item['reservation_id'] ?></td>
                                                <td><?= htmlspecialchars($item['client_name']) ?></td>
                                                <td><?= htmlspecialchars($item['client_num']) ?></td>
                                                <td>
                                                    <a href="../events/detail.php?id=<?= $item['event_id'] ?>" style="text-decoration: underline; color: black" >
                                                        <?= htmlspecialchars($item['event_name']) ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="detail.php?id=<?= $item['reservation_id'] ?>">Détails</a> |
                                                    <a href="edit.php?id=<?= $item['reservation_id'] ?>">Modifier</a> |
                                                    <a href="delete.php?id=<?= $item['reservation_id'] ?>" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
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