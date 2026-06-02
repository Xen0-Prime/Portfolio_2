<?php
require_once 'db_config.php';

$nbVoitures  = $pdo->query("SELECT COUNT(*) FROM VOITURE WHERE disponible = TRUE")->fetchColumn();
$nbClients   = $pdo->query("SELECT COUNT(*) FROM CLIENT")->fetchColumn();
$noteMoyenne = $pdo->query("SELECT ROUND(AVG(note),1) FROM AVIS WHERE valide = TRUE")->fetchColumn();
$nbMarques   = $pdo->query("SELECT COUNT(DISTINCT id_marque) FROM VOITURE")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voiti Nèf — À propos</title>
    <link rel="stylesheet" href="voiti-shared.css">
    <link rel="stylesheet" href="aPropos.css">
</head>
<body>

<?php $current_page = 'apropos'; $nav_title = 'Voiti Nèf'; include 'navbar.php'; ?>

<div class="apropos-wrapper">

    <div class="apropos-hero">
        <h2>🚗 Voiti Nèf</h2>
        <p>
            Votre concessionnaire automobile de confiance en Guadeloupe. Depuis notre création,
            nous mettons tout en œuvre pour vous proposer les meilleurs véhicules neufs,
            au meilleur prix, avec un accompagnement personnalisé du premier contact
            jusqu'à la remise des clés.
        </p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-num"><?= $nbVoitures ?></div>
            <div class="stat-lbl">Véhicules disponibles</div>
        </div>
        <div class="stat-card">
            <div class="stat-num"><?= $nbMarques ?></div>
            <div class="stat-lbl">Marques au catalogue</div>
        </div>
        <div class="stat-card">
            <div class="stat-num"><?= $nbClients ?></div>
            <div class="stat-lbl">Clients satisfaits</div>
        </div>
        <div class="stat-card">
            <div class="stat-num"><?= $noteMoyenne ?? '—' ?>/5</div>
            <div class="stat-lbl">Note moyenne clients</div>
        </div>
    </div>

    <div class="section-card">
        <h3>📖 Notre histoire</h3>
        <p>
            Fondée en Guadeloupe, <strong>Voiti Nèf</strong> (qui signifie littéralement
            "Voiture Neuve" en créole) est née d'une passion pour l'automobile et d'une
            volonté de proposer aux habitants de l'île une expérience d'achat moderne,
            transparente et bienveillante.
        </p>
        <p style="margin-top:10px;">
            Nous sommes convaincus que l'acquisition d'un véhicule est une étape importante
            dans la vie de chacun. C'est pourquoi nous accompagnons nos clients à chaque
            étape : choix du modèle, financement, livraison et suivi après-vente.
        </p>
    </div>

    <div class="section-card">
        <h3>💎 Nos valeurs</h3>
        <ul>
            <li><strong>Transparence</strong> — Pas de frais cachés, des prix clairs et honnêtes</li>
            <li><strong>Proximité</strong> — Une équipe locale qui connaît les besoins des Guadeloupéens</li>
            <li><strong>Qualité</strong> — Uniquement des véhicules neufs sélectionnés avec soin</li>
            <li><strong>Service</strong> — Un accompagnement personnalisé de A à Z</li>
            <li><strong>Innovation</strong> — Des véhicules hybrides et électriques pour préparer l'avenir</li>
        </ul>
    </div>

    <div class="section-card">
        <h3>👥 Notre équipe</h3>
        <p>Une équipe expérimentée et passionnée à votre service :</p>
        <div class="equipe-grid">
            <div class="membre">
                <div class="avatar">👨‍💼</div>
                <div class="nom">Jean-Marc Loiseau</div>
                <div class="role">Directeur commercial</div>
            </div>
            <div class="membre">
                <div class="avatar">👩‍💼</div>
                <div class="nom">Marie-Ange Céleste</div>
                <div class="role">Conseillère clientèle</div>
            </div>
            <div class="membre">
                <div class="avatar">🔧</div>
                <div class="nom">Éric Montrose</div>
                <div class="role">Responsable technique</div>
            </div>
        </div>
    </div>

    <div class="section-card">
        <h3>📍 Nous contacter</h3>
        <div class="contact-info">
            <div class="contact-item">
                <span class="ico">📌</span>
                <span>Rue des Palmiers, Pointe-à-Pitre, Guadeloupe (97110)</span>
            </div>
            <div class="contact-item">
                <span class="ico">📞</span>
                <span>+590 590 XX XX XX</span>
            </div>
            <div class="contact-item">
                <span class="ico">✉️</span>
                <span>contact@voitinef.gp</span>
            </div>
            <div class="contact-item">
                <span class="ico">🕐</span>
                <span>Lun–Sam : 8h–18h</span>
            </div>
        </div>
    </div>

</div>

<?php include 'footer.php'; ?>

</body>
</html>
