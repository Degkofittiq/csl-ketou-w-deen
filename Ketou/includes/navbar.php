
<?php

    // Inclure le fichier PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';  // Si tu utilises Composer
    
    $mail = new PHPMailer(true);  // Créer une instance de PHPMailer

    if (!empty($_POST)  && isset($_POST['btn_future'])) {
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
                $mail->is.php(true);                                  // Définit l'email comme au format .php
                $mail->subject = 'Contact Mail from CSL-KETOU';
                $mail->Body    = $message;
                $mail->AltBody = 'Ceci est le corps du message en texte brut pour les clients mail qui n\'acceptent pas le .php';
            
                $mail->send();
                // echo 'Le message a été envoyé avec succès';
                $_SESSION['success'] = "Votre message a été envoyé avec succès.";
            } catch (Exception $e) {
                // echo "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
                $_SESSION['error'] = "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
            }

        }
    }
?>

<div class="d-none d-lg-block">
    <div class="container-lg">
        <div class="row">
            <div class="col-2 mx-auto">
                <img src="images/1.png" alt="" style="width: 100%;" class="image-fluid">
            </div>
            <div class="col-10 mx-auto" style="border-left: 1px solid #00000033;">
                <div class="row py-2">
                    <div class="col-4"></div>
                    <div class="col-8 mx-auto">
                        <div class="d-flex justify-content-end">
                            <div class="me-3 pe-3" style="border-right: 1px solid #00000033;">
                                <p><i class="bi bi-geo-alt-fill fs-3 mt-4 me-2"></i>CSL Kétou, Arojú Owò</p>
                            </div>
                            <div class="">
                                <p><i class="bi bi-whatsapp fs-3 mt-4 me-2"></i>Call today 09 290 3820 </p>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="d-block" style="border-bottom: 1px solid #00000033; margin-left: -.7rem;"></span>
                <div class="py-3">
                    <div class="">
                        <ul class="list-unstyled d-flex justify-content-end">
                            <li class="nav-item mt-2">
                                <a class="nav-link" style="font-weight: 700;" 
                                    href="index.php"><?= $bddContentTexts['nav_link_1']['content_fr'] ?? "Accueil" ?></a>
                            </li>
                            <li class="nav-item mt-2 ms-3">
                                <a class="nav-link" style="font-weight: 700;"
                                    href="about.php"><?= $bddContentTexts['nav_link_2']['content_fr'] ?? "A propos" ?></a>
                            </li>
                            <li class="nav-item mt-2 ms-3">
                                <a class="nav-link" style="font-weight: 700;" 
                                    href="index.php#section3"><?= $bddContentTexts['nav_link_3']['content_fr'] ?? "Activities" ?></a>
                            </li>
                            <li class="nav-item mt-2 ms-3">
                                <a class="nav-link" style="font-weight: 700;" 
                                    href="index.php#section4"><?= $bddContentTexts['nav_link_4']['content_fr'] ?? "Programmes" ?></a>
                            </li>
                            <li class="nav-item mt-2 ms-3">
                                <a class="nav-link" style="font-weight: 700;" 
                                    href="index.php#section5"><?= $bddContentTexts['nav_link_6']['content_fr'] ?? "Events" ?></a>
                            </li>
                            <li class="nav-item mb-3 ms-3">
                                <button class="btn btn-white px-3 text-white" style="background: #61BC45;" onclick="window.location.href='contact.php'"><?= $bddContentTexts['nav_link_5']['content_fr'] ?? "Join Now" ?> <i class="bi bi-arrow-right-circle"></i></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-lg-none">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-lg">
            <a class="navbar-brand" href="#"><img src="images/image 1.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" style="font-weight: 700;" 
                                href="index.php"><?= $bddContentTexts['nav_link_1']['content_fr'] ?? "Accueil" ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="font-weight: 700;"
                                href="about.php"><?= $bddContentTexts['nav_link_2']['content_fr'] ?? "A propos" ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="font-weight: 700;" href="index.php#section3"><?= $bddContentTexts['nav_link_3']['content_fr'] ?? "Activities" ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="font-weight: 700;" href="index.php#section4"><?= $bddContentTexts['nav_link_4']['content_fr'] ?? "Programmes" ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="font-weight: 700;" 
                                href="index.php#section5"><?= $bddContentTexts['nav_link_6']['content_fr'] ?? "Events" ?></a>
                    </li>
                    <li class="nav-item">
                        <button class="btn px-3 text-white" style="background: #61BC45;" onclick="window.location.href='contact.php'">
                        <?= $bddContentTexts['nav_link_5']['content_fr'] ?? "Join Now" ?> <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
