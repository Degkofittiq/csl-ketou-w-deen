<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        // Include navigation bar
        include('./includes/head.php') ;    
    ?>    
    <title>Événements</title>
    <style>
        .her {
            background-image: url('image/<?= $bddContentImages['home_banner_image']['path'] ?? "2.png" ?>');
            background-size: cover;
            background-position: center;
            height: 70vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        @media (max-width: 1250px) {
            .her {
                height: 40vh;
            }
        }
    </style>
</head>
<body>
    
    <section class="container-fluid">
        <?php
            // Include navigation bar
            include('./includes/navbar.php') ;    
        ?>
    </section>
    <section class="container-fluid" id="section1" style="padding-left: 0px; padding-right: 0px;">
        <div class="her position-relative">
            <div class="pos">
                    <p><strong style="color: #61BC45; font-size:2rem;"> <?= $bddContentTexts['welcome_text']['content_fr'] ?? "Welcome to CSL Arojú Owò" ?> </strong></p>
                    <h1 class="text-white" style="font-weight: 900;  font-size: clamp(20px, 10vw, 56px); text-transform:uppercase;">
                    <?= $bddContentTexts['upcoming_events']['content_fr'] ?? "Upcoming Events" ?>
                        
                    </h1>
                    <p class="text-white mt-3" style=" font-size: clamp(16px, 3vw, 18px); max-width:90%"><?= $bddContentTexts['explore_text']['content_fr'] ?? "Explore a world of fitness, fun, and <br> community activities tailored for all ages." ?></p>
                    <!-- <div class="row mt-4 divv">
                        <div class="col-lg-6 mb-3 mx-auto">
                            <div class="buuton">
                                <button class="btn btn-ss py-3 px-5 text-white fw-bold" style="background: #61BC45; text-transform: uppercase;  font-size:16px;"  onclick="window.location.href='#section3'">
                                    <?= $bddContentTexts['titre_section_activites']['content_fr'] ?? "Explore Activities" ?>
                                    <i class="bi bi-arrow-right-circle"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3 mx-auto">
                            <div class="buuton">
                                <button class="btn btn-ss py-3 px-5 text-white fw-bold" style="background: #61BC45; text-transform: uppercase;"  onclick="window.location.href='#section4'">
                                <?= $bddContentTexts['become_member']['content_fr'] ?? "Become A Member" ?>
                                <i class="bi bi-arrow-right-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div> -->
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
                            $year = strftime('%y', $date->getTimestamp()); // Année en deux chiffres (ex: 24)
                        ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="pb-5 pt-5 px-2 bg-white" style=" border: 1px solid #4A4A4A; border-radius: 10px; height: 80%;">
                                <div class="row">
                                    <div class="col-5 mx-auto">
                                        <div class="position-relative">
                                            <div><img src="image/<?= $event['image'] ?? "6.png" ?>" alt="" class="img-fluid w-100 h-100"></div>
                                            <div class="tto">
                                                <div class="p-2 d-flex justify-content-center align-item-center flex-column" style="background-color: #484848;">
                                                    <h2 class="text-center text-white fw-bold" style="font-size: 13px;"><?= $day ?></h2>
                                                    <div class="w-100 p-2" style="background-color: #69CC4B;">
                                                        <h4 class="text-center text-white fw-bold" style="font-size: 13px;"><?= (substr($month, 0, 3)) ?> <?= (substr($year, 0, 3)) ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-7 mx-auto pb-5" style="margin-top:-10px;">
                                        <div class="text-container text-container2" onclick="toggleText(this)">
                                            <p class="fw-bold pt-2" style="margin-bottom:5px !important;">
                                            <?= $event['name'] ? $event['name'] : "Events Name"; ?>
                                            </p>
                                            <p class="text-content text-content">
                                                <?= $event['description'] ?>
                                            </p>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <span class=" mt-3"><i class="bi bi-arrow-right-circle fs-3"></i></span>
                                        </div>
                                    </div>
                                </div>
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