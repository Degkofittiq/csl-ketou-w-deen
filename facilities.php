<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        // Include navigation bar
        include('./includes/head.php') ;    
    ?>
    <title>Facilities</title>
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="./facilities.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

</head>

<body>

    <?php
        // Include navigation bar
        include('./includes/header.php') ;
        // include('./includes/contact_form.php') ;

        // Inclure le fichier PHPMailer
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
    
        require 'vendor/autoload.php';  // Si tu utilises Composer
        
        $mail = new PHPMailer(true);  // Créer une instance de PHPMailer
    
            if (isset($_POST['btn_reservation'])) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // client_name-email-subject-phone-message
                    // var_dump($_POST);
                    $client_name = $_POST['client_name'];
                    $client_number = $_POST['client_number'];
                    $space_id = $_POST['space_id']; //$_POST['space_id'];
                    $client_email = $_POST['client_email']; //$_POST['client_email'];
    
                    // Validation des données
                    if ($client_name == "" || $client_number == "" || $client_email == "" || $space_id == "") {
                        // echo "Tous les champs sont requis.";
                        $_SESSION['error'] =  "Tous les champs sont requis.";
                        // exit;
                    }
                    
                    $message = "Nom: $client_name;client email: $client_email; client_number: $client_number;Event number: $space_id;";
                    // $pdo = Database::getConnection();
                    
    
                    // Préparation de la requête SQL pour insérer les données
                    // client_name	client_number	space_id	phone	message	created_at	
    
                    $sql = "INSERT INTO space_locations (client_name,client_number,space_id,client_email) VALUES (?,?,?,?)";
                    $stmt = $pdo->prepare($sql);
                    // var_dump($stmt->execute(array($client_name,$client_number,$space_id,$phone,$message)));
                    // die();
                    $stmt->execute(array($client_name,$client_number,$space_id,$client_email));
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
                            $mail->subject = 'Contact Mail from CSL-KETOU';
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

            if (isset($_POST['btn_contact'])) {
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
    
    <?php
    
    // Vérifier si un message est stocké dans la session success
    if (isset($_SESSION['success'])) {  
    ?>
    
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="myToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <small class="text-muted">Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= $_SESSION['success'] ?>
            </div>
        </div>
    </div>
    <?php
    } unset($_SESSION['success']);
    ?>
    
    
    <?php
        // Vérifier si un message est stocké dans la session error
        if (isset($_SESSION['error'])) {  
    ?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="myToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Notification</strong>
                    <small class="text-muted">Just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?= $_SESSION['error'] ?>
                </div>
            </div>
        </div>
    <?php
        }unset($_SESSION['error']);
    ?>
    <br>
    
    <div class="hero" style="background-image: url(./image/<?= $bddContentImages['facilities_banner_image']['path'] ?? "man.jpg" ?>) !important">
        <div class="desc2">
            <h2>
            <?= $bddContentTexts['facilities_premier_titre']['content_fr'] ?? "Decouvrez nos activites" ?></h2>
        </div>
    </div>


    <div class="row nax container-fluid">
    <?php
// Exemple d'événements

$stmt = $pdo->query("SELECT * FROM activities LIMIT 5");
$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

$useReverse = false; // Variable pour alterner les classes

foreach ($activities as $activity) {
    // Détermine la classe à utiliser
    $rowClass = $useReverse ? 'row flex-row-reverse' : 'row';
    ?>
        <section class="">
            <div class="<?= $rowClass ?>">
                <div class="col-12 col-md-7 mb-3 mb-md-0 mx-auto order-2 order-md-1 p-5 align-self-center">
                    <div class="d-flex">
                        <div class="align-self-center">
                            <span class="me-3 mb-3" style="display: block; border-bottom: 2px solid black; width: 4rem;"></span>
                        </div>
                        <div>
                            <p><?= $activity['little_title'] ?? "" ?></p>
                        </div>
                    </div>
                    <br>
                    <div class="ms-0 ms-md-5 ps-0 ps-md-4">
                        <h1 class="" style="font-weight: 800;"><?= $activity['name'] ?? "" ?></h1>
                        <br>
                        <p>
                            <?= $activity['description'] ?? "" ?>
                        </p>
                    </div>
                    
                </div>
                <div class="col-12 col-md-5 mb-3 order-1 order-md-2 align-items-stretch" data-aos="zoom-in"
                    data-aos-delay="100">
                    <div class="flex-fill">
                        <img src="image/<?= $activity['image'] ?? 'woman-working-with-personal-trainer.jpg' ?>" alt="" class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </section>
        <br>
    <?php
    // Alterner la variable
    $useReverse = !$useReverse;
}
?>
    
    </div>


    <br>
    <section class="container-fluid p-4" style="background: #FFE0E0;">
        <div class="container thiis">
            <div class="d-flex justify-content-center">
                <span style="display: block; width: 15%; border: 5px solid #E74040;"></span>
            </div>
            <br>
            <h2 class="text-center" style="color: #252B42; font-weight: 700;"><?= $bddContentTexts['facilities_space_renting_titre']['content_fr'] ?? "Space renting" ?></a> </h2>
            <br>

            <div class="row list">
                <div class="scroll-container">
                        <?php                            
                            $stmt = $pdo->query("SELECT * FROM spaces LIMIT 5");
                            $spaces = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($spaces as $space) {
                        ?>
                    <div class="scroll-item">
                        <div class="card" style="width: 27rem; background-color: transparent; border: none;">
                            <img src="image/<?= $space['images'] ?? '[freepicdownloader.com]-men-with-battle-rope-battle-ropes-exercise-fitness-gym-crossfit-concept-gym-sport-rope-training-athlete-workout-normal.jpg' ?>"
                                class="card-img-top" alt="...">
                            <div class="card-body" style=" padding: 30px 0;">
                                <h5 class="card-title"><?= $space['name']?></h5>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal-<?= $space['id']?>" style="border-radius: 0px; margin: 10px 0;">
                                    Cliquez pour reserver
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal-<?= $space['id']?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Reservation</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                            <div class="modal-body">
                                                <div class="column justify-content-md-center">
                                                    <input type="hidden" name="space_id" value="<?= $space['id']?>">
                                                    <div class="col-12 mb-3">
                                                        <input name="client_name" type="text" class="form-control py-3" placeholder="Name"
                                                            style="border: 2px solid #CD4631;">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <input name="client_email" type="email" class="form-control py-3" id="floatingInput"
                                                            placeholder="Email">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <input name="client_number" type="text" class="form-control py-3" id="floatingInput"
                                                            placeholder="Phone number">
                                                    </div>
                                                    <!-- <div class="col-12 mb-3">
                                                            <textarea name="comment" class="form-control py-3" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                                    </div> -->
                                                </div>
                                                <p>
                                                    Nb* : Entrez vos informations, nous vous contacterons pour la suite
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="btn_reservation" class="btn btn-dark w-100 py-3"
                                                    style="border: 1px solid white; background: #000000;">Valider</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            </div>
        </div>
        <div class="container mb-3 thatone">
            <div class="d-flex justify-content-center">
            </div>
            <br>
            <h2 class="text-center mb-3" style="color: #252B42; font-weight: 700;"><?= $bddContentTexts['soupscription_titre']['content_fr'] ?? "Souscrivez pour recevoir <br> nos informations" ?></h2>
            <br>
            <form action="" method="post">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-4 mb-3">
                        <input name="name" type="text" class="form-control py-3" placeholder="Name" style="border: 2px solid #CD4631;">
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <input name="email" type="email" class="form-control py-3" id="floatingInput" placeholder="Email">
                    </div>
                </div>
                <br>
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-4 mb-3">
                        <input name="phone" type="text" class="form-control py-3" placeholder="Phone">
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <button type="submit" name="btn_contact" class="btn btn-dark w-100 py-3" style="border: 1px solid white; background: #000000;"><?= $bddContentTexts['souscrire_a_un_event_bouton_texte']['content_fr'] ?? "SOUSCRIRE" ?></button>
                    </div>
                </div>
            </form>
        </div>
        <svg class="svv4" width="286" height="324" viewBox="0 0 286 324" fill="#96bb7c" xmlns="http://www.w3.org/2000/svg">
            <path d="M89.2696 311.163C71.3979 303.157 55.2107 291.411 41.6639 276.618C28.3999 262.001 17.9658 244.738 10.9582 225.816C3.51029 205.598 -0.207592 184.036 0.00894216 162.313C-0.129882 140.007 3.91675 117.897 11.9104 97.2865C19.4194 78.25 30.3804 60.985 44.1632 46.4844C57.7869 31.9809 73.9665 20.4986 91.7689 12.7006C110.645 4.38942 130.856 0.075813 151.276 7.33504e-05C164.738 -0.0135285 178.143 1.86463 191.146 5.58756C203.616 9.28606 215.608 14.6185 226.85 21.4632C237.967 28.117 248.178 36.365 257.199 45.9759C266.383 55.6076 274.382 66.4484 281.001 78.2357L233.396 111.003C225.487 95.4925 214.277 82.1815 200.667 72.1397C186.205 62.2572 169.272 57.2966 152.109 57.9152C138.765 57.7702 125.53 60.4898 113.191 65.915C101.681 70.9711 91.2391 78.4441 82.4858 87.8882C73.7651 97.3622 66.8887 108.585 62.2533 120.909C57.3374 133.944 54.8707 147.882 54.9935 161.932C54.8802 175.775 57.348 189.504 62.2533 202.32C66.8964 214.505 73.6835 225.627 82.2477 235.087C90.8853 244.535 101.203 252.048 112.596 257.186C124.691 262.587 137.689 265.31 150.8 265.187C169.369 265.813 187.625 259.972 202.809 248.549C216.966 237.539 228.303 222.909 235.776 206.002L286 234.071C279.538 247.244 271.54 259.491 262.197 270.522C253.064 281.474 242.574 291.045 231.015 298.971C219.28 307.103 206.488 313.35 193.05 317.513C179.46 321.857 165.344 324.04 151.157 323.991C129.927 324.232 108.872 319.867 89.2696 311.163Z" fill="white"/>
            </svg>


        <svg class="svv5" width="286" height="324" viewBox="0 0 286 324" fill="#96bb7c" xmlns="http://www.w3.org/2000/svg">
            <path d="M89.2696 311.163C71.3979 303.157 55.2107 291.411 41.6639 276.618C28.3999 262.001 17.9658 244.738 10.9582 225.816C3.51029 205.598 -0.207592 184.036 0.00894216 162.313C-0.129882 140.007 3.91675 117.897 11.9104 97.2865C19.4194 78.25 30.3804 60.985 44.1632 46.4844C57.7869 31.9809 73.9665 20.4986 91.7689 12.7006C110.645 4.38942 130.856 0.075813 151.276 7.33504e-05C164.738 -0.0135285 178.143 1.86463 191.146 5.58756C203.616 9.28606 215.608 14.6185 226.85 21.4632C237.967 28.117 248.178 36.365 257.199 45.9759C266.383 55.6076 274.382 66.4484 281.001 78.2357L233.396 111.003C225.487 95.4925 214.277 82.1815 200.667 72.1397C186.205 62.2572 169.272 57.2966 152.109 57.9152C138.765 57.7702 125.53 60.4898 113.191 65.915C101.681 70.9711 91.2391 78.4441 82.4858 87.8882C73.7651 97.3622 66.8887 108.585 62.2533 120.909C57.3374 133.944 54.8707 147.882 54.9935 161.932C54.8802 175.775 57.348 189.504 62.2533 202.32C66.8964 214.505 73.6835 225.627 82.2477 235.087C90.8853 244.535 101.203 252.048 112.596 257.186C124.691 262.587 137.689 265.31 150.8 265.187C169.369 265.813 187.625 259.972 202.809 248.549C216.966 237.539 228.303 222.909 235.776 206.002L286 234.071C279.538 247.244 271.54 259.491 262.197 270.522C253.064 281.474 242.574 291.045 231.015 298.971C219.28 307.103 206.488 313.35 193.05 317.513C179.46 321.857 165.344 324.04 151.157 323.991C129.927 324.232 108.872 319.867 89.2696 311.163Z" fill="white"/>
            </svg>
    </section>

    <br><br><br>
    
    <?php
        include('./includes/footer.php');
        // include('./includes/scripts.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="jquery.min.js"></script>

    <!-- Linking SwiperJS script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Script pour afficher automatiquement le toast -->
    <script>
        const myToast = document.getElementById('myToast');
        const toast = new bootstrap.Toast(myToast);
        toast.show();
    </script>
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
        // Initialiser Flatpickr
        flatpickr("#dateInput", {
            dateFormat: "d F Y",  // Format pour afficher le jour, le mois en lettres, et l'année
            defaultDate: new Date(),  // Définir la date par défaut à aujourd'hui
        });
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>