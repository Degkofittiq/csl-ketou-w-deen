<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        // Include navigation bar
        include('./includes/head.php') ;    
    ?>    
    <title>A propos</title>
    <style>
        .her {
            background-image: url('image/<?= $bddContentImages['home_banner_image']['path'] ?? "2.png" ?>');
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        @media (max-width: 1250px) {
            .her {
                height: 40vh;
            }
            .her .pos{
                margin-top: 4rem;
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
                <h1 class="text-white" style="font-weight: 900;">
                    <?= $bddContentTexts['nav_link_2']['content_fr'] ?? "A propos de nous" ?>
                </h1>
                <p class="text-white"><?= $bddContentTexts['explore_text']['content_fr'] ?? "Explore a world of fitness, fun, and <br> community activities tailored for all ages." ?></p>
                <!-- <div class="row mt-3">
                    <div class="col-12 col-md-6 mb-3 mb-md-0 mx-auto">
                        <div>
                            <button class="btn px-3 text-white" style="background: #61BC45; text-transform: uppercase; white-space: nowrap;"  onclick="window.location.href='index.php#section3'">
                            <?= $bddContentTexts['titre_section_activites']['content_fr'] ?? "Decouvrez nos activites" ?> <i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3 mb-md-0 mx-auto">
                        <div>
                            <button class="btn px-3 text-white" style="background: #61BC45; text-transform: uppercase; white-space: nowrap;"  onclick="window.location.href='index.php#section4'">
                            <?= $bddContentTexts['become_member']['content_fr'] ?? "Become A Member" ?><i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </div>
                </div> -->
                    <!--  -->
                </div>
        </div>
    </section>

    <section class="my-5 container-lg">
        <div class="row">
            <div class="col-lg-6 mx-auto mb-3 mb-md-0">
                    <?php                                              
                        $stmt = $pdo->query("SELECT * FROM founder_bio LIMIT 1");
                        $founder = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                <div class="">
                    <img src="image/<?= $founder['image'] ?? '7.png' ?>" alt="" class="image-fluid w-100">
                </div>
            </div>
            <div class="col-lg-6 mx-auto mb-3 mb-md-0 align-self-center text-container3">
    <h2 class="fw-bold"><?= $bddContentTexts['about_founder']['content_fr'] ?? "About Founder" ?></h2>
    <p class="mt-3" style="font-size: 13px; text-align: justify;">
    <?=  strip_tags($founder['description'], '<b><i><p><br>'); ?>
    </p>
    <div class="mt-3">
        <button class="btn btn-succ toggle-button text-white px-4 py-2" style="background-color: #61BC45;">Voir plus</button>
    </div>
</div>
        </div>
    </section>

    <?php
        // Include navigation bar
        include('./includes/footer.php') ;    
    ?>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paragraph = document.querySelector('.text-container3 p');
        const toggleButton = document.querySelector('.toggle-button');

        toggleButton.addEventListener('click', function() {
            paragraph.classList.toggle('expanded');
            
            toggleButton.textContent = paragraph.classList.contains('expanded') 
                ? 'Réduire' 
                : 'Voir plus';
        });
    });
</script>
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