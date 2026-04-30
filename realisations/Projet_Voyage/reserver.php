<?php
$conn = new mysqli("localhost", "root", "", "voyage");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$confirmation = "";

// Récupérer les voyages pour le menu déroulant
$voyages = [];
$voyageQuery = "SELECT destination.nom,  prix, date_depart, date_retour FROM voyage
JOIN destination ON voyage.id_destination= destination.id_destination";
$voyageResult = $conn->query($voyageQuery);
if ($voyageResult) {
    while ($row = $voyageResult->fetch_assoc()) {
        $voyages[] = $row;
    }
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $conn->real_escape_string($_POST["nom"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $voyage_id = (int) $_POST["voyage"];
    $date_reservation = $conn->real_escape_string($_POST["date_reservation"]);


    $sql = "INSERT INTO reservations (nom, email, voyage_id, date_reservation)
            VALUES ('$nom', '$email', $voyage_id, '$date_reservation')";

    if ($conn->query($sql) === TRUE) {
        $confirmation = "✅ Réservation enregistrée avec succès !";
    } else {
        $confirmation = "❌ Erreur : " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réserver un voyage</title>
    <link rel="stylesheet" href="reserver.css">
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
        <h1>Réserver un voyage</h1>

        <?php if ($confirmation): ?>
            <div class="confirmation"><?= $confirmation ?></div>
        <?php endif; ?>

        <form method="post" class="form-reservation">
            <input type="text" name="nom" placeholder="Votre nom" required>
            <input type="email" name="email" placeholder="Votre email" required>
            <select name="voyage" required>
                <option value="">-- Choisissez un voyage --</option>
                <?php foreach ($voyages as $voyage): ?>
                    <option value="<?= $voyage['nom'] ?>"><?= htmlspecialchars($voyage['date_depart']) ?><?= htmlspecialchars($voyage['date_retour']) ?><?= htmlspecialchars($voyage['prix']) ?></option>
                <?php endforeach; ?>
            </select>
            <input type="date" name="date_reservation" required>
            <button type="submit">Réserver</button>
        </form>
    </main>
</body>
</html>