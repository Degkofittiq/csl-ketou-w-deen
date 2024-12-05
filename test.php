<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        // Include navigation bar
        include('./includes/head.php') ;    
    ?>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <style>
        .slider-wrapper .slider-item::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            filter: grayscale(20%);
            background-image: url("image/<?= $bddContentImages['slider_container_1_1733235750']['path'] ?? "2.png" ?>");
            background-size: cover;
            background-position: center;
        }
        .slider-wrapper .slider-item:nth-child(2):before {
            background-image: url("image/<?= $bddContentImages['slider_container_2_1733235770']['path'] ?? "8.png" ?>");
        }
        .slider-wrapper .slider-item:nth-child(3):before {
            background-image: url("image/<?= $bddContentImages['slider_container_3_1733235865']['path'] ?? "2.png" ?>");
        }
        .slider-wrapper .slider-item:nth-child(4):before {
            filter: grayscale(25%) brightness(80%);
            background-image: url("image/<?= $bddContentImages['slider_container_4_1733235883']['path'] ?? "8.png" ?>");
        }

    </style>
</head>
<body>
        
    <?php
        
        // Inclure le fichier PHPMailer
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require 'vendor/autoload.php';  // Si tu utilises Composer
        
        $mail = new PHPMailer(true);  // Créer une instance de PHPMailer

        if (!empty($_POST)  && isset($_POST['btn_contact'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // name-email-subject-phone-message
                // var_dump($_POST);
                $name = $_POST['name'];
                $email = $_POST['email'];
                $subject = "No subject"; //$_POST['subject'];
                $phone = $_POST['phone'];

                // Validation des données
                if ($name == "" || $email == "" || $subject == "" || $phone == "") {
                    // echo "Tous les champs sont requis.";
                    $_SESSION['error'] =  "Tous les champs sont requis.";
                    // exit;
                }
                        
                // Vérifiez que le champ contient uniquement des chiffres ou un "+"
                if (preg_match('/^\+?[0-9]*$/', $phone)) {
                    $_SESSION['error'] = "Numéro de téléphone valide : " . htmlspecialchars($phone);
                }
                $message = "Nom: $name; Email: $email;Subject: $subject;Phone: $phone";
                // $pdo = Database::getConnection();
                
    
                // Préparation de la requête SQL pour insérer les données
                // name	email	subject	phone	message	created_at	

                $sql = "INSERT INTO contact_email (name,email,subject,phone) VALUES (?,?,?,?)";
                $stmt = $pdo->prepare($sql);
                // var_dump($stmt->execute(array($name,$email,$subject,$phone,$message)));
                // die();
                $stmt->execute(array($name,$email,$subject,$phone));
                // /*
                    try {
                        // Configuration du serveur SMTP de Gmail
                        $mail->isSMTP();                                             // Utiliser SMTP
                        $mail->Host       = 'smtp.googlemail.com';                        // Serveur SMTP de Gmail
                        $mail->SMTPAuth   = true;                                    // Activer l'authentification SMTP
                        $mail->Username   = 'degittiq229@gmail.com';               // Ton adresse Gmail
                        $mail->Password   = 'uyflekniwkslkuwi';                    // Ton mot de passe Gmail ou mot de passe d'application (voir plus bas)
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // Activer TLS
                        $mail->Port       = 587;                                     // Port SMTP pour TLS
                    
                        // Destinataires
                        $mail->setFrom('degittiq229@gmail.com', 'CSL-KETOU');
                        $mail->addAddress('destinataire@exemple.com', 'Nom du destinataire'); // Ajouter un destinataire
                    
                        // Contenu de l'email
                        $mail->isHTML(true);                                  // Définit l'email comme au format HTML
                        $mail->Subject = 'Contact Mail from CSL-KETOU';
                        $mail->Body    = $message;
                        $mail->AltBody = 'Ceci est le corps du message en texte brut pour les clients mail qui n\'acceptent pas le HTML';
                    
                        $mail->send();
                        // echo 'Le message a été envoyé avec succès';
                        $_SESSION['success'] = "Votre message a été envoyé avec succès.";
                    } catch (Exception $e) {
                        // echo "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
                        $_SESSION['error'] = "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
                    }
                // */

            }
        }
    ?>
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
                <div class="carousel-item active" style="padding: 0px;">
                    <img src="image/<?= $bddContentImages['home_banner_image']['path'] ?? "2.png" ?>" class="d-block w-100" style="height: 100vh; object-fit: cover;" alt="Slide 1">
                </div>
                <div class="carousel-item" style="padding: 0px;">
                    <img src="image/<?= $bddContentImages['home_banner_image_2']['path'] ?? "2.png" ?>" class="d-block w-100" style="height: 100vh; object-fit: cover;" alt="Slide 2">
                </div>
                <div class="carousel-item" style="padding: 0px;">
                    <img src="image/<?= $bddContentImages['home_banner_image_3']['path'] ?? "2.png" ?>" class="d-block w-100" style="height: 100vh; object-fit: cover;" alt="Slide 3">
                </div>
            </div>
        
            <!-- Navigation Buttons -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="0" class="active custom-indicator" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="1" class="custom-indicator" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="2" class="custom-indicator" aria-label="Slide 3"></button>
            </div>

            <div class="pos">
                <p><strong style="color: #61BC45; font-size:2rem;"> <?= $bddContentTexts['welcome_text']['content_fr'] ?? "Welcome to CSL Arojú Owò" ?> </strong></p>
                <h1 class="text-white" style="font-weight: 900; font-size:3.3rem;">
                <?= $bddContentTexts['text_after_welcome']['content_fr'] ?? "The Heart of <br> Sports & Leisure!" ?> 
                    
                </h1>
                <p class="text-white mt-3"><?= $bddContentTexts['second_text_after_welcome']['content_fr'] ?? "Explore a world of fitness, fun, and <br> community activities tailored for all ages." ?></p>
                <div class="row mt-4 divv">
                    <div class="col-lg-6 mb-3 mx-auto">
                        <div class="buuton">
                            <button class="btn btn-ss p-3 w-100 text-white" style="background: #61BC45; text-transform: uppercase;"  onclick="window.location.href='#section3'">
                                <?= $bddContentTexts['titre_section_activites']['content_fr'] ?? "Explore Activities" ?>
                                <i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3 mx-auto">
                        <div class="buuton">
                            <button class="btn btn-ss p-3 w-100 text-white" style="background: #61BC45; text-transform: uppercase;"  onclick="window.location.href='#section4'">
                            <?= $bddContentTexts['become_member']['content_fr'] ?? "Become A Member" ?>
                            <i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br>
    <section class="container-lg my-4" id="section3">
        <div class="row py-4 px-2">
            <div class="col-12 col-md-5 mx-auto mb-3 align-self-center">
                <h2 class="text-center fw-bold" style="text-transform: uppercase; font-size: clamp(20px, 6vw, 36px);"><?= $bddContentTexts['what_we_offer']['content_fr'] ?? "What We Offer" ?></h2>
            </div>
            <div class="col-md-4"></div>
            <div class="col-12 col-md-3 mx-auto mb-3">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-white p-3 text-white" style="background: #61BC45; font-size: clamp(16px, 3vw, 18px);" onclick="window.location.href='what.php'"><?= $bddContentTexts['view_all']['content_fr'] ?? "View all" ?>   <i class="bi bi-arrow-right-circle"></i></button>
                </div>
            </div>
        </div>

        <div class="swiper">
            <div class="card-wrapper">
              <!-- Card slides container -->
              <ul class="card-list swiper-wrapper">
                    <?php
                        $stmt = $pdo->query("SELECT * FROM activities LIMIT 5");
                        $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (!empty($activities)) {
                            foreach ($activities as $activity) {
                                ?>
                                    <li class="card-item swiper-slide">
                                        <div class="relative">
                                            <img src="image/<?= $activity['image'] ?? "3.png" ?>" alt="" class="image-fluid w-100" style="border-top-left-radius: 10px; border-top-right-radius: 10px; height: 30vh !important;object-fit:cover">
                                            <div class="ppos d-none d-lg-block">
                                                <img src="image/Group 2.png" alt="" class="image-fluid" style="width: 90%;">
                                            </div>
                                        </div>
                                        <div class="p-2" style="background-color: #F2F2F2; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                            <h2 class="mt-5 text-center fw-bold"><?php echo $activity['name'] ? implode(' ', array_slice(explode(' ', $activity['name']), 0, 1)) . '' : "Activitie Name"; ?></h2>
                                            <p class="mt-3 text-center">
                                                <?php echo $activity['description'] ? implode(' ', array_slice(explode(' ', $activity['description']), 0, 6)) . '...' : "Description"; ?>
                                            </p>
                                            <div class="mt-3">
                                                <button class="btn btn-white w-100 py-2" style="background: #FFFFFF;" data-bs-toggle="modal" data-bs-target="#Modal-<?= $activity['id'] ?>">
                                                    <?= $bddContentTexts['learn_more']['content_fr'] ?? "Learn More" ?>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                <?php
                            }
                        }
                    ?>
              </ul>
               <!-- Pagination -->
              <div class="swiper-pagination"></div>
            </div>
          </div>
    </section>
<?php

$stmt = $pdo->query("SELECT * FROM activities LIMIT 5");
$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!empty($activities)) {
    foreach ($activities as $activity) {
?>
    <div class="modal fade" id="Modal-<?= $activity['id'] ?>" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <p>
                    <?php echo $activity['description']; ?>
                </p>
            </div>
        </div>
    </div>
    </div>
<?php
    }
}

