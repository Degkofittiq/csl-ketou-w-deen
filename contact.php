<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        // Include navigation bar
        include('./includes/head.php') ;    
    ?>
    <title>Contact</title>
    <link rel="stylesheet" href="./contact.css">
    <link rel="stylesheet" href="./index.css">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
    <section class="container-lg">
        <div class="row">
            <div class="col-12 col-md-5 mb-3 order-2 order-md-1 align-self-center">
                <span style="display: block; width: 30%; border: 5px solid #E74040;"></span>
                <br>
                <h3 style="font-weight: 800;"><?= $bddContentTexts['contactez_nous_titre']['content_fr'] ?? "Contactez-nous" ?> </h3>
                <p class="mt-2" style="font-size: 15px;">
                    <?= $bddContentTexts['contactez_nous_description']['content_fr'] ?? "Problems trying to resolve the conflict between 
                    the two major realms of Classical physics: 
                    <br>
                    Newtonian mechanics Problems trying to resolve the conflict between 
                    the two major realms of Classical physics: 
                    <br>
                    Newtonian mechanics Problems trying to resolve the conflict" ?>  
                </p>
                <div class="d-flex flex-column mt-2">
                    <p class="ms-2" style="font-size: 13px; color: #808080;"><?= $bddContentTexts['adresse_titre']['content_fr'] ?? "Address" ?></p>
                    <p style="margin-top: -1rem;"><strong><?= $bddContentTexts['adresse_description']['content_fr'] ?? "COTONOU BENIN" ?></strong></p>
                </div>
                <div class="d-flex flex-column mt-2">
                    <p class="ms-2" style="font-size: 13px; color: #808080;"><?= $bddContentTexts['phone_titre']['content_fr'] ?? "Phone" ?></p>
                    <p style="margin-top: -1rem;"><strong><?= $bddContentTexts['phone_content']['content_fr'] ?? "+229 99 99 99 99" ?> </strong></p>
                </div>
                <div class="d-flex flex-column mt-2">
                    <p class="ms-2" style="font-size: 13px; color: #808080;"><?= $bddContentTexts['email_titre']['content_fr'] ?? "Email" ?>:</p>
                    <p style="margin-top: -1rem;"><strong><?= $bddContentTexts['email_description']['content_fr'] ?? "itti@gmail.com" ?></strong></p>
                </div>
            </div>
            <div class="col-12 col-md-7 mb-3 order-1 order-md-2 ">
                <div class="flex-fill">
                    <img src="image/<?= $bddContentImages['contact_banner_image']['path'] ?? "[freepicdownloader.com]-men-with-battle-rope-battle-ropes-exercise-fitness-gym-crossfit-concept-gym-sport-rope-training-athlete-workout-normal.jpg" ?>" alt="" class="img-fluid w-100">
                </div>
            </div>
        </div>
        
    </section>
    <br>
    <section class="container-fluid p-4" style="background: #FFE0E0;">
        <div class="container">
            <div class="d-flex justify-content-center">
                <span style="display: block; width: 15%; border: 5px solid #E74040;"></span>
            </div>
            <br>
            <h2 class="text-center" style="color: #252B42; font-weight: 700;"><?= $bddContentTexts['soupscription_titre']['content_fr'] ?? "Souscrivez pour recevoir <br> nos informations" ?></h2>
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
                        <button type="submit" class="btn btn-dark w-100 py-3" style="border: 1px solid white; background: #000000;"><?= $bddContentTexts['souscrire_a_un_event_bouton_texte']['content_fr'] ?? "SOUSCRIRE" ?></button>
                    </div>
                </div>
            </form>
        </div>
        <br><br>
    </section>
    <br><br><br>
    
    <?php
        include('./includes/footer.php');
        // include('./includes/scripts.php');
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Script pour afficher automatiquement le toast -->
    <script>
        const myToast = document.getElementById('myToast');
        const toast = new bootstrap.Toast(myToast);
        toast.show();
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