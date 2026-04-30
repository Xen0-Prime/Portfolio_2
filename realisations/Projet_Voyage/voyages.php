<?php
$conn = new mysqli("localhost", "root", "", "voyage");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$destination = $_GET['destination'] ?? '';
$prix_max = $_GET['prix_max'] ?? '';
$date_depart = $_GET['date_depart'] ?? '';

$sql = "SELECT date_depart, date_retour, prix, destination.nom, destination.description 
        FROM voyage
        JOIN destination ON destination.id_destination=voyage.id_destination
        LIMIT 5";
if (!empty($destination)) {
    $destination = $conn->real_escape_string($destination);
    $sql .= " AND destination LIKE '%$destination%'";
}
if (!empty($prix_max)) {
    $prix_max = (float)$prix_max;
    $sql .= " AND prix <= $prix_max";
}
if (!empty($date_depart)) {
    $date_depart = $conn->real_escape_string($date_depart);
    $sql .= " AND date_depart >= '$date_depart'";
}
$result = $conn->query($sql);

$images = [
    'Paris' => 'Paris.jpg',
    'Londres' => 'Londres.jpg',
    'New York' => 'NYC.jpg',
    'Tokyo' => 'Tokyo.jpg',
    'Sydney' => 'sydney.webp'
];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voyages</title>
    <link rel="stylesheet" href="voyage.css">
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

    <main>
        <h1>Liste des Voyages</h1>

        <form method="get" class="filtre-form">
            <input type="text" name="destination" placeholder="Destination" value="<?= htmlspecialchars($destination) ?>">
            <input type="number" name="prix_max" placeholder="Prix max (€)" value="<?= htmlspecialchars($prix_max) ?>">
            <input type="date" name="date_depart" value="<?= htmlspecialchars($date_depart) ?>">
            <button type="submit">Filtrer</button>
        </form>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($voyage = $result->fetch_assoc()): ?>
                <div class="voyage-card">
                    <h2><?= htmlspecialchars($voyage['nom']) ?> – <?= $voyage['prix'] ?>€</h2>
                    <p><strong>Départ :</strong> <?= htmlspecialchars($voyage['date_depart']) ?></p>
                    <p><?= nl2br(htmlspecialchars($voyage['description'])) ?></p>
                    <?php if (array_key_exists($voyage['nom'], $images)): ?>
                        <img src="img_destination/<?= htmlspecialchars($images[$voyage['nom']]) ?>" alt="<?= htmlspecialchars($voyage['nom']) ?>" style="width: 100%; max-width: 300px; border-radius: 8px; margin: 10px 0;">                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Aucun voyage trouvé.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </main>
</body>
</html>
