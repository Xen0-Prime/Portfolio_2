<?php
$conn = new mysqli("localhost", "root", "", "voyage");
if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

// Destinations populaires : ex. voyages les plus réservés
$destinations = $conn->query("
    SELECT *
    FROM destination LIMIT 5
");

// Témoignages utilisateurs (depuis la colonne 'avis_utilisateur' de la table voyages)
$avis = $conn->query("
    SELECT utilisateur.nom, utilisateur.date_inscription, commentaire, note, date_avis
    FROM avis
    JOIN utilisateur ON utilisateur.id_utilisateur=avis.id_utilisateur

");

$images = [
    'Paris' => 'Paris.jpg',
    'Londres' => 'Londres.jpg',
    'New York' => 'NYC.jpg',
    'Tokyo' => 'Tokyo.jpg',
    'Sydney' => 'sydney.webp',
];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Accueil</title>
        <link rel="stylesheet" href="accueil.css">
    </head>
    <body>
        <header class="site-header">
            <div class="logo">🌍 TravelNow</div>
                <nav class="nav-menu">
                    <a href="accueil.php">Accueil</a>
                    <a href="voyages.php">Voyages</a>
                    <a href="contact.php">Contact</a>
                    <a href="reserver.php">Réserver</a>
                </nav>
        </header>
        <div class="carousel">
            <button class="prev">&#10094;</button>
            <div class="carousel-images">
                <img src="Paris.jpg" class="carousel-item" alt="Paris">
                <img src="NYC.jpg" class="carousel-item" alt="NYC">
                <img src="img_destination\Tokyo.jpg" class="carousel-item" alt="Tokyo">
                <img src="img_destination\Londres.jpg" class="carousel-item" alt="Londres">
                <img src="img_destination\sydney.webp" class="carousel-item" alt="Sydney">
            </div>
            <button class="next">&#10095;</button>
        </div>
        
        <br>
        <section class="presentation">
          <h2>Bienvenue sur TravelNow</h2>
          <p>
            TravelNow est votre compagnon idéal pour organiser des voyages de rêve aux quatre coins du monde. Que vous soyez amateur de plages paradisiaques, de grandes villes, ou d’aventures en pleine nature, nous avons ce qu’il vous faut !
          </p>
        
          <div class="services">
            <div class="services">
              <div class="service-card">
                <h3>✈️ Réservation de vols</h3>
                <p>Comparez et réservez des vols au meilleur prix partout dans le monde.</p>
                <a href="reserver.php" class="btn-service">Réserver votre futur voyage</a>
              </div>
            
              <div class="service-card">
                <h3>🏨 Hôtels & Hébergements</h3>
                <p>Des hôtels confortables, des auberges locales ou des logements insolites.</p>
                <a href="" class="btn-service1">Réserver votre Hôtel/Hébergement</a>
              </div>
            
              <div class="service-card">
                <h3>📦 Packs tout compris</h3>
                <p>Vol + hôtel + activités : profitez de nos formules clé en main !</p>
                <a href="" class="btn-service2">Prévoyez vos prochaines activités</a>
              </div>
          </div>
        </section>
        <br>
        <section class="presentation">
        <h2>🌟 Destinations populaires</h2>
        <div class="services">
            <?php while ($row = $destinations->fetch_assoc()): ?>
                <div class="service-card1">
                    <h3><?= htmlspecialchars($row['nom']) ?></h3>

                    <?php
                    $nom = $row['nom'];
                    if (array_key_exists($nom, $images)) {
                        $imagePath = 'img_destination/' . $images[$nom];
                    ?>
                        <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($nom) ?>" style="width: 100%; border-radius: 8px; margin-top: 10px;">
                    <?php } else { ?>
                        <p>Aucune image disponible</p>
                    <?php } ?>
                </div>
            <?php endwhile; ?>
        </div>
    </section>        <bottom>
    <section class="reviews-section">
    <h2>🗣 Témoignages de nos utilisateurs</h2>
    <div class="reviews-container">
        <?php while ($row = $avis->fetch_assoc()): ?>
            <div class="review-card">
                <p><strong><?= htmlspecialchars($row['nom']) ?></strong> (inscrit le <?= htmlspecialchars($row['date_inscription']) ?>)</p>
                <p>"<?= nl2br(htmlspecialchars($row['commentaire'])) ?>"</p>
                <p>Note : <?= htmlspecialchars($row['note']) ?>/5 ⭐</p>
                <p><small>Avis publié le <?= htmlspecialchars($row['date_avis']) ?></small></p>
            </div>
        <?php endwhile; ?>
    </div>
</section>
        </bottom>
    <script src="accueil.js"></script>
        </body>
</html>