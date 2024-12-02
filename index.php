<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        // Include navigation bar
        include('./includes/head.php') ;    
    ?>
    <title>Accueil</title>
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

</head>

<body>
    <?php
        // Include navigation bar
        include('./includes/header.php') ;  

        // Inclure le fichier PHPMailer
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
    
        require 'vendor/autoload.php';  // Si tu utilises Composer
        
        $mail = new PHPMailer(true);  // Créer une instance de PHPMailer
    
        if (!empty($_POST)) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // client_name-email-subject-phone-message
                // var_dump($_POST);
                $client_name = $_POST['client_name'];
                $client_num = $_POST['client_num'];
                $event_id = $_POST['event_id']; //$_POST['event_id'];

                // Validation des données
                if ($client_name == "" || $client_num == "" || $event_id == "") {
                    // echo "Tous les champs sont requis.";
                    $_SESSION['error'] =  "Tous les champs sont requis.";
                    // exit;
                }
                
                $message = "Nom: $client_name; client_num: $client_num;Event number: $event_id;";
                // $pdo = Database::getConnection();
                

                // Préparation de la requête SQL pour insérer les données
                // client_name	client_num	event_id	phone	message	created_at	

                $sql = "INSERT INTO event_reservations (client_name,client_num,event_id) VALUES (?,?,?)";
                $stmt = $pdo->prepare($sql);
                // var_dump($stmt->execute(array($client_name,$client_num,$event_id,$phone,$message)));
                // die();
                $stmt->execute(array($client_name,$client_num,$event_id));
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
    <section id="section1" class="container-lg ccc" data-aos="zoom-in" data-aos-delay="100">
        <div class="row position">
            <div class="col-12 col-md-5 mb-3 order-2 order-md-1 align-items-stretch">
                <br>
                <h1 class="ccc1" style="font-weight: 800; color: #252B42;"><?= $bddContentTexts['premier_titre_de_home']['content_fr'] ?? "Vivez l'Émotion du Sport et le Plaisir des
                    Loisirs" ?> </h1>

                <p class="fs-5 tex"><?= $bddContentTexts['premier_sous_titre_de_home']['content_fr'] ?? "Plongez dans un univers où performance, détente et passion se rencontrent pour
                    répondre à toutes vos envies sportives et récréatives." ?></p>

                <div class="d-flex">
                    <div class="tex">
                        <button type="button" class="btn btn-success px-3 py-2"><?= $bddContentTexts['bouton_nous_rejoindre']['content_fr'] ?? "Nous rejoindre" ?></button>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-7 mb-3 order-1 order-md-2 align-items-stretch" data-aos="zoom-out"
                data-aos-delay="100">
                <div class="flex-fill">
                    <img src="image/<?= $bddContentTexts['home_banner_image']['path'] ?? "woman-working-with-personal-trainer.jpg" ?>" alt="" class="img-fluid w-100">
                </div>
            </div>


        </div>
        <div class="row tex2">
            <div class="col-6 col-md-3 mb-3 mb-md-0">
                <h1 class="text-center" style="font-weight: 700; color: #96BB7C;"><?= $bddContentTexts['clients_content_nombre']['content_fr'] ?? "15K" ?></h1>
                <p class="text-center" style="color: #252B42;"><?= $bddContentTexts['clients_content_texte']['content_fr'] ?? "Happy Customers" ?> </p>
            </div>
            <div class="col-6 col-md-3 mb-3 mb-md-0">
                <h1 class="text-center" style="font-weight: 700; color: #96BB7C;"><?= $bddContentTexts['nombre_visiteurs']['content_fr'] ?? "150K" ?></h1>
                <p class="text-center" style="color: #252B42;"><?= $bddContentTexts['texte_nombre_visiteurs']['content_fr'] ?? "Monthly Visitors" ?> </p>
            </div>
            <div class="col-6 col-md-3 mb-3 mb-md-0">
                <h1 class="text-center" style="font-weight: 700; color: #96BB7C;"><?= $bddContentTexts['nombre_de_pays']['content_fr'] ?? "15" ?></h1>
                <p class="text-center" style="color: #252B42;"><?= $bddContentTexts['nombre_de_pays_texte']['content_fr'] ?? "Countries Worldwide" ?> </p>
            </div>
            <div class="col-6 col-md-3 mb-3 mb-md-0">
                <h1 class="text-center" style="font-weight: 700; color: #96BB7C;"><?= $bddContentTexts['nombre_de_partenaires']['content_fr'] ?? "100+" ?></h1>
                <p class="text-center" style="color: #252B42;"><?= $bddContentTexts['texte_de_nombre_de_partenaire']['content_fr'] ?? "Top Partners" ?> </p>
            </div>
        </div>


    </section>
    <br>

    <section id="facilities" class="container-fluid p-5" style="background-color: #96bb7c; " data-aos="zoom-in"
        data-aos-delay="100">

        <h2 class="text-center" style="color: #252B42; font-weight: 600;"><?= $bddContentTexts['titre_section_activites']['content_fr'] ?? "Decouvrez nos activites" ?></h2>
        <p class="text-center" style="max-width:50% !important; ext-align: justify; margin:auto">
        <?= $bddContentTexts['sous_titre_section_activites']['content_fr'] ?? "Problems trying to resolve the conflict between <br>
            the two major realms of Classical physics: Newtonian mechanics" ?>
            
        </p>

        <div class="row list">
            <div class="scroll-container">
                        <?php
                            
                            $stmt = $pdo->query("SELECT * FROM activities");
                            $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($activities as $activity) {
                        ?>
                            <div class="scroll-item">
                                <div class="image-container">
                                    <img src="image/<?= $activity['image'] ?? "[freepicdownloader.com]-men-with-battle-rope-battle-ropes-exercise-fitness-gym-crossfit-concept-gym-sport-rope-training-athlete-workout-normal.jpg" ?>"
                                        alt="" class="img-fluid w-100">
                                    <div class="overlay">
                                        <h2><?= $activity['name']?></h2>
                                        <p class="description"><?= $activity['little_title']?></p>
                                    </div>
                                </div>
                            </div> 
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

        <br>
    </section>


    <section id="section2" class="container-fluid bg-white p-4" data-aos="zoom-in" data-aos-delay="100" style=" padding: 100px 0 !important;">
        <div class="container-lg">

            <br><br>
            <div class="row mt-2">
                        <?php
                            
                            $stmt = $pdo->query("SELECT * FROM about_us LIMIT 1");
                            $aboutus = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($aboutus as $about) {
                        ?>
                            <div class="col-12 col-md-5 mb-3 order-2 order-md-1 align-self-center mt-5">
                                <span style="display: block; width: 30%; border: 5px solid #E74040;"></span>
                                <br><br>
                                <h2 style="font-weight: 800;"> <?= $about['name'] ?? "A propos de nous" ?> </h2>
                                <p class="mt-2 fs-5">
                                    <?= $about['description'] ?? "Problems trying to resolve the conflict between
                                    the two major realms of Classical physics:
                                    <br>
                                    Newtonian mechanics Problems trying to resolve the conflict between
                                    the two major realms of Classical physics:
                                    <br>
                                    Newtonian mechanics Problems trying to resolve the conflict" ?>
                                </p>
                                <br><br><br>
                                <div>
                        <button type="button" class="btn btn-success fs-4" style="border: none;" data-bs-toggle="modal"
                        data-bs-target="#founderModal">Cliquez pour voir la bio du fondateur <i
                                class="bi bi-chevron-right ms-3"></i></button>
                                </div>
                            </div>
                            <div class="col-12 col-md-7 mb-3 order-1 order-md-2" data-aos="zoom-out" data-aos-delay="100">
                                <div class="flex-fill">
                                    <img src="image/<?= $about['image'] ?? "[freepicdownloader.com]-men-with-battle-rope-battle-ropes-exercise-fitness-gym-crossfit-concept-gym-sport-rope-training-athlete-workout-normal.jpg" ?>"
                                        alt="" class="img-fluid w-100">
                                </div>
                            </div>
                        <?php

                            }
                            if (empty($aboutus)) {
                                ?>

                                <a class="mt-3" href="#" style="color: #737373; text-decoration: none; font-weight: 600; font-size: 16px;">
                                    No About text yet
                                </a>
                                <br> <br>
                            <?php
                            }
                        ?>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="founderModal" tabindex="-1" aria-labelledby="founderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="founderModalLabel">À propos du fondateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <?php                                              
                        $stmt = $pdo->query("SELECT * FROM founder_bio LIMIT 1");
                        $founder = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <img src="image/<?= $founder['image'] ?? 'man.jpg' ?>" alt="Photo du fondateur" class="rounded-circle mb-3"
                        style="width: 200px; height: 200px; object-fit: cover;">
                    <p><?= $founder['description'] ?? "Jean ASSESSI est un entrepreneur passionné qui a fondé ce centre avec pour mission de créer une
                        communauté dynamique. Avec plus de 10 ans d'expérience dans le domaine, il est connu pour son
                        engagement envers l'excellence.</p>" ?>
                        <p><strong>Contact :</strong><?= $bddContentTexts['phone_content']['content_fr'] ?? "+229 90 00 00 00" ?> </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <section class="container-fluid p-5 events" style="background-color: #FFE0E0;">
        <div class="container-lg">
            <span style="display: block; width: 30%; border: 5px solid #E74040;"></span>
            <br><br>
            <h2 style="font-weight: 800;"><?= $bddContentTexts['titre_pour_la_section_evenement']['content_fr'] ?? "Programmes et Evenements" ?> </h2>
            <p class="mt-2 fs-5">
                <?= $bddContentTexts['description_titre_pour_la_section_evenement']['content_fr'] ?? "Problems trying to resolve the conflict between the two major realms of Classical physics:" ?>
            </p>


            <div class="row eventi titi">
            <?php
                $stmt = $pdo->query("SELECT * FROM events");
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
                        <div class="col-12 col-md-6 mb-3 mb-md-0 mx-auto" style="background-color: #F2C94C; border-radius: 20px; margin: 0 30px !important;">
                            <div class="p-3 d-flex justify-content-between">
                                <div>
                                    <h3 style="font-weight: 900;"><?= $day ?></h3>
                                    <p style="font-size: 12px;"><?= ucfirst($month) ?></p> <!-- Mois en majuscule initiale -->
                                </div>
                                <div class="">
                                    <div class="d-flex" style="justify-content: center;">
                                        <div>
                                            <p><?= htmlspecialchars($event['name']) ?></p>
                                        </div>
                                        <div class="align-self-center">
                                            <span class="ms-3 mb-3" style="display: block; border-bottom: 2px solid black; width: 4rem;"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <p style="font-weight: 800;"><?= htmlspecialchars($event['description']) ?></p>
                                </div>
                            </div>
                            <form action="" method="post">
                                <div class="row rowex justify-content-md-center" style="padding: 0 50px;">
                                        <input name="event_id" value="<?= $event['id'] ?>" hidden  type="text" class="form-control py-3">
                                    <div class="col-12 col-md-4 mb-3 rowexi">
                                        <input name="client_name" type="email" class="form-control py-3" placeholder="Email" required>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3 rowexi">
                                        <input name="client_num" type="text" class="form-control py-3" placeholder="Numero" required>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3 rowexi">
                                        <button type="submit" class="btn btn-dark w-100 py-3" style="border: 1px solid white; background: #000000;">SOUSCRIRE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                        <div class="col-12 col-md-6 mb-3 mb-md-0 mx-auto" style="background-color: #F2C94C; border-radius: 20px; margin: 0 30px !important;">
                            <div class="p-3 d-flex justify-content-between">
                                <div>
                                    <h3 style="font-weight: 900;">#</h3>
                                    <p style="font-size: 12px;">*****</p>
                                </div>
                                <div class="">
                                    <div class="d-flex" style="justify-content: center;">
                                        <div>
                                            <p>Evenements</p>
                                        </div>
                                        <div class="align-self-center">
                                            <span class="ms-3 mb-3" style="display: block; border-bottom: 2px solid black; width: 4rem;"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <p style="font-weight: 800;">
                                        no event yet
                                    </p>
                                </div>
                            </div>
                            <!-- <div class="row rowex justify-content-md-center" style="padding: 0 50px;">
                                <div class="col-12 col-md-4 mb-3 rowexi">
                                    <input type="text" class="form-control py-3" placeholder="Phone">
                                </div>
                                <div class="col-12 col-md-4 mb-3 rowexi">
                                    <input type="text" class="form-control py-3" placeholder="Phone">
                                </div>
                                <div class="col-12 col-md-4 mb-3 rowexi">
                                    <button class="btn btn-dark w-100 py-3" style="border: 1px solid white; background: #000000;">SOUSCRIRE</button>
                                </div>
                            </div> -->
                        </div>
                    <?php
                }
            ?>

            </div>

            <div class="row eventi" id="section3">
    
                <div class=" table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col"><?= $bddContentTexts['horaire_section_titre_jour']['content_fr'] ?? 'Jours'  ?></th>
                                <th scope="col"><?= $bddContentTexts['horaire_section_titre_ouverture']['content_fr'] ?? 'Ouverture'  ?></th>
                                <th scope="col"><?= $bddContentTexts['horaire_section_titre_fermeture']['content_fr'] ?? 'Fermeture'  ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                                        
                            // Récupérer tous les horaires de la table hourlies
                            $stmt = $pdo->prepare("SELECT * FROM hourlies");
                            $stmt->execute();
                            $hourlies = $stmt->fetchAll();
                            foreach ($hourlies as $hourly) {
                        ?>
                            <tr>
                                <td><?= $activity['days'] ?></td>
                                <td><input type="time" class="form-control" value="<?= $activity['h_open'] ?>"></td>
                                <td><input type="time" class="form-control" value="<?= $activity['h_close'] ?>"></td>
                            </tr>
                        <?php

                            }
                            if (empty($hourlies)) {
                                ?>

                            <tr>
                                <td>Monday</td>
                                <td><input type="time" class="form-control" value="09:00"></td>
                                <td><input type="time" class="form-control" value="18:00"></td>
                            </tr>
                            <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
    
            </div>

        </div>





    </section>

    <br><br><br>
    
    <?php
        include('./includes/footer.php');
        include('./includes/scripts.php');
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script pour afficher automatiquement le toast -->
    <script>
        const myToast = document.getElementById('myToast');
        const toast = new bootstrap.Toast(myToast);
        toast.show();
    </script>
</body>

</html>