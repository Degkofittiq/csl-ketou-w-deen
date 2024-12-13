<?php
    require('./config/database.php');

    // Exécution de la requête SQL
    $sql = "SELECT * FROM content_text_management";
    $stmt = $pdo->query($sql);

    // Récupération des résultats
    $bddContentTexts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Exécution de la requête SQL
    $sql = "SELECT * FROM content_text_management";
    $stmt = $pdo->query($sql);

    // Récupération des résultats et organisation dans un tableau associatif avec le 'name' comme clé
    $bddContentTexts = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $bddContentTexts[$row['name']] = $row;
    }

    // Exécution de la requête SQL pour récupérer les images
    $sql2 = "SELECT * FROM content_image_management";
    $stmt2 = $pdo->query($sql2);

    // Récupération des résultats et organisation dans un tableau associatif avec le 'name' comme clé
    $bddContentImages = [];
    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $bddContentImages[$row['name']] = $row;
    }
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="shortcut icon" href="image/image 1.ico" type="image/x-icon">
<link rel="stylesheet" href="./index.css?v=1.0.0">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

 <!-- OwlCarousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Lien CDN de Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>


<style>
    .circle-icon {
        background-color: black; /* Fond noir */
        color: white;             /* Icône en blanc */
        border-radius: 50%;       /* Pour faire un cercle */
        width: 22px;            /* Espacement autour de l'icône */
        height: 22px;
        font-size: 14px;          /* Taille de l'icône */
        display: inline-block;    /* Pour qu'il se comporte comme une icône */
        text-align: center;
    }



  .text-container2 {
      /*width: 300px;  Ajustez la largeur selon vos besoins */
      /*white-space: nowrap;*/
      overflow: hidden;
      text-overflow: ellipsis;
      cursor: pointer;
      /*border: 1px solid #ccc;*/
      /*padding: 10px;*/
      transition: all 0.3s ease;
  }

  .text-container2.expanded {
      white-space: normal; /* Permet l'affichage complet */
      overflow: visible; /* Supprime la troncature */
      text-overflow: clip;
  }
  

    .text-container3 p {
        max-height: 280px;
        overflow: hidden;
        position: relative;
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


<!-- <?= $bddContentTexts['horaire_section_titre_jour']['content_fr'] ?? 'Jours'  ?> -->