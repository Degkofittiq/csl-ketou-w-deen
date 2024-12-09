<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        // Include navigation bar
        include('./includes/head.php') ;    
    ?>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <title>Accueil</title>
    <style>
        /* carousel4 image */
        .xyz_custom_content {
        background-image: url(./image/8.png); /* Image par défaut */
        background-size: cover;
        background-position: center;
        color: white;
        height: 70vh;
        display: flex;
        align-items: center;
        /* justify-content: center; */
        }

        .xyz_custom_text {
        font-size: 20px;
        text-align: justify;
        }
        @media (max-width: 1000px) {
            .xyz_link_element {
                padding: 20px 10px !important;
            }
        }
        @media (max-width: 500px) {
            .xyz_custom_text {
                font-size: 16px;
            }
        }
        /* Liste de liens - Fixée en haut et centrée */
        .xyz_links_section {
        display: flex;
        justify-content: center; /* Centrer les éléments horizontalement */
        position: absolute;
        left: 50%;
        transform: translateX(-50%); /* Centrer la liste de liens */
        background-color: transparent;
        z-index: 10;
        }

        .xyz_link_element {
        padding: 20px 60px;
        cursor: pointer;
        color: white;
        transition: border-bottom 0.3s ease;
        border-bottom: 1px solid white;        
        text-transform: uppercase;
        }

        .xyz_link_element.selected {
        border-bottom: 3px solid white; /* Bordure active sous le lien */
        font-weight: 800;
        }

        .swiper-wrapper.personnalise {
            display: flex;
            overflow: hidden;
            gap: 20px; /* Espacement entre les blocs */
        }
        .swiper-slide.personnalise  {
            flex: 0 0 50%; /* Chaque bloc occupe 50% de l'espace */
            box-sizing: border-box; /* Inclure padding et bordure dans la largeur */
            transition: transform 0.3s ease-in-out; /* Pour les animations */
        }
        @media (max-width: 768px) {
            .swiper-slide.personnalise  {
                flex: 0 0 100%; /* 1 bloc visible sur petits écrans */
            }
        }


        .her {
            background-image: url('image/<?= $bddContentImages['home_banner_image']['path'] ?? "2.png" ?>');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        @media (max-width: 1500px) {
            .text-container3 p {
                max-height: 80vh;
                overflow: hidden;
                position: relative;
            }
        }
        @media (min-width: 1500px) {
            .text-container3 p {
                max-height: 60vh;
                overflow: hidden;
                position: relative;
            }
        }

.text-container3 p::after {
    content: '...';
    position: absolute;
    bottom: 0;
    right: 0;
}
.text-container3 p.expanded {
    max-height: none;
}
.text-container3 p.expanded::after {
    display: none;
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
        <div class="her position-relative">
            <div class="pos">
                    <p><strong style="color: #61BC45; font-size:2rem;"> <?= $bddContentTexts['welcome_text']['content_fr'] ?? "Welcome to CSL Arojú Owò" ?> </strong></p>
                    <h1 class="text-white" style="font-weight: 900;  font-size: clamp(20px, 10vw, 56px); text-transform:uppercase;">
                    <?= $bddContentTexts['text_after_welcome']['content_fr'] ?? "The Heart of <br> Sports & Leisure!" ?> 
                        
                    </h1>
                    <p class="text-white mt-3" style=" font-size: clamp(16px, 3vw, 18px); max-width:90%"><?= $bddContentTexts['second_text_after_welcome']['content_fr'] ?? "Explore a world of fitness, fun, and <br> community activities tailored for all ages." ?></p>
                    <div class="row mt-4 divv">
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
                                <button class="btn btn-ss py-3 px-4 text-white fw-bold" style="background: #61BC45; text-transform: uppercase;"  onclick="window.location.href='#section4'">
                                <?= $bddContentTexts['become_member']['content_fr'] ?? "Become A Member" ?>
                                <i class="bi bi-arrow-right-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div id="customCarousel" class="carousel slide position-relative" data-bs-ride="carousel">
            
            <!-- <div class="carousel-inner">
                <div class="carousel-item active" style="padding: 0px;">
                    <img src="image/<?= $bddContentImages['home_banner_image']['path'] ?? "2.png" ?>" class="d-block w-100" style="object-fit: cover;" alt="Slide 1">
                </div>
                <div class="carousel-item" style="padding: 0px;">
                    <img src="image/<?= $bddContentImages['home_banner_image_2']['path'] ?? "2.png" ?>" class="d-block w-100" style="object-fit: cover;" alt="Slide 2">
                </div>
                <div class="carousel-item" style="padding: 0px;">
                    <img src="image/<?= $bddContentImages['home_banner_image_3']['path'] ?? "2.png" ?>" class="d-block w-100" style="object-fit: cover;" alt="Slide 3">
                </div>
            </div>
 
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="0" class="active custom-indicator" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="1" class="custom-indicator" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="2" class="custom-indicator" aria-label="Slide 3"></button>
            </div>

            <div class="pos">
                <p><strong style="color: #61BC45; font-size:2rem;"> <?= $bddContentTexts['welcome_text']['content_fr'] ?? "Welcome to CSL Arojú Owò" ?> </strong></p>
                <h1 class="text-white" style="font-weight: 900;  font-size: clamp(20px, 10vw, 56px);">
                <?= $bddContentTexts['text_after_welcome']['content_fr'] ?? "The Heart of <br> Sports & Leisure!" ?> 
                    
                </h1>
                <p class="text-white mt-3" style=" font-size: clamp(16px, 3vw, 18px);"><?= $bddContentTexts['second_text_after_welcome']['content_fr'] ?? "Explore a world of fitness, fun, and <br> community activities tailored for all ages." ?></p>
                <div class="row mt-4 divv">
                    <div class="col-lg-6 mb-3 mx-auto">
                        <div class="buuton">
                            <button class="btn btn-ss p-3 w-100 text-white" style="background: #61BC45; text-transform: uppercase;  font-size: clamp(14px, 3vw, 14px);"  onclick="window.location.href='#section3'">
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
        </div> -->
    </section>
    <br><br>
    <section class="container-lg my-4" id="section3">
        <div class="row py-4 px-2">
            <div class="col-12 col-md-3 mx-auto mb-3 align-self-center">
                <h2 class="text-center fw-bold" style="text-transform: uppercase; font-size: clamp(20px, 6vw, 36px);"><?= $bddContentTexts['what_we_offer']['content_fr'] ?? "What We Offer" ?></h2>
            </div>
            <div class="col-md-7"></div>
            <div class="col-12 col-md-2 mx-auto mb-3">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-white px-4  py-3 text-white fw-bold" style="background: #61BC45; font-size: clamp(16px, 3vw, 18px);" onclick="window.location.href='what.php'"><?= $bddContentTexts['view_all']['content_fr'] ?? "View all" ?>   <i class="bi bi-arrow-right-circle"></i></button>
                </div>
            </div>
        </div>
            <!-- carousel3 -->
            <div class="custom-carousel-wrapper my-4" style="padding-bottom: 30px;">
                <div class="custom-carousel-content">
                    <?php
                        $stmt = $pdo->query("SELECT * FROM activities LIMIT 5");
                        $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (!empty($activities)) {
                            foreach ($activities as $activity) {
                                ?>
                                    <div class="custom-carousel-item firstCarousel">
                                        <div class="relative">
                                            <img src="image/<?= $activity['image'] ?? "3.png" ?>" alt="" class="image-fluid w-100" style="border-top-left-radius: 10px; border-top-right-radius: 10px; height: 30vh !important;object-fit:cover">
                                            <div class="ppos d-none d-lg-block">
                                                <img src="image/Group 8.png" alt="" class="image-fluid" style="width: 90%;">
                                            </div>
                                        </div>
                                        <div class="p-2" style="background-color: #F2F2F2; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                            <h2 class="mt-5 text-center fw-bold"><?= $activity['name'] ? $activity['name'] : "Activitie Name"; ?></h2>
                                            <p class="mt-3 text-center"><?php echo $activity['description'] ? implode(' ', array_slice(explode(' ', $activity['description']), 0, 6)) . '...' : "Description"; ?></p>
                                            <div class="mt-3">
                                                <button class="btn btn-white w-100 py-2" style="background: #FFFFFF;" data-bs-toggle="modal" data-bs-target="#Modal-<?= $activity['id'] ?>">
                                                <?= $bddContentTexts['learn_more']['content_fr'] ?? "Learn More" ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    ?>
                </div>

                <div class="custom-navigation-buttons">
                    <button class="custom-navigation-button custom-prev" style="display: none;">&#8249;</button>
                    <button class="custom-navigation-button custom-next" style="display: none;">&#8250;</button>
                </div>

                <div class="custom-pagination-container mt-5"></div>
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
        <div class="container-lg position-relative">
            <div class="row mt-3">
                <div class="col-12 col-md-4 col-lg-4 mx-auto mb-3 align-self-center">
                    <h2 class="text-center fw-bold" style="text-transform: uppercase;  font-size: clamp(20px, 6vw, 36px);"><?= $bddContentTexts['upcoming_events']['content_fr'] ?? "Upcoming Events" ?></h2>
                </div>
                <div class="col-md-6 col-lg-6"></div>
                <div class="col-12 col-md-2 col-lg-2 mx-auto mb-3">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-white px-4  py-3 text-white fw-bold" style="background: #61BC45; font-size: clamp(16px, 3vw, 18px);" onclick="window.location.href='event.php'"><?= $bddContentTexts['view_all']['content_fr'] ?? "View all" ?> <i class="bi bi-arrow-right-circle"></i></button>
                    </div>
                </div>
            </div>
            <!-- carousel2 -->
            <div class="unique-carousel-container">
                <div class="unique-carousel">
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
                                    <div class="unique-carousel-item">
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
                                                    <div class="d-flex justify-content-end">
                                                        <span class=" mt-3"><i class="bi bi-arrow-right-circle fs-3"></i></span>
                                                    </div>
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
            </div>
            
                            <div class="unique-carousel-buttons">
                                <button class="unique-carousel-button unique-prev">&#8249;</button>
                                <button class="unique-carousel-button unique-next">&#8250;</button>
                            </div>
                            <div class="unique-carousel-pagination" style="display: none;"></div>
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
  <div class="col-12 col-md-6 mb-4 mb-md-0 mx-auto align-self-center">
    <img src="image/<?= htmlspecialchars($founder['image'] ?? "7.png", ENT_QUOTES, 'UTF-8') ?>" alt="Image du fondateur" class="w-100 img-fluid">
</div>
<div class="col-12 col-md-6 mb-4 mb-md-0 mx-auto align-self-center text-container3">
    <h2 class="fw-bold"><?= strip_tags($bddContentTexts['about_founder']['content_fr'] ?? "About Founder", '<b><i><p><br>') ?></h2>
    <p class="mt-3" style="font-size: 16px; text-align: justify;">
        <?=  strip_tags($founder['description'], '<b><i><p><br>'); ?>
    </p>
    <div class="mt-3">
        <button class="btn btn-succ toggle-button text-white px-4 py-3 fw-bold" style="background-color: #61BC45; padding-right: 5rem !important; padding-left: 5rem !important;" aria-expanded="false">Voir plus</button>
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
                <h2 class="fw-bold text-white" style=" font-size: clamp(20px, 8vw, 36px);"><?= $bddContentTexts['join_community']['content_fr'] ?? "Join Our Community" ?></h2>
                <form class="mt-3" action="" method="POST">
                    <div class="mb-3">
                        <input name="name" type="text" class="form-control py-3" placeholder="Nom *" style="border-radius: 0;">
                    </div>
                    <div class="mb-3">
                        <input name="email" type="email" class="form-control py-3" placeholder="Adresse Email *" style="border-radius: 0;">
                    </div>
                    <div class="mb-3">
                        <input name="phone" required pattern="^\+?[0-9]*$" placeholder="+229190000000" type="text" class="form-control py-3" placeholder="Phone No.*" style="border-radius: 0;">
                    </div>
                    <div class="">
                        <button name="btn_contact" class="btn btn-white w-100 text-white py-3" style="background: #61BC45; border-radius: 0;  font-size: clamp(20px, 8vw, 26px);"><?= $bddContentTexts['join_now']['content_fr'] ?? "Join Now" ?><i class="bi bi-arrow-right-circle"></i></button>
                    </div>
                </form>
               </div>
            </div>
        </div>
    </section>
    <br><br>
    
    <section class="container-fluid" id="section3">
        <h2 class="fw-bold text-center mb-4"><?= $bddContentTexts['what_people_saying']['content_fr'] ?? "What People are Saying" ?></h2>
        <div class="akaa-carousel-wrapper" style="margin: bottom 30px !important;">
            <div class="akaa-carousel-inner" >
                <!-- <div class="akaa-carousel-item"><img src="images/8.png" alt="Item 1"></div> -->
                <?php
                $stmtTestimonials = $pdo->query("SELECT * FROM testimonials");
                $testimonials = $stmtTestimonials->fetchAll(PDO::FETCH_ASSOC);
                foreach ($testimonials as $testimonial) {
                ?>
                    <li class="akaa-carousel-item custom-carousel-item ccsc mx-1 col-6" style="list-style: none">
                        <div class="row p-5" style="background-color: #F2F2F2; height: 100% !important;min-height: 100% !important;">
                            <div class="col-12 col-md-3 mx-auto">
                                <img src="image/<?= $testimonial['image'] ?? "highly_recommended_image_1.png" ?>" alt="Person 1" class="img-fluid" style="border-radius: 50% !important; height:100px; width:100px; object-fit:cover;">
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="d-flex">
                                    <?php 
                                    for ($i = 0; $i < $testimonial['note']; $i++) { ?>
                                        <span><i class="bi bi-star-fill fs-4" style="color: #464646;"></i></span>
                                    <?php } ?>
                                </div>
                                <p><strong><?= $testimonial['title'] ?? "Highly recommended!" ?></strong></p>
                                <p><?= $testimonial['message'] ?? "111Nam malesuada nibh eget mi pharetra condimentum." ?></p>
                                <p class="fw-bold">-<?= $testimonial['name'] ?? "Alena Josksowinsigs!" ?></p>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </div>

            <div class="akaa-navigation-buttons">
                <button class="akaa-navigation-button akaa-prev" style="display:none !important;">&#8249;</button>
                <button class="akaa-navigation-button akaa-next" style="display:none !important;">&#8250;</button>
            </div>
            <div class="h-25" style="min-height:20px !important"></div>
            <div class="akaa-pagination-container mt-4"></div>
        </div>

    </section>
    <br><br>
    <section class="container-fluid my-4" style="padding-left: 0px; padding-right: 0px;">

    <div class="container-fluid" style="padding: 0px;">
        <!-- Liste de liens -->
        <div class="xyz_links_section container">
          <div class="xyz_link_element" data-item="item1"><?= $bddContentTexts['first_pane_tittle_1']['content_fr'] ?? "Football fields" ?></div>
          <div class="xyz_link_element" data-item="item2"><?= $bddContentTexts['first_pane_tittle_2']['content_fr'] ?? "Gym & dance studio" ?></div>
          <!-- <div class="xyz_link_element" data-item="item3"><?= $bddContentTexts['first_pane_tittle_3']['content_fr'] ?? "Event spaces" ?></div> -->
          <div class="xyz_link_element" data-item="item4"><?= $bddContentTexts['first_pane_tittle_4']['content_fr'] ?? "Cultural hall" ?></div>
        </div>

        <!-- Contenu associé au lien -->
        <div class="xyz_custom_content" id="xyz_custom_content">
          <div class="xyz_custom_text container">
            Sélectionne un lien pour voir le contenu.
          </div>
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


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
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

    if (paragraph && toggleButton) {
        toggleButton.addEventListener('click', function() {
            paragraph.classList.toggle('expanded');
            const isExpanded = paragraph.classList.contains('expanded');
            toggleButton.textContent = isExpanded ? 'Réduire' : 'Voir plus';
            toggleButton.setAttribute('aria-expanded', isExpanded);
        });
    }
});

    </script>

    <!-- carousel2 -->
    <script>
        const carousel = document.querySelector('.unique-carousel');
        const carouselItems = document.querySelectorAll('.unique-carousel-item');
        const prevButton = document.querySelector('.unique-prev');
        const nextButton = document.querySelector('.unique-next');
        const paginationContainer = document.querySelector('.unique-carousel-pagination');

        let currentIndex = 0;
        const totalItems = carouselItems.length;
        const visibleItems = window.innerWidth > 992 ? 3 : window.innerWidth > 600 ? 2 : 1;

        function updateCarousel() {
            const offset = -currentIndex * (100 / visibleItems);
            carousel.style.transform = `translateX(${offset}%)`;
            updatePagination();
        }

        function updatePagination() {
            const dots = document.querySelectorAll('.unique-pagination-dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
        }

        function createPagination() {
            for (let i = 0; i < totalItems; i++) {
                const dot = document.createElement('div');
                dot.classList.add('unique-pagination-dot');
                if (i === currentIndex) dot.classList.add('active');
                dot.addEventListener('click', () => {
                    currentIndex = i;
                    updateCarousel();
                });
                paginationContainer.appendChild(dot);
            }
        }

        prevButton.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + totalItems) % totalItems;
            updateCarousel();
        });

        nextButton.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % totalItems;
            updateCarousel();
        });

        // Commenté l'auto-scroll
        /*
        let autoScroll = setInterval(() => {
            currentIndex = (currentIndex + 1) % totalItems;
            updateCarousel();
        }, 3000);

        carousel.addEventListener('mouseover', () => clearInterval(autoScroll));
        carousel.addEventListener('mouseout', () => {
            autoScroll = setInterval(() => {
                currentIndex = (currentIndex + 1) % totalItems;
                updateCarousel();
            }, 3000);
        });
        */

        createPagination();
        updateCarousel();

        window.addEventListener('resize', () => {
            updateCarousel();
        });
    </script>


    <!-- carousel3 -->
    <script>
        const carouselWrapper = document.querySelector('.custom-carousel-content');
        const carouselItemsList = document.querySelectorAll('.custom-carousel-item.firstCarousel');
        const prevArrowButton = document.querySelector('.custom-prev');
        const nextArrowButton = document.querySelector('.custom-next');
        const paginationWrapper = document.querySelector('.custom-pagination-container');

        let currentCarouselIndex = 0;
        const totalCarouselItems = carouselItemsList.length;
        let visibleCarouselItems = window.innerWidth > 992 ? 3 : window.innerWidth > 600 ? 2 : 1;

        function updateCarouselDisplay() {
            const offsetPercentage = -currentCarouselIndex * (100 / visibleCarouselItems);
            carouselWrapper.style.transform = `translateX(${offsetPercentage}%)`;
            updatePaginationDisplay();
        }

        function updatePaginationDisplay() {
            const paginationDots = document.querySelectorAll('.custom-pagination-dot');
            paginationDots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentCarouselIndex);
            });
        }

        function generatePagination() {
            paginationWrapper.innerHTML = ''; // Clear any existing dots
            for (let i = 0; i < totalCarouselItems; i++) {
                const dot = document.createElement('div');
                dot.classList.add('custom-pagination-dot');
                if (i === currentCarouselIndex) dot.classList.add('active');
                dot.addEventListener('click', () => {
                    currentCarouselIndex = i;
                    updateCarouselDisplay();
                });
                paginationWrapper.appendChild(dot);
            }
        }

        prevArrowButton.addEventListener('click', () => {
            currentCarouselIndex = (currentCarouselIndex - 1 + totalCarouselItems) % totalCarouselItems;
            updateCarouselDisplay();
        });

        nextArrowButton.addEventListener('click', () => {
            currentCarouselIndex = (currentCarouselIndex + 1) % totalCarouselItems;
            updateCarouselDisplay();
        });

        let carouselAutoScroll = setInterval(() => {
            currentCarouselIndex = (currentCarouselIndex + 1) % totalCarouselItems;
            updateCarouselDisplay();
        }, 3000);

        carouselWrapper.addEventListener('mouseover', () => clearInterval(carouselAutoScroll));
        carouselWrapper.addEventListener('mouseout', () => {
            carouselAutoScroll = setInterval(() => {
                currentCarouselIndex = (currentCarouselIndex + 1) % totalCarouselItems;
                updateCarouselDisplay();
            }, 3000);
        });

        generatePagination();
        updateCarouselDisplay();

        window.addEventListener('resize', () => {
            visibleCarouselItems = window.innerWidth > 992 ? 3 : window.innerWidth > 600 ? 2 : 1;
            clearInterval(carouselAutoScroll);
            updateCarouselDisplay();
        });
    </script>

    <!-- carousel4 image -->
    <script>
        // Contenu à afficher pour chaque lien
        const xyz_contents = {
        item1: {
            backgroundImage: 'url(./image/<?= $bddContentImages['slider_container_1_1733235750']['path'] ?? "2.png" ?>)', // Image pour le premier lien
            content: '<p> <?= $bddContentTexts['first_pane_content_1']['content_fr'] ?? "aaaaaaaaaaaaaaaaaLorem ipsum." ?> </p>',
        },
        item2: {
            backgroundImage: 'url(./image/<?= $bddContentImages['slider_container_2_1733235770']['path'] ?? "8.png" ?>)', // Image pour le deuxième lien
            content: '<p> <?= $bddContentTexts['first_pane_content_2']['content_fr'] ?? "bbbbbbbbbbbbbbbbbLorem ipsum." ?> </p>',
        },
        item3: {
            backgroundImage: 'url(./image/<?= $bddContentImages['slider_container_3_1733235865']['path'] ?? "6.png" ?>)', // Image pour le troisième lien
            content: '<p> <?= $bddContentTexts['first_pane_content_3']['content_fr'] ?? "cccccccccccccccccLorem ipsum." ?> </p>',
        },
        item4: {
            backgroundImage: 'url(./image/<?= $bddContentImages['slider_container_4_1733235883']['path'] ?? "9.png" ?>)', // Image pour le troisième lien
            content: '<p> <?= $bddContentTexts['first_pane_content_4']['content_fr'] ?? "dddddddddddddddddLorem ipsum." ?> </p>',
        },
        };

        // Récupération des éléments de la page
        const xyz_link_elements = document.querySelectorAll('.xyz_link_element');
        const xyz_content_div = document.getElementById('xyz_custom_content');

        // Définir l'image de fond et le contenu du premier lien au chargement de la page
        xyz_content_div.style.backgroundImage = xyz_contents.item1.backgroundImage;
        xyz_content_div.querySelector('.xyz_custom_text').innerHTML = xyz_contents.item1.content;

        // Ajouter un événement de clic à chaque lien
        xyz_link_elements.forEach(linkElement => {
        linkElement.addEventListener('click', () => {
            // Retirer la classe "selected" de tous les liens
            xyz_link_elements.forEach(item => item.classList.remove('selected'));

            // Ajouter la classe "selected" au lien cliqué
            linkElement.classList.add('selected');

            // Récupérer la clé du lien cliqué
            const linkKey = linkElement.getAttribute('data-item');

            // Changer le fond et le contenu en fonction du lien cliqué
            const content = xyz_contents[linkKey];
            xyz_content_div.style.backgroundImage = content.backgroundImage;
            xyz_content_div.querySelector('.xyz_custom_text').innerHTML = content.content; // Utilisation de innerHTML pour insérer du contenu HTML
        });
        });

    </script><script>
    const akaaCarousel = document.querySelector('.akaa-carousel-inner');
    const akaaCarouselItems = document.querySelectorAll('.akaa-carousel-item');
    const akaaPrevButton = document.querySelector('.akaa-prev');
    const akaaNextButton = document.querySelector('.akaa-next');
    const akaaPaginationContainer = document.querySelector('.akaa-pagination-container');

    let akaaCurrentIndex = 0;
    const akaaTotalItems = akaaCarouselItems.length;
    let akaaVisibleItems = window.innerWidth > 992 ? 2 : 1; // Affiche 2 éléments en grand écran et 1 en petit écran

    function updateAkaaCarousel() {
        const offset = -akaaCurrentIndex * (100 / akaaVisibleItems);
        akaaCarousel.style.transform = `translateX(${offset}%)`;
        updateAkaaPagination();
    }

    function updateAkaaPagination() {
        const akaaDots = document.querySelectorAll('.akaa-pagination-dot');
        akaaDots.forEach((dot, index) => {
            dot.classList.toggle('active', index === akaaCurrentIndex);
        });
    }

    function createAkaaPagination() {
        const akaaNumberOfPages = Math.ceil(akaaTotalItems / akaaVisibleItems);
        akaaPaginationContainer.innerHTML = ''; // Nettoie les anciens dots

        for (let i = 0; i < akaaNumberOfPages; i++) {
            const akaaDot = document.createElement('div');
            akaaDot.classList.add('akaa-pagination-dot');
            if (i === akaaCurrentIndex) akaaDot.classList.add('active');
            akaaDot.addEventListener('click', () => {
                akaaCurrentIndex = i;
                updateAkaaCarousel();
            });
            akaaPaginationContainer.appendChild(akaaDot);
        }
    }

    akaaPrevButton.addEventListener('click', () => {
        akaaCurrentIndex = (akaaCurrentIndex - 1 + Math.ceil(akaaTotalItems / akaaVisibleItems)) % Math.ceil(akaaTotalItems / akaaVisibleItems);
        updateAkaaCarousel();
    });

    akaaNextButton.addEventListener('click', () => {
        akaaCurrentIndex = (akaaCurrentIndex + 1) % Math.ceil(akaaTotalItems / akaaVisibleItems);
        updateAkaaCarousel();
    });

    let akaaAutoScroll = setInterval(() => {
        akaaCurrentIndex = (akaaCurrentIndex + 1) % Math.ceil(akaaTotalItems / akaaVisibleItems);
        updateAkaaCarousel();
    }, 3000);

    akaaCarousel.addEventListener('mouseover', () => {
        clearInterval(akaaAutoScroll);
    });

    akaaCarousel.addEventListener('mouseout', () => {
        akaaAutoScroll = setInterval(() => {
            akaaCurrentIndex = (akaaCurrentIndex + 1) % Math.ceil(akaaTotalItems / akaaVisibleItems);
            updateAkaaCarousel();
        }, 3000);
    });

    createAkaaPagination();
    updateAkaaCarousel();

    window.addEventListener('resize', () => {
        akaaVisibleItems = window.innerWidth > 992 ? 2 : 1;
        createAkaaPagination();
        updateAkaaCarousel();
    });
</script>


</body>
</html>