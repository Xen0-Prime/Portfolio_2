<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voiti Nèf — Accueil</title>
    <link rel="stylesheet" href="voiti-shared.css">
    <link rel="stylesheet" href="Accueil.css">
</head>
<body>

<?php $current_page = 'accueil'; $nav_title = 'Voiti Nèf'; include 'navbar.php'; ?>

<p class="fondText">
    On vous propose une gamme diversifiée de véhicules neufs adaptés à tous les budgets.
    <br>
    Basée en Guadeloupe, l'entreprise met un point d'honneur à fournir des services personnalisés et un accompagnement complet à ses clients.
    <br>
    Avec une équipe expérimentée et passionnée, "Voiti Nèf" est le partenaire idéal pour l'acquisition de votre prochain véhicule.
</p>

<div class="carousel">
    <div class="carousel-images">
        <img src="ressources%20voiti%20nef/carrousel/carrousel_1.jpg" alt="carrousel 1">
        <img src="ressources%20voiti%20nef/carrousel/carrousel_2.jpg" alt="carrousel 2">
        <img src="ressources%20voiti%20nef/carrousel/carrousel_3.jpg" alt="carrousel 3">
        <img src="ressources%20voiti%20nef/carrousel/carrousel_4.jpg" alt="carrousel 4">
        <img src="ressources%20voiti%20nef/carrousel/carrousel_5.jpg" alt="carrousel 5">
        <img src="ressources%20voiti%20nef/carrousel/carrousel_6.jpg" alt="carrousel 6">
    </div>
</div>

<div class="bouton">
    <a href="nosVoitures.php">Découvrir nos voitures</a>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