?>
    </section>
    <br><br>
    <section class="container-fluid p-4 mb-5" style="background-color: #F2F2F2;"id="upcommingEvent">
        <div class="container-lg">
            <div class="row mt-3">
                <div class="col-12 col-md-4 mx-auto mb-3">
                    <h2 class="text-center fw-bold" style="text-transform: uppercase; white-space: nowrap;"><?= $bddContentTexts['upcoming_events']['content_fr'] ?? "Upcoming Events" ?></h2>
                </div>
                <div class="col-md-6"></div>
                <div class="col-12 col-md-2 mx-auto mb-3">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-white px-3 text-white" style="background: #61BC45;" onclick="window.location.href='event.php'"><?= $bddContentTexts['view_all']['content_fr'] ?? "View all" ?> <i class="bi bi-arrow-right-circle"></i></button>
                    </div>
                </div>
            </div>

            <div class="carousel-wrap">
                <div class="owl-carousel">
                <div class="item"><img src="http://placehold.it/150x150" alt="Image 1"></div>
                <div class="item"><img src="http://placehold.it/150x150" alt="Image 2"></div>
                <div class="item"><img src="http://placehold.it/150x150" alt="Image 3"></div>
                <div class="item"><img src="http://placehold.it/150x150" alt="Image 4"></div>
                <div class="item"><img src="http://placehold.it/150x150" alt="Image 5"></div>
                <div class="item"><img src="http://placehold.it/150x150" alt="Image 6"></div>
                <div class="item"><img src="http://placehold.it/150x150" alt="Image 7"></div>
                <div class="item"><img src="http://placehold.it/150x150" alt="Image 8"></div>
                <div class="item"><img src="http://placehold.it/150x150" alt="Image 9"></div>
                </div>
            </div>

            <div class="swiper mt-4">
                <div class="slider-wrapper">
                  <div class="card-list swiper-wrapper">
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
                                <div class="card-item swiper-slide">
                                    <div class="p-2 bg-white" style="border: 1px solid #4A4A4A; border-radius: 10px;">
                                        <div class="row">
                                            <div class="col-12 mx-auto">
                                                <div class="position-relative">
                                                    <div><img src="image/<?= $event['image'] ?? "6.png" ?>" alt="" class="img-fluid w-100" style="height: 25vh;"></div>
                                                    <div class="tto">
                                                        <div class="p-2 d-flex justify-content-center align-item-center flex-column" style="background-color: #484848;">
                                                            <h2 class="text-center text-white fw-bold" style="font-size: 13px;"><?= $day ?></h2>
                                                            <div class="w-100 p-2" style="background-color: #69CC4B;">
                                                                <h4 class="text-center text-white fw-bold" style="font-size: 13px;"><?= (substr($month, 0, 3)) ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mx-auto mt-3 pb-5">
                                                <div class="text-container text-container2" onclick="toggleText(this)">
                                                    <p class="fw-bold pt-2">
                                                      <?php echo htmlspecialchars($event['name']) ? implode(' ', array_slice(explode(' ', htmlspecialchars($event['name'])), 0, 1)) . '...' : "Events Name"; ?>
                                                    </p>
                                                    <p class="text-content text-content">
                                                        <?= $event['description'] ?>
                                                    </p>
                                                    <span class="show-more" style="margin-top:10px !important;"><i class="bi bi-arrow-right-circle fs-3"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <p class="text-end me-4"><i class="bi bi-arrow-right-circle fs-3"></i></p> -->
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                                <div class="card-item swiper-slide">
                                    <div class="p-2 bg-white" style="border: 1px solid #4A4A4A; border-radius: 10px;">
                                        <div class="row">
                                            <div class="col-12 mx-auto">
                                                <div class="position-relative">
                                                    <div><img src="image/6.png" alt="" class="img-fluid w-100" style="height: 25vh;"></div>
                                                    <div class="tto">
                                                        <div class="p-2 d-flex justify-content-center align-item-center flex-column" style="background-color: #484848;">
                                                            <h2 class="text-center text-white fw-bold" style="font-size: 13px;">12</h2>
                                                            <div class="w-100 p-2" style="background-color: #69CC4B;">
                                                                <h4 class="text-center text-white fw-bold" style="font-size: 13px;">Dec 24</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mx-auto mt-3 pb-5">
                                                <div class="text-container">
                                                    <p class="text-content">
                                                        This is some very long text that will overflow and show ellipsis when the height is limited. You can click on the ellipsis to view the full content.
                                                    </p>
                                                    <span class="show-more"><i class="bi bi-arrow-right-circle fs-3"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <p class="text-end me-4"><i class="bi bi-arrow-right-circle fs-3"></i></p> -->
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                  </div>
                  <!-- <div class="swiper-pagination"></div> -->
                  <div class="swiper-slide-button swiper-button-prev"></div>
                  <div class="swiper-slide-button swiper-button-next"></div>
                </div>
              </div>
        </div>
    </section>
    <br><br>
    <section class="container-lg" id="section4">
        <div class="row">
            <?php
                    $stmt = $pdo->query("SELECT * FROM founder_bio LIMIT 1");
                    $founders = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (!empty($founders)) {
                        foreach ($founders as $founder) {
                ?>
                    <div class="col-12 col-md-6 mb-4 mb-md-0 mx-auto">
                        <img src="image/<?= $founder['path'] ?? "7.png" ?>" alt="" class="w-100 image-fluid">
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-md-0 mx-auto align-self-center text-container3">
                        <h2 class="fw-bold"><?= $bddContentTexts['about_founder']['content_fr'] ?? "About Founder" ?></h2>
                        <p class="mt-3" style="font-size: 13px; text-align: justify;">
                            <?= $founder['description'] ?>
                        </p>
                        <div class="mt-3 text-center">
                            <button class="btn btn-success toggle-button" style="width:100%">Voir plus</button>
                        </div>
                    </div>
                <?php
                    }
                }
            ?>
        </div>
    </section>
    <br><br>
    <section class="container-fluid" id="section6" style="padding-left: 0px; padding-right: 0px;">
        <div class="hero">
            <div class="p-md-5">
               <div class="p-5" style="background-color: #000000; border-radius: 10px;">
                <h2 class="fw-bold text-white"><?= $bddContentTexts['join_community']['content_fr'] ?? "Join Our Community" ?></h2>
                <form class="mt-3" action="" method="POST">
                    <div class="mb-3">
                        <input name="name" type="text" class="form-control" placeholder="Nom *" style="border-radius: 0;">
                    </div>
                    <div class="mb-3">
                        <input name="email" type="email" class="form-control" placeholder="Adresse Email *" style="border-radius: 0;">
                    </div>
                    <div class="mb-3">
                        <input name="phone" required pattern="^\+?[0-9]*$" placeholder="+229190000000" type="text" class="form-control" placeholder="Phone No.*" style="border-radius: 0;">
                    </div>
                    <div class="">
                        <button name="btn_contact" class="btn btn-white w-100 text-white" style="background: #61BC45; border-radius: 0;"><?= $bddContentTexts['join_now']['content_fr'] ?? "Join Now" ?><i class="bi bi-arrow-right-circle"></i></button>
                    </div>
                </form>
               </div>
            </div>
        </div>
    </section>
    <br><br>
    <section class="container-fluid" id="section3">
        <h2 class="fw-bold text-center mb-4"><?= $bddContentTexts['what_people_saying']['content_fr'] ?? "What People are Saying" ?></h2>
        <div class="swiper">
            <div class="card-wrapper">
              <!-- Card slides container -->
              <ul class="card-list swiper-wrapper">
                <?php
                    $stmtTestimonials = $pdo->query("SELECT * FROM testimonials");
                    $testimonials = $stmtTestimonials->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($testimonials as $testimonial) {
                        ?>

                            <li class="card-item swiper-slide ccsc">
                                <div class="">
                                    <div class="row p-5" style="background-color: #F2F2F2;">
                                        <div class="col-3 mx-auto">
                                            <img src="image/<?= $testimonial['image'] ?? "highly_recommended_image_1.png" ?>" alt="Person 1" class="img-fluid w-100">
                                        </div>
                                        <div class="col-9">
                                            <div class="d-flex">
                                                <?php 
                                                    for ($i=0; $i <  $testimonial['note']  ; $i++) { 
                                                        ?>
                                                            <span><i class="bi bi-star-fill fs-4" style="color: #464646;"></i></span>
                                                        <?php
                                                    } 
                                                ?>

                                            </div>
                                            <p><strong><?= $testimonial['title']  ?? "Highly recommended!" ?></strong></p>
                                            <p>
                                                <?= $testimonial['message']  ?? "111Nam malesuada nibh eget mi pharetra condimentum. Nam a mauris posuere, interdum mi vitae, tristique enim. Donec porta leo eget elit hendrerit" ?>
                                            </p>
                                            <p>-<?= $testimonial['name']  ?? "Alena Josksowinsigs!" ?></p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        <?php  
                        
                    }
                ?>
              </ul>
               <!-- Pagination -->
              <div class="swiper-pagination"></div>
              <!-- Navigation Buttons -->
              <!-- <div class="swiper-slide-button swiper-button-prev"></div>
              <div class="swiper-slide-button swiper-button-next"></div> -->
            </div>
        </div>
    </section>
    <br><br>
    <section class="container-fluid my-4" style="padding-left: 0px; padding-right: 0px;">
        <div class="slider-container">
        <!-- Slider List Items -->
        <div class="slider-wrapper swiper-wrapper" style="margin:0px !important;">
        <div class="slider-item swiper-slide">
            <div class="slide-content">
                <?= $bddContentTexts['first_pane_content_1']['content_fr'] ?? "aaaaaaaaaaaaaaaaaLorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, unde totam ut consequatur odio voluptatibus iusto earum fugiat labore delectus." ?>
            </div>
        </div>
        <div class="slider-item swiper-slide">
            <div class="slide-content">
                <?= $bddContentTexts['first_pane_content_2']['content_fr'] ?? "bbbbbbbbbbbbbbLorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, unde totam ut consequatur odio voluptatibus iusto earum fugiat labore delectus." ?>            
            </div>
        </div>
        <div class="slider-item swiper-slide">
            <div class="slide-content">
                <?= $bddContentTexts['first_pane_content_3']['content_fr'] ?? "ccccccccccccccccLorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, unde totam ut consequatur odio voluptatibus iusto earum fugiat labore delectus." ?>            
            </div>
        </div>
        <div class="slider-item swiper-slide">
            <div class="slide-content">
                <?= $bddContentTexts['first_pane_content_4']['content_fr'] ?? "ddddddddddddddddddddddLorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, unde totam ut consequatur odio voluptatibus iusto earum fugiat labore delectus." ?>            
            </div>
        </div>
        </div>

        <!-- Slider Pagination -->
        <div class="slider-controls">
        <ul class="slider-pagination">
            <div class="slider-indicator"></div>
            <li class="slider-tab current"><?= $bddContentTexts['first_pane_tittle_1']['content_fr'] ?? "Football fields" ?></li>
            <li class="slider-tab"><?= $bddContentTexts['first_pane_tittle_2']['content_fr'] ?? "Gym & dance studio" ?></li>
            <li class="slider-tab"><?= $bddContentTexts['first_pane_tittle_3']['content_fr'] ?? "Event spaces" ?></li>
            <li class="slider-tab"><?= $bddContentTexts['first_pane_tittle_4']['content_fr'] ?? "Cultural hall" ?></li>
        </ul>
        </div>

        <!-- Slider Navigations (Prev/Next) -->
        <div class="slider-navigations">
        <button id="slide-prev" class="material-symbols-rounded">Droite</button>
        <button id="slide-next" class="material-symbols-rounded">Gauche</button>
        </div>
    </div>
    </section>
    
    <?php
        // Include navigation bar
        include('./includes/footer.php') ;    
    ?>
