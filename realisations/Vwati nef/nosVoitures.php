<?php
require_once 'db_config.php';

$stmt = $pdo->query("
    SELECT v.id_voiture, v.modele, v.annee, v.cylindree, v.puissance_ch,
           v.prix_journalier, v.image, v.disponible,
           m.nom_marque,
           c.type_carburant
    FROM VOITURE v
    JOIN MARQUE    m ON v.id_marque    = m.id_marque
    JOIN CARBURANT c ON v.id_carburant = c.id_carburant
    ORDER BY m.nom_marque, v.modele
");
$voitures = $stmt->fetchAll();

$notes = [];
$stmtNotes = $pdo->query("
    SELECT id_voiture, ROUND(AVG(note), 1) AS note_moy, COUNT(*) AS nb_avis
    FROM AVIS
    WHERE valide = TRUE
    GROUP BY id_voiture
");
foreach ($stmtNotes->fetchAll() as $row) {
    $notes[$row['id_voiture']] = $row;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voiti Nèf — Nos voitures</title>
    <link rel="stylesheet" href="voiti-shared.css">
    <link rel="stylesheet" href="nosVoitures.css">
</head>
<body>

<?php $current_page = 'voitures'; $nav_title = 'Voiti Nèf'; include 'navbar.php'; ?>

<main>
    <div class="contenu">
        <div class="count-bar" style="width:100%;text-align:center;margin-bottom:12px;">
            <?= count($voitures) ?> véhicule<?= count($voitures) > 1 ? 's' : '' ?> au catalogue — cliquez pour voir les détails
        </div>

        <?php foreach ($voitures as $v):
            $id    = $v['id_voiture'];
            $titre = htmlspecialchars($v['nom_marque'] . ' ' . $v['modele']);
            $carb  = htmlspecialchars($v['type_carburant']);
            $image = htmlspecialchars($v['image'] ?? '');
            $note  = $notes[$id] ?? null;
            $dispo = (bool)$v['disponible'];
        ?>
        <div class="voiture" onclick="toggleBlock(this.querySelector('.toggle-header'))">
            <div class="toggle-header">
                <img
                    src="<?= $image ?>"
                    alt="<?= $titre ?>"
                    onerror="this.src='ressources%20voiti%20nef/voitures/placeholder.png';this.onerror=null;"
                >
                <h3><?= $titre ?></h3>
                <span class="badge-carburant badge-<?= $carb ?>"><?= $carb ?></span>
                <?php if (!$dispo): ?>
                    <br><span class="badge-indispo">Indisponible</span>
                <?php endif; ?>
                <?php if ($note): ?>
                    <div class="stars">
                        <?= str_repeat('★', (int)$note['note_moy']) ?><?= str_repeat('☆', 5 - (int)$note['note_moy']) ?>
                        <span><?= $note['note_moy'] ?>/5 (<?= $note['nb_avis'] ?> avis)</span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="toggle-content">
                <ul>
                    <li>Année : <?= (int)$v['annee'] ?></li>
                    <?php if ($v['cylindree']): ?>
                    <li>Cylindrée : <?= htmlspecialchars($v['cylindree']) ?></li>
                    <?php endif; ?>
                    <?php if ($v['puissance_ch']): ?>
                    <li>Puissance : <?= (int)$v['puissance_ch'] ?> ch</li>
                    <?php endif; ?>
                    <li>Carburant : <?= $carb ?></li>
                    <li>Prix/jour : <?= number_format($v['prix_journalier'], 2, ',', ' ') ?> €</li>
                    <li>Disponibilité : <?= $dispo ? '✅ Disponible' : '❌ Indisponible' ?></li>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>

<footer>
    <p>© 2024 Voiti Nèf — Tous droits réservés</p>
    <p>Rue des Palmiers, Pointe-à-Pitre, Guadeloupe</p>
</footer>

<script>
function toggleBlock(header) {
    const content = header.nextElementSibling;
    content.style.display = content.style.display === 'block' ? 'none' : 'block';
}
</script>

</body>
</html>
