<?php
    require('./config/database.php');

    // Exécution de la requête SQL
    $sql = "SELECT * FROM content_text_management";
    $stmt = $pdo->query($sql);

    // Récupération des résultats
    $bddContentTexts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Exécution de la requête SQL
    $sql = "SELECT * FROM content_text_management";
    $stmt = $pdo->query($sql);

    // Récupération des résultats et organisation dans un tableau associatif avec le 'name' comme clé
    $bddContentTexts = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $bddContentTexts[$row['name']] = $row;
    }

    // Exécution de la requête SQL pour récupérer les images
    $sql2 = "SELECT * FROM content_image_management";
    $stmt2 = $pdo->query($sql2);

    // Récupération des résultats et organisation dans un tableau associatif avec le 'name' comme clé
    $bddContentImages = [];
    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $bddContentImages[$row['name']] = $row;
    }
?>
<section class="container-fluid p-3">
        <nav class="navbar navbar-expand-lg navbar-custom sor">
            <div class="container-lg">
                <!-- Logo Section -->
                <a class="navbar-brand" href="#">
                    <img src="image/image_2024_11_20T09_52_44_168Z-removebg-preview.png" alt="" class="img-fluid log">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon "></span>
                </button>
                <!-- Links Section -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" style="font-weight: 700;" href="index.php">
                                <?= $bddContentTexts['nav_link_1']['content_fr'] ?? "Acceuil" ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="font-weight: 700;" href="index.php#section2">
                                <?= $bddContentTexts['nav_link_2']['content_fr'] ?? "A propos" ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="font-weight: 700;" href="facilities.php">
                                <?= $bddContentTexts['nav_link_3']['content_fr'] ?? "Facilities" ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="font-weight: 700;" href="index.php#section3">
                                <?= $bddContentTexts['nav_link_4']['content_fr'] ?? "Programmes" ?>
                        </a>
                        </li>
                    </ul>
                    <div class="d-lg-none">
                        <div class="d-flex">
                            <button class="btn btn-white px-3 text-white" style="background: #96BB7C; border-radius: 0;"
                                onclick="window.location.href='contact.php'">NOUS CONTACTER <i
                                    class="bi bi-arrow-right-short ms-4"></i></button>
                        </div>
                    </div>
                </div>
                <!-- Login Section -->
                <div class="d-none d-lg-block">
                    <div class="d-flex">
                        <button class="btn btn-success btn-sm btn-white p-2 text-white" 
                            onclick="window.location.href='contact.php'">
                                <?= $bddContentTexts['nav_link_5']['content_fr'] ?? "JOIN US" ?>
                             <!-- <i class="bi bi-arrow-right-short ms-4"></i> -->
                            </button>
                    </div>
                </div>
            </div>
        </nav>
        <svg class="svv" width="286" height="324" viewBox="0 0 286 324" fill="#96bb7c" xmlns="http://www.w3.org/2000/svg">
            <path d="M89.2696 311.163C71.3979 303.157 55.2107 291.411 41.6639 276.618C28.3999 262.001 17.9658 244.738 10.9582 225.816C3.51029 205.598 -0.207592 184.036 0.00894216 162.313C-0.129882 140.007 3.91675 117.897 11.9104 97.2865C19.4194 78.25 30.3804 60.985 44.1632 46.4844C57.7869 31.9809 73.9665 20.4986 91.7689 12.7006C110.645 4.38942 130.856 0.075813 151.276 7.33504e-05C164.738 -0.0135285 178.143 1.86463 191.146 5.58756C203.616 9.28606 215.608 14.6185 226.85 21.4632C237.967 28.117 248.178 36.365 257.199 45.9759C266.383 55.6076 274.382 66.4484 281.001 78.2357L233.396 111.003C225.487 95.4925 214.277 82.1815 200.667 72.1397C186.205 62.2572 169.272 57.2966 152.109 57.9152C138.765 57.7702 125.53 60.4898 113.191 65.915C101.681 70.9711 91.2391 78.4441 82.4858 87.8882C73.7651 97.3622 66.8887 108.585 62.2533 120.909C57.3374 133.944 54.8707 147.882 54.9935 161.932C54.8802 175.775 57.348 189.504 62.2533 202.32C66.8964 214.505 73.6835 225.627 82.2477 235.087C90.8853 244.535 101.203 252.048 112.596 257.186C124.691 262.587 137.689 265.31 150.8 265.187C169.369 265.813 187.625 259.972 202.809 248.549C216.966 237.539 228.303 222.909 235.776 206.002L286 234.071C279.538 247.244 271.54 259.491 262.197 270.522C253.064 281.474 242.574 291.045 231.015 298.971C219.28 307.103 206.488 313.35 193.05 317.513C179.46 321.857 165.344 324.04 151.157 323.991C129.927 324.232 108.872 319.867 89.2696 311.163Z" fill="#96bb7c"/>
            </svg>
    </section>