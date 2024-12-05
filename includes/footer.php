<?php

    // Inclure le fichier PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';  // Si tu utilises Composer

    $mail = new PHPMailer(true);  // Créer une instance de PHPMailer

    if (!empty($_POST) && isset($_POST['btn_footer_subscribe'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // client_email-email-subject-phone-message
            // var_dump($_POST);
            $client_email = $_POST['email'];

            // Validation des données
            if ($client_email == "") {
                // echo "Tous les champs sont requis.";
                $_SESSION['error'] =  "L'adresse email est requise.";
                // exit;
            }
            
            $message = "Je souhaite m'abonner à votre newsletter. Voici mon adresse mail: $client_email";
            // $pdo = Database::getConnection();
            

            // Préparation de la requête SQL pour insérer les données
            // client_email	client_num	event_id	phone	message	created_at	

            $sql = "INSERT INTO contact_email (email) VALUES (?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($client_email));
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
<footer class="container-fluid py-3" style="padding: 0px;">
        <span class="my-4 d-flex" style="border-bottom: 4px solid #61BC45;"></span>
        <div class="container-lg py-5">
            <div class="row">
                <div class="col-lg-3 mx-auto mb-3 mb-md-0">
                    <h5 class="fw-bold" style="font-size: clamp(17px, 6vw, 26px);"><?= $bddContentTexts['footer_email_tittle']['content_fr'] ?? "Email Adress" ?></h5>
                    <p style="font-size: clamp(14px, 3.5vw, 18px);"><?= $bddContentTexts['footer_subscribe_tittle']['content_fr'] ?? "Stay Updated! Subscribe to our newsletter" ?></p>
                    <div class="d-flex flex-column">
                        <form action="" method="post">
                            <div class="">
                                <input name="email" type="email" class="form-control form py-3" placeholder="Email Address">
                            </div>
                            <div class="mt-4">
                                <button  name="btn_footer_subscribe" class="btn btn-white w-100 py-3 text-white" style="background: #61BC45;" onclick="window.location.href='contact.php'"><?= $bddContentTexts['footer_subscribe_description']['content_fr'] ?? "Abonnez-vous maintenant" ?> <i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex mt-3">
                        <span><i class="bi bi-instagram fs-4"></i></span>
                        <span><i class="bi bi-linkedin fs-4 mx-3"></i></span>
                        <span><i class="bi bi-facebook fs-4"></i></span>
                        <span><i class="bi bi-youtube fs-4 ms-3"></i></span>
                    </div>
                </div>
                <div class="col-lg-3 mx-auto mb-3 mb-md-0 px-4">
                    <h5 class="fw-bold" style="font-size: clamp(17px, 6vw, 26px);"><?= $bddContentTexts['footer_about_tittle']['content_fr'] ?? "About" ?></h5>
                    <p style="white-space: nowrap; font-size: clamp(14px, 3.5vw, 18px);"><?= $bddContentTexts['phone_titre']['content_fr'] ?? "Phone" ?> : <?= $bddContentTexts['phone_content']['content_fr'] ?? "09 290 38200" ?>
                        <br>
                        <?= $bddContentTexts['footer_email_titre']['content_fr'] ?? "Email" ?> : <?= $bddContentTexts['email_description']['content_fr'] ?? "enquiry@yourdomain.com" ?>
                    </p>
                    <p class="mt-3" style="font-size: clamp(14px, 3.5vw, 18px);"><?= $bddContentTexts['adresse_titre']['content_fr'] ?? "Adresse" ?> <br><?= $bddContentTexts['adresse_description']['content_fr'] ?? "CSL Kétou, Arojú Owò</p>adresse_description" ?>
                </div>
                <div class="col-lg-2 mx-auto mb-3 mb-md-0">
                    <h5 class="fw-bold" style="font-size: clamp(17px, 6vw, 26px);"><?= $bddContentTexts['contactez_nous_titre']['content_fr'] ?? "Contactez-nous" ?></h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" style="color: #484848; text-decoration: none; font-size: clamp(14px, 3.5vw, 18px);"><?= $bddContentTexts['nav_link_1']['content_fr'] ?? "Accueil" ?></a></li>
                        <li><a href="about.php" style="color: #484848; text-decoration: none; font-size: clamp(14px, 3.5vw, 18px);"><?= $bddContentTexts['nav_link_2']['content_fr'] ?? "A propos" ?></a></li>
                        <li><a href="index.php#section3" style="color: #484848; text-decoration: none; font-size: clamp(14px, 3.5vw, 18px);"><?= $bddContentTexts['nav_link_3']['content_fr'] ?? "Activities" ?></a></li>
                        <li><a href="index.php#section6" style="color: #484848; text-decoration: none; font-size: clamp(14px, 3.5vw, 18px);"><?= $bddContentTexts['nav_link_4']['content_fr'] ?? "Programmes" ?></a></li>
                        <li><a href="contact.php" style="color: #484848; text-decoration: none; font-size: clamp(14px, 3.5vw, 18px);"><?= $bddContentTexts['nav_link_5']['content_fr'] ?? "Nous rejoindre" ?></a></li>
                        <li><a href="index.php#upcommingEvent" style="color: #484848; text-decoration: none; font-size: clamp(14px, 3.5vw, 18px);"><?= $bddContentTexts['nav_link_6']['content_fr'] ?? "Events" ?></a></li>
                    </ul>
                </div>
                <div class="col-lg-2 mx-auto mb-3 mb-md-0">
                    <div class="d-none d-lg-block">
                        <img src="image/1.png" alt="" class="image-fluid w-100">
                    </div>
                    <div class="d-lg-none">
                        <img src="image/1.png" alt="" class="image-fluid w-50">
                    </div>
                </div>
            </div>
        </div>
        <div class="position-relative">
            <span class="d-block my-4" style="border-top: 1px solid #000000; "></span>
            <p class="text-center py-3">© Copyright 2024 <?= $bddContentTexts['site_name']['content_fr'] ?? "CSL Arojú Owò " ?> All Rights Reserved  | Terms of use  | Privacy Policy</p>
            <div class="pot">
                <a href=""><img src="image/chatbot.png" alt=""></a>
            </div>
        </div>
    </footer>
    <?php        
        // Vérifier si un message est stocké dans la session success
        if (isset($_SESSION['success'])) {  
            ?>
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="myToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">Notification</strong>
                            <small class="text-muted">A l'instant</small>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var toastEl = document.getElementById('myToast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    </script>
    
    
<script>
  function toggleText(element) {
    element.classList.toggle("expanded");
  }
</script>