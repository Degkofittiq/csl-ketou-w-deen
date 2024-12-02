<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        // Include navigation bar
        include('./includes/head.php') ;    
    ?>    
</head>
<body>
    
    <section class="container-fluid">
        <?php
            // Include navigation bar
            include('./includes/navbar.php') ;    
        ?>
    </section>
    <section class="container-fluid" id="section1" style="padding-left: 0px; padding-right: 0px;">
        <div id="customCarousel" class="carousel slide position-relative" data-bs-ride="carousel">
            <!-- Carousel Items -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="image/<?= $bddContentImages['home_banner_image']['image'] ?? "2.png" ?>" class="d-block w-100" style="height: 60vh; object-fit: cover;" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="image/<?= $bddContentImages['home_banner_image_2']['image'] ?? "2.png" ?>" class="d-block w-100" style="height: 60vh; object-fit: cover;" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="image/<?= $bddContentImages['home_banner_image_3']['image'] ?? "2.png" ?>" class="d-block w-100" style="height: 60vh; object-fit: cover;" alt="Slide 3">
                </div>
            </div>
        
            <!-- Navigation Buttons -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="0" class="active custom-indicator" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="1" class="custom-indicator" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="2" class="custom-indicator" aria-label="Slide 3"></button>
            </div>

            <div class="pos">
                <h1 class="text-white" style="font-weight: 900;">
                    <?= $bddContentTexts['upcoming_events']['content_fr'] ?? "Upcoming Events" ?>
                </h1>
                <p class="text-white"><?= $bddContentTexts['explore_text']['content_fr'] ?? "Explore a world of fitness, fun, and <br> community activities tailored for all ages." ?></p>
                <div class="row mt-3">
                    <div class="col-12 col-md-6 mb-3 mb-md-0 mx-auto">
                        <div>
                            <button class="btn px-3 text-white" style="background: #61BC45; text-transform: uppercase; white-space: nowrap;"  onclick="window.location.href='index.php#section3'">
                            <?= $bddContentTexts['titre_section_activites']['content_fr'] ?? "Decouvrez nos activites" ?><i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3 mb-md-0 mx-auto">
                        <div>
                            <button class="btn px-3 text-white" style="background: #61BC45; text-transform: uppercase; white-space: nowrap;"  onclick="window.location.href='index.php#section4'">
                            <?= $bddContentTexts['become_member']['content_fr'] ?? "Become A Member" ?> <i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="my-5 container-lg">
        <div class="row mt-4">
            <?php
                $stmt = $pdo->query("SELECT * FROM events LIMIT 5");
                $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($events)) {
                    foreach ($events as $event) {
                            // Récupérer la date de l'événement
                            $eventDate = $event['date'];
                            $date = new DateTime($eventDate);

                            // Extraire le jour et le mois
                            $day = $date->format('j'); // Jour (ex: 13)
                            setlocale(LC_TIME, 'fr_FR.UTF-8'); // Activer la locale française
                            $month = strftime('%B', $date->getTimestamp()); // Mois en français (ex: avril)
                        ?>
                            <div class="col-lg-4 mx-auto mb-4">
                                <div class="p-3 bg-white" style="border: 1px solid #4A4A4A; border-radius: 10px;">
                                    <div class="row">
                                        <div class="col-6 mx-auto">
                                            <div class="position-relative">
                                                <div><img src="image/6.png" alt="" class="img-fluid w-100" style="height: 25vh;"></div>
                                                <div class="tto">
                                                    <div class="p-2 d-flex justify-content-center align-item-center flex-column" style="background-color: #484848;">
                                                        <h2 class="text-center text-white fw-bold"><?= $day ?></h2>
                                                        <div class="w-100 p-2" style="background-color: #69CC4B;">
                                                            <h4 class="text-center text-white fw-bold"><?= (substr($month, 0, 3)) ?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mx-auto">
                                            <p class="fw-bold pt-2">
                                                <?= htmlspecialchars($event['name']) ?>
                                            </p>
                                            <p class="mt-3 break">
                                                <?= $event['description'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="text-end me-4"><i class="bi bi-arrow-right-circle fs-3"></i></p>
                                </div>
                            </div>
                        <?php
                    }
                }
            ?>
        </div>
    </section>
    <?php
        // Include navigation bar
        include('./includes/footer.php') ;    
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.querySelectorAll('.search-link').forEach(link => {
          link.addEventListener('click', function(event) {
            event.preventDefault();
      
            // Retirer la classe active de tous les liens
            document.querySelectorAll('.search-link').forEach(l => l.classList.remove('active'));
      
            // Ajouter la classe active au lien cliqué
            this.classList.add('active');
      
            // Masquer tous les contenus
            document.querySelectorAll('.search-content').forEach(content => content.style.display = 'none');
      
            // Afficher le contenu correspondant à l'onglet cliqué
            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).style.display = 'block';
          });
        });
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>