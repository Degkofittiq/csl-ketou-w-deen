<?php
require '../../../config/database.php';


// Créer un nouvel élément dans events
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO events (name, date, description) VALUES (?, ?, ?)");
    $stmt->execute([$name, $date, $description]);

    echo "Élément ajouté avec succès.";
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
                                <input class="form-control my-2" type="text" name="name" placeholder="Nom" required>
                                <input class="form-control my-2" type="date" name="date" placeholder="Date" required>
                                <textarea  class="form-control my-2"  name="description" placeholder="description" required></textarea>
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