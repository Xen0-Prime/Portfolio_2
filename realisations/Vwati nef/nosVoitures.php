<?php
require_once 'db_config.php';

// ── Récupère toutes les voitures disponibles avec marque et carburant ────────
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

// ── Récupère la note moyenne par voiture (avis validés) ─────────────────────
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
    <link rel="stylesheet" type="text/css" href="nosVoitures.css">
    <title>Voiti Nèf — Nos voitures</title>
    <style>
        /* ── Grille dynamique ───────────────────────────────────── */
        .contenu {
            margin-top: 120px;
            padding: 20px 40px 100px;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }

        .voiture {
            float: none;
            width: 240px;
            background: #800020;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
            cursor: pointer;
        }
        .voiture:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.5);
        }

        .toggle-header {
            cursor: pointer;
            padding: 12px;
            text-align: center;
        }
        .toggle-header img {
            width: 100%;
            height: 140px;
            object-fit: contain;
            background: #fff;
            border-radius: 6px;
        }
        .toggle-header h3 {
            color: #fff;
            font-size: 15px;
            margin-top: 8px;
        }

        .badge-carburant {
            display: inline-block;
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 20px;
            margin-top: 4px;
            font-weight: 600;
        }
        .badge-Diesel     { background: #374151; color: #d1d5db; }
        .badge-Essence    { background: #1d4ed8; color: #bfdbfe; }
        .badge-Hybride    { background: #065f46; color: #6ee7b7; }
        .badge-Électrique { background: #4c1d95; color: #ddd6fe; }

        .toggle-content {
            display: none;
            padding: 12px 16px;
            background: rgba(0,0,0,0.25);
            color: #fff;
            border-top: 1px solid rgba(255,255,255,0.2);
        }
        .toggle-content ul {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 13px;
            line-height: 1.8;
        }
        .toggle-content ul li::before {
            content: "› ";
            color: #ffaaaa;
        }

        /* Note étoiles */
        .stars { color: #fbbf24; font-size: 13px; margin-top: 6px; }
        .stars span { color: #fff; font-size: 11px; margin-left: 4px; }

        /* Indisponible */
        .badge-indispo {
            display: inline-block;
            background: #6b7280;
            color: #fff;
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 20px;
            margin-top: 4px;
        }

        footer {
            position: fixed;
        }

        /* ── Compteur ───────────────────────────────────────────── */
        .count-bar {
            text-align: center;
            font-size: 13px;
            color: #555;
            margin-bottom: 8px;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <header>
        <img src="ressources%20voiti%20nef/logo.png" alt="logo de Voiti nèf" class="logo">
        <center>
            <h1 class="titre">Nos voitures</h1>
            <nav class="navBar">
                <ul class="navUl">
                    <li><a href="Accueil.php">Accueil</a></li>
                    <li><a href="nosVoitures.php" class="active">Nos voitures</a></li>
                    <li><a href="aPropos.php">À propos</a></li>
                    <li><a href="admin.html">Admin</a></li>
                </ul>
            </nav>
        </center>
    </header>

    <main>
        <div class="count-bar">
            <?= count($voitures) ?> véhicule<?= count($voitures) > 1 ? 's' : '' ?> au catalogue — cliquez pour voir les détails
        </div>

        <div class="contenu">
        <?php foreach ($voitures as $v):
            $id       = $v['id_voiture'];
            $titre    = htmlspecialchars($v['nom_marque'] . ' ' . $v['modele']);
            $carb     = htmlspecialchars($v['type_carburant']);
            $image    = htmlspecialchars($v['image'] ?? '');
            $note     = $notes[$id] ?? null;
            $dispo    = (bool)$v['disponible'];
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
        <p>© 2024 Voiti Nèf - Tous droits réservés</p>
        <center class="adresse">
            <p>Voiti Nèf, Rue des Palmiers, Pointe-à-Pitre, Guadeloupe</p>
        </center>
    </footer>

    <script>
    function toggleBlock(header) {
        const content = header.nextElementSibling;
        content.style.display = content.style.display === 'block' ? 'none' : 'block';
    }
    </script>
</body>
</html>
