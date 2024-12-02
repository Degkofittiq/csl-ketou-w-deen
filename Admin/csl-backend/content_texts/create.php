<?php
require '../../../config/database.php';


// Créer un nouvel élément dans content_text_management
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = preg_replace('/\s+/', '_', $_POST['name']);
    $content_fr = $_POST['content_fr'];
    $content_en = $_POST['content_en'];

    $stmt = $pdo->prepare("INSERT INTO content_text_management (name, content_fr, content_en) VALUES (?, ?, ?)");
    $stmt->execute([$name, $content_fr, $content_en]);

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
                            <h6 class="m-0 font-weight-bold text-primary">Ajouter un nouveau contenu de texte</h6>
                            
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form my-2"  enctype="multipart/form-data">
                                <input class="form-control my-2" type="text" name="name" placeholder="Nom" required>
                                <textarea  class="form-control my-2"  name="content_fr" placeholder="content_fr" required></textarea>
                                <textarea  class="form-control my-2"  name="content_en" placeholder="content_en" required></textarea>
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