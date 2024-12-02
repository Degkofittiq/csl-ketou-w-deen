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
<title>HomePage</title>
<link rel="stylesheet" href="./index.css">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<!-- <?= $bddContentTexts['horaire_section_titre_jour']['content_fr'] ?? 'Jours'  ?> -->