<!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper('.card-wrapper', {
        loop: true,
        spaceBetween: 30,
        // Pagination bullets
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true
        },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        // Responsive breakpoints
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            1024: {
                slidesPerView: 3
            }
        }
    });
    </script>
    <!--  -->
      <script>
        const swiper = new Swiper('.slider-wrapper', {
            loop: true,
            grabCursor: true,
            spaceBetween: 30,
            // Pagination bullets
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true
            },
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            // Responsive breakpoints
            breakpoints: {
                0: {
                slidesPerView: 1
                },
                768: {
                slidesPerView: 2
                },
                1024: {
                slidesPerView: 3
                }
            }
            });
      </script>

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

<script>
    const sliderControls = document.querySelector(".slider-controls");
    const sliderTabs = sliderControls.querySelectorAll(".slider-tab");
    const sliderIndicator = sliderControls.querySelector(".slider-indicator");

    // Update the indicator
    const updateIndicator = (tab, index) => {
    document.querySelector(".slider-tab.current")?.classList.remove("current");
    tab.classList.add("current");

    sliderIndicator.style.transform = `translateX(${tab.offsetLeft - 20}px)`;
    sliderIndicator.style.width = `${tab.getBoundingClientRect().width}px`;

    // Calculate the scroll position and scroll smoothly
    const scrollLeft = sliderTabs[index].offsetLeft - sliderControls.offsetWidth / 2 + sliderTabs[index].offsetWidth / 2;
    sliderControls.scrollTo({ left: scrollLeft, behavior: "smooth" });
    }

    // Initialize swiper instance
    const swiper = new Swiper(".slider-container", {
    effect: "fade",
    speed: 1300,
    autoplay: { delay: 4000 },
    navigation: {
        prevEl: "#slide-prev",
        nextEl: "#slide-next",
    },
    on: {
        // Update indicator on slide change
        slideChange: () => {
        const currentTabIndex = [...sliderTabs].indexOf(sliderTabs[swiper.activeIndex]);
        updateIndicator(sliderTabs[swiper.activeIndex], currentTabIndex);
        },
        reachEnd: () => swiper.autoplay.stop(),
    },
    });

    // Update the slide on tab click
    sliderTabs.forEach((tab, index) => {
    tab.addEventListener("click", () => {
        swiper.slideTo(index);
        updateIndicator(tab, index);
    });
    });

    updateIndicator(sliderTabs[0], 0);
    window.addEventListener("resize", () => updateIndicator(sliderTabs[swiper.activeIndex], 0));
  </script>
      <script>
        document.querySelector('.show-more').addEventListener('click', function () {
            const textContainer = this.closest('.text-container');
            textContainer.classList.toggle('expanded');
            if (textContainer.classList.contains('expanded')) {
                this.textContent = '...'; // Réinitialise les points de suspension
            } else {
                this.textContent = '...'; // Affiche les points de suspension lorsque le texte est masqué
            }
        });
    </script>
    <script>
        document.querySelector('.more').addEventListener('click', function () {
            const textContainer = this.closest('.text-container');
            textContainer.classList.toggle('expanded');
            if (textContainer.classList.contains('expanded')) {
                this.textContent = '...'; // Réinitialise les points de suspension
            } else {
                this.textContent = '...'; // Affiche les points de suspension lorsque le texte est masqué
            }
        });
    </script>
    <script>
        document.querySelector('.more1').addEventListener('click', function () {
            const textContainer = this.closest('.text-container');
            textContainer.classList.toggle('expanded');
            if (textContainer.classList.contains('expanded')) {
                this.textContent = '...'; // Réinitialise les points de suspension
            } else {
                this.textContent = '...'; // Affiche les points de suspension lorsque le texte est masqué
            }
        });
    </script>
    <script>
        document.querySelector('.more2').addEventListener('click', function () {
            const textContainer = this.closest('.text-container');
            textContainer.classList.toggle('expanded');
            if (textContainer.classList.contains('expanded')) {
                this.textContent = '...'; // Réinitialise les points de suspension
            } else {
                this.textContent = '...'; // Affiche les points de suspension lorsque le texte est masqué
            }
        });
    </script>
    


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


 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- OwlCarousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
  $(document).ready(function () {
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      navText: [
        "<i class='bi bi-chevron-left fs-4'></i>",
        "<i class='bi bi-chevron-right  fs-4'></i>"
      ],
      autoplay: true,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 2
        },
        1000: {
          items: 3
        }
      }
    });
  });
</script>
</body>
</html>