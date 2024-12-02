
<footer class="container-fluid">
        <div class="container-lg mt-4">
            <div class="row ">
                <div class="col-12 col-md-4 mb-3 text-center">
                    <h4 style="color: #252B42; margin-bottom: 25px;">
                        <?= $bddContentTexts['footer_first_menu_title']['content_fr'] ?? "Programmes" ?>
                    </h4>

                    <a class="mt-3" href="index.php"
                        style="color: #737373; text-decoration: none; font-weight: 600; font-size: 16px;">
                            <?= $bddContentTexts['nav_link_1']['content_fr'] ?? "Accueil" ?>
                        </a>
                    <br> <br>
                    <a class="mt-3" href="index.php#section2"
                        style="color: #737373; text-decoration: none; font-weight: 600; font-size: 16px;">
                        <?= $bddContentTexts['nav_link_2']['content_fr'] ?? "A propos" ?></a>
                    <br> <br>
                    <a class="mt-3" href="facilities.php"
                        style="color: #737373; text-decoration: none; font-weight: 600; font-size: 16px;">
                        <?= $bddContentTexts['nav_link_3']['content_fr'] ?? "Facilities" ?>
                    </a><br><br>
                    <a class="mt-3" href="index.php#section3"
                        style="color: #737373; text-decoration: none; font-weight: 600; font-size: 16px;">
                        <?= $bddContentTexts['nav_link_4']['content_fr'] ?? "Programmes" ?>
                    </a>
                </div>
                <div class="col-12 col-md-4 mb-3 text-center">
                    <h4 style="color: #252B42; margin-bottom: 25px;"> <?= $bddContentTexts['footer_second_menu_title']['content_fr'] ?? "Facilities" ?></h4>
                        <?php
                            
                            $stmt = $pdo->query("SELECT * FROM activities LIMIT 5");
                            $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($activities as $activity) {
                        ?>
                            <a class="mt-3" href="#" style="color: #737373; text-decoration: none; font-weight: 600; font-size: 16px;">
                                <?= $activity['name']?>
                            </a>
                            <br> <br>
                        <?php

                            }
                            if (empty($activities)) {
                                ?>

                                <a class="mt-3" href="#" style="color: #737373; text-decoration: none; font-weight: 600; font-size: 16px;">
                                    No Activity yet
                                </a>
                                <br> <br>
                            <?php
                            }
                        ?>
                </div>
                <div class="col-12 col-md-4 mb-3 text-center">
                    <h4 style="color: #252B42; margin-bottom: 25px;"><?= $bddContentTexts['footer_third_menu_title']['content_fr'] ?? 'Contacts' ?></h4>

                    <a class="mt-3" href="#"
                        style="color: #737373; text-decoration: none; font-weight: 600; font-size: 16px;"><i
                            class="bi bi-telephone me-3" style="color: #96BB7C;"></i><?= $bddContentTexts['phone_content']['content_fr'] ?? '+229 90 00 00 00'  ?> </a> </a>
                    <br>
                    <a class="mt-3" href="#"
                        style="color: #737373; text-decoration: none; font-weight: 600; font-size: 16px;"> <i
                            class="bi bi-geo-alt me-3" style="color: #96BB7C;"></i><?= $bddContentTexts['adresse_description']['content_fr'] ?? 'Ketou, Quartier Jack'  ?> </a>
                    <br>
                    <a class="mt-3" href="#"
                        style="color: #737373; text-decoration: none; font-weight: 600; font-size: 16px;"> <i
                            class="bi bi-envelope-fill me-3" style="color: #96BB7C;"></i><?= $bddContentTexts['email_description']['content_fr'] ?? 'cslketou@gmail.com'  ?> </a> </a>
                </div>
            </div>
            <br><br>
            <hr class="my-4">
            <div class="row text-center">
                <div class="col-md-6">
                    <p>CSL - KETOU Benin © 2024 | Développé par ITTIQ | Propulsé par Webtinz.</p>
                </div>
                <div class="col-md-6 lox">
                    <a href="#" style="color: #96BB7C;"><i class="bi bi-instagram mx-2"></i></a>
                    <a href="#" style="color: #96BB7C;"><i class="bi bi-twitter mx-2"></i></a>
                    <a href="#" style="color: #96BB7C;"><i class="bi bi-facebook mx-2"></i></a>
                </div>
            </div>
        </div>
    </footer>