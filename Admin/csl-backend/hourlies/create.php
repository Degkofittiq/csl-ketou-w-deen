<?php
    require '../../../config/database.php';

    // Traiter le formulaire d'ajout d'horaires
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $days = $_POST['days'];
        $h_open = $_POST['h_open'];
        $h_close = $_POST['h_close'];

        // Insérer les données dans la table `hourlies`
        $stmt = $pdo->prepare("INSERT INTO hourlies (days, h_open, h_close) VALUES (?, ?, ?)");
        $stmt->execute([$days, $h_open, $h_close]);

        echo "Horaire ajouté avec succès.";
    }
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
                            <h6 class="m-0 font-weight-bold text-primary">Ajouter un nouvel event</h6>
                            
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form my-2"  enctype="multipart/form-data">
                                    <select id="days" name="days" class="form-control my-2" required>
                                        <option value="" disabled selected>-- Sélectionnez le Jour --</option>
                                        <option value="lundi">Lundi</option>
                                        <option value="mardi">Mardi</option>
                                        <option value="mercredi">Mercredi</option>
                                        <option value="jeudi">Jeudi</option>
                                        <option value="vendredi">Vendredi</option>
                                        <option value="samedi">Samedi</option>
                                        <option value="dimanche">Dimanche</option>
                                    </select>
                                   <input class="form-control my-2" type="time" name="h_open" placeholder="Heure d'ouverture" required>
                                   <input class="form-control my-2" type="time" name="h_close" placeholder="Heure de fermeture" required>
                                <button  class="btn btn-success"  type="submit">Créer</button>
                            </form>
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