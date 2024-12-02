
<?php   
    
    // Inclure le fichier PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';  // Si tu utilises Composer
    
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
                    <img src="image/2.png" class="d-block w-100" style="height: 60vh; object-fit: cover;" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="image/2.png" class="d-block w-100" style="height: 60vh; object-fit: cover;" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="image/2.png" class="d-block w-100" style="height: 60vh; object-fit: cover;" alt="Slide 3">
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
                <?= $bddContentTexts['contactez_nous_titre']['content_fr'] ?? "Contactez-nous	" ?>
                </h1>
                <p class="text-white"><?= $bddContentTexts['explore_text']['content_fr'] ?? "Explore a world of fitness, fun, and <br> community activities tailored for all ages." ?></p>
                <div class="row mt-3">
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
                            <?= $bddContentTexts['become_member']['content_fr'] ?? "Become A Member" ?> <i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="my-5 container-lg">
        <div class="row">
            <div class="col-12 col-md-4 mx-auto mb-3 mb-md-0 align-self-center">
              <div class="">
                <span><i class="bi bi-envelope-fill fs-3 ms-2" style="color: #61BC45;"></i></span>
                <br>
                <p><strong><?= $bddContentTexts['email_titre']['content_fr'] ?? "Email" ?>:</strong></p>
                <span><?= $bddContentTexts['email_description']['content_fr'] ?? "itti@gmail.com" ?></span>
              </div>
              <div class="mt-4">
                <span><i class="bi bi-telephone-fill fs-3 ms-2" style="color: #61BC45;"></i></span>
                <br>
                <p><strong><?= $bddContentTexts['phone_titre']['content_fr'] ?? "Phone" ?></strong></p>
                <span><?= $bddContentTexts['phone_content']['content_fr'] ?? "+229 99 99 99 99" ?></span>
              </div>
              <div class="mt-4">
                <span><i class="bi bi-geo-alt-fill fs-3 ms-2" style="color: #61BC45;"></i></span>
                <br>
                <p><strong><?= $bddContentTexts['adresse_titre']['content_fr'] ?? "Address" ?></strong></p>
                <span><?= $bddContentTexts['adresse_description']['content_fr'] ?? "Pk-10,Cotonou,Benin" ?></span>
              </div>
            </div>
            <div class="col-12 col-md-8 mx-auto mb-3 mb-md-0">
              <div class="" style=" box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                <div id="map" style="min-height: 500px;"  data-aos="flip-left"></div>
              </div>
            </div>
          </div>
    </section>
    <?php
        // Include navigation bar
        include('./includes/footer.php') ;    
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        var map = L.map('map').setView([6.3703, 2.3912], 13);
    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    
        L.marker([6.3703, 2.3912]).addTo(map)
            .bindPopup('Cotonou, Bénin')
            .openPopup();
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>