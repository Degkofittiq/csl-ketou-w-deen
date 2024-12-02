
<?php

// Inclure le fichier PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';  // Si tu utilises Composer

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
<footer class="container-fluid p-3">
        <span class="my-4 d-flex" style="border-bottom: 4px solid #61BC45;"></span>
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-5 mx-auto mb-3 mb-md-0">
                    <h5 class="fw-bold">Email Alerts</h5>
                    <p>Stay Updated! Subscribe to our newsletter</p>
                    <div class="d-flex flex-column">
                        <form action="" method="post">
                            <div class="">
                                <input name="email" type="email" class="form-control form py-3" placeholder="Email Address">
                            </div>
                            <div class="mt-4">
                                <button  name="btn_footer_subscribe" class="btn btn-white w-100 py-3 text-white" style="background: #61BC45;" onclick="window.location.href='contact.php'">Subscribe now <i class="bi bi-arrow-right-circle"></i></button>
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
                <div class="col-lg-3 mx-auto mb-3 mb-md-0">
                    <h5 class="fw-bold">About</h5>
                    <p style="white-space: nowrap;">P : 09 290 3820 
                        <br>
                        E : enquiry@yourdomain.com
                    </p>
                    <p class="mt-3">Address <br> CSL Kétou, Arojú Owò</p>
                </div>
                <div class="col-lg-2 mx-auto mb-3 mb-md-0">
                    <h5 class="fw-bold">Contact us</h5>
                    <ul class="list-unstyled">
                        <li><a href="" style="color: #484848; text-decoration: none;">Home</a></li>
                        <li><a href="" style="color: #484848; text-decoration: none;">About Us</a></li>
                        <li><a href="" style="color: #484848; text-decoration: none;">Activities</a></li>
                        <li><a href="" style="color: #484848; text-decoration: none;">Membership</a></li>
                        <li><a href="" style="color: #484848; text-decoration: none;">Events</a></li>
                        <li><a href="" style="color: #484848; text-decoration: none;">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 mx-auto mb-3 mb-md-0">
                    <img src="images/1.png" alt="" class="image-fluid w-100">
                </div>
            </div>
        </div>
        <div class="position-relative">
            <span class="d-block my-4" style="border-top: 1px solid #000000; "></span>
            <p class="text-center py-3">© Copyright 2024  CSL Arojú Owò  All Rights Reserved  | Terms of use  | Privacy Policy</p>
            <div class="pot">
                <a href=""><img src="images/chatbot.png" alt=""></a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var toastEl = document.getElementById('myToast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    </script>