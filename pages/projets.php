<?php
// Mapping compétences → projets
$competences_map = [
    'B1' => ['vwati-nef', 'projet-voyage'],
    'B2' => ['projet-iot', 'gestion-stock'],
    'B3' => ['gestion-stock', 'gestion-absences', 'vwati-nef', 'projet-iot', 'projet-voyage', 'projet-symfony'],
    'B4' => ['gestion-absences', 'vwati-nef', 'projet-symfony'],
    'B5' => ['projet-iot', 'gestion-stock', 'gestion-absences'],
    'B6' => ['projet-symfony', 'projet-voyage'],
];

$competences_labels = [
    'B1' => 'Support & mise à disposition',
    'B2' => 'Réponse aux incidents',
    'B3' => 'Développement d\'applications',
    'B4' => 'Travail en équipe',
    'B5' => 'Gestion de l\'infrastructure',
    'B6' => 'Organisation du SI',
];

$filtre = isset($_GET['competence']) ? strtoupper(trim($_GET['competence'])) : null;
$projets_actifs = ($filtre && isset($competences_map[$filtre])) ? $competences_map[$filtre] : null;

// Compétences de chaque projet (pour affichage des tags)
$projet_competences = [
    'gestion-stock'    => ['B2', 'B3', 'B5'],
    'gestion-absences' => ['B3', 'B4', 'B5'],
    'vwati-nef'        => ['B1', 'B3', 'B4'],
    'projet-iot'       => ['B2', 'B3', 'B5'],
    'projet-voyage'    => ['B1', 'B3', 'B6'],
    'projet-symfony'   => ['B3', 'B4', 'B6'],
];

function is_visible(string $id, ?array $actifs): bool {
    return $actifs === null || in_array($id, $actifs);
}

function competence_tags(string $id, array $map): string {
    global $competences_labels;
    $out = '<div class="competence-tags">';
    foreach ($map[$id] ?? [] as $code) {
        $label = $competences_labels[$code] ?? $code;
        $out .= '<span class="ctag ctag-' . strtolower($code) . '">' . htmlspecialchars($label) . '</span>';
    }
    return $out . '</div>';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets<?= ($filtre && isset($competences_labels[$filtre])) ? ' — ' . $competences_labels[$filtre] : '' ?> · Portfolio BTS SIO</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/projets.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">Portfolio</div>
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="projets.php" class="active">Projets</a></li>
                <li><a href="../stages/stages.php">Stages</a></li>
                <li><a href="veille.php">Veille</a></li>
                <li><a href="certifications.php">Certifications</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">
                <?php if ($filtre && isset($competences_labels[$filtre])): ?>

                    <?= htmlspecialchars($competences_labels[$filtre]) ?>
                <?php else: ?>
                    Mes Projets
                <?php endif; ?>
            </h1>
            <p class="page-subtitle">Portfolio de développements BTS SIO SLAM</p>
        </div>
    </section>

    <!-- Barre de filtre -->
    <section class="section" style="padding-bottom:0">
        <div class="container">
            <?php if ($filtre && isset($competences_labels[$filtre])): ?>
                <div class="competence-filter-bar">
                    <span class="competence-filter-label">Filtre actif :</span>
                    <span class="competence-active-tag"><?= htmlspecialchars($competences_labels[$filtre]) ?></span>
                    <a href="projets.php" class="filter-reset">✕ Tous les projets</a>
                </div>
            <?php elseif ($filtre): ?>
                <div class="competence-filter-bar">
                    <span class="competence-filter-label">Compétence inconnue : <?= htmlspecialchars($filtre) ?></span>
                    <a href="projets.php" class="filter-reset">✕ Tous les projets</a>
                </div>
            <?php else: ?>
                <p class="intro-text">
                    Découvrez en détail mes projets développés dans le cadre du BTS SIO option SLAM.
                    Chaque projet illustre mes compétences techniques et ma progression.<br>
                    <a href="index.php" style="font-size:0.9rem">← Retour au tableau de bord compétences</a>
                </p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Projet 1: Gestion de Stock -->
    <section id="gestion-stock" class="project-detail-section<?= !is_visible('gestion-stock', $projets_actifs) ? ' hidden' : '' ?>">
        <div class="container">
            <div class="project-detail-card">
                <div class="project-detail-header">
                    <h2>Gestion de Stock</h2>
                    <div class="project-badges">
                        <span class="badge badge-java">Java</span>
                        <span class="badge badge-database">Base de données</span>
                    </div>
                </div>
                <?= competence_tags('gestion-stock', $projet_competences) ?>
                <div class="project-content">
                    <div class="project-overview">
                        <h3>Description du projet</h3>
                        <p>Application de gestion de stock développée en Java avec interface graphique Swing.
                        Elle permet de gérer les produits, les stocks, les fournisseurs et de générer des rapports.
                        L'application est connectée à une base de données MySQL pour la persistance des données.</p>
                    </div>
                    <div class="project-features">
                        <h3>Fonctionnalités principales</h3>
                        <ul class="features-list">
                            <li>Gestion complète des produits (CRUD)</li>
                            <li>Suivi des stocks en temps réel</li>
                            <li>Système d'alertes pour les ruptures de stock</li>
                            <li>Gestion des fournisseurs</li>
                            <li>Génération de rapports PDF</li>
                            <li>Interface graphique intuitive</li>
                        </ul>
                    </div>
                    <div class="project-tech">
                        <h3>Technologies utilisées</h3>
                        <div class="tech-grid">
                            <div class="tech-item"><strong>Langage :</strong> Java 11</div>
                            <div class="tech-item"><strong>Interface :</strong> Java Swing</div>
                            <div class="tech-item"><strong>Base de données :</strong> MySQL</div>
                            <div class="tech-item"><strong>Connecteur :</strong> JDBC</div>
                            <div class="tech-item"><strong>IDE :</strong> NetBeans</div>
                            <div class="tech-item"><strong>BDD :</strong> PHPMyAdmin</div>
                        </div>
                    </div>
                    <div class="project-links">
                        <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/Gestion%20de%20stock" class="btn btn-primary" target="_blank">Voir le code source →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projet 2: Gestion d'Absences -->
    <section id="gestion-absences" class="project-detail-section<?= !is_visible('gestion-absences', $projets_actifs) ? ' hidden' : '' ?>">
        <div class="container">
            <div class="project-detail-card">
                <div class="project-detail-header">
                    <h2>Gestion d'Absences</h2>
                    <div class="project-badges">
                        <span class="badge badge-mobile">Mobile</span>
                        <span class="badge badge-api">API REST</span>
                    </div>
                </div>
                <?= competence_tags('gestion-absences', $projet_competences) ?>
                <div class="project-content">
                    <div class="project-overview">
                        <h3>Description du projet</h3>
                        <p>Application mobile React Native permettant aux utilisateurs de gérer leurs demandes d'absence
                        avec un système de validation hiérarchique.</p>
                    </div>
                    <div class="project-features">
                        <h3>Fonctionnalités principales</h3>
                        <ul class="features-list">
                            <li>Authentification sécurisée</li>
                            <li>Soumission et suivi des demandes d'absence</li>
                            <li>Workflow de validation multi-niveaux</li>
                            <li>Notifications push</li>
                            <li>Interface responsive mobile-first</li>
                        </ul>
                    </div>
                    <div class="project-tech">
                        <h3>Technologies utilisées</h3>
                        <div class="tech-grid">
                            <div class="tech-item"><strong>Framework :</strong> React Native</div>
                            <div class="tech-item"><strong>Langage :</strong> JavaScript</div>
                            <div class="tech-item"><strong>API :</strong> REST / Node.js</div>
                            <div class="tech-item"><strong>Base de données :</strong> PostgreSQL</div>
                        </div>
                    </div>
                    <div class="project-links">
                        <a href="https://github.com/Laeticia18/Appli-mobile-react.git" class="btn btn-primary" target="_blank">Voir le code source →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projet 3: Vwati Nef -->
    <section id="vwati-nef" class="project-detail-section<?= !is_visible('vwati-nef', $projets_actifs) ? ' hidden' : '' ?>">
        <div class="container">
            <div class="project-detail-card">
                <div class="project-detail-header">
                    <h2>Vwati Nef</h2>
                    <div class="project-badges">
                        <span class="badge badge-web">Web</span>
                        <span class="badge badge-php">PHP</span>
                    </div>
                </div>
                <?= competence_tags('vwati-nef', $projet_competences) ?>
                <div class="project-content">
                    <div class="project-overview">
                        <h3>Description du projet</h3>
                        <p>Site web de concessionnaire automobile avec catalogue de véhicules, système de recherche
                        et interface d'administration.</p>
                    </div>
                    <div class="project-features">
                        <h3>Fonctionnalités principales</h3>
                        <ul class="features-list">
                            <li>Catalogue de véhicules avec filtres</li>
                            <li>Fiche détail par véhicule</li>
                            <li>Interface d'administration</li>
                            <li>Formulaire de contact</li>
                            <li>Design responsive</li>
                        </ul>
                    </div>
                    <div class="project-tech">
                        <h3>Technologies utilisées</h3>
                        <div class="tech-grid">
                            <div class="tech-item"><strong>Frontend :</strong> HTML / CSS / JS</div>
                            <div class="tech-item"><strong>Backend :</strong> PHP</div>
                        </div>
                    </div>
                    <div class="project-links">
                        <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/Vwati%20nef" class="btn btn-primary" target="_blank">Voir le code source →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projet 4: IoT -->
    <section id="projet-iot" class="project-detail-section<?= !is_visible('projet-iot', $projets_actifs) ? ' hidden' : '' ?>">
        <div class="container">
            <div class="project-detail-card">
                <div class="project-detail-header">
                    <h2>Projet IoT</h2>
                    <div class="project-badges">
                        <span class="badge badge-stage">Stage</span>
                        <span class="badge badge-python">Python</span>
                    </div>
                </div>
                <?= competence_tags('projet-iot', $projet_competences) ?>
                <div class="project-content">
                    <div class="project-overview">
                        <h3>Description du projet</h3>
                        <p>Projet réalisé en stage intégrant des capteurs IoT pour la collecte et l'analyse
                        de données en temps réel avec visualisation 3D.</p>
                    </div>
                    <div class="project-features">
                        <h3>Fonctionnalités principales</h3>
                        <ul class="features-list">
                            <li>Collecte de données capteurs en temps réel</li>
                            <li>Protocole MQTT pour la communication</li>
                            <li>Visualisation 3D avec Three.js</li>
                            <li>API REST pour l'accès aux données</li>
                            <li>Stockage PostgreSQL</li>
                        </ul>
                    </div>
                    <div class="project-tech">
                        <h3>Technologies utilisées</h3>
                        <div class="tech-grid">
                            <div class="tech-item"><strong>Langage :</strong> Python</div>
                            <div class="tech-item"><strong>Protocol :</strong> MQTT</div>
                            <div class="tech-item"><strong>3D :</strong> Three.js</div>
                            <div class="tech-item"><strong>API :</strong> Node.js / REST</div>
                            <div class="tech-item"><strong>Base de données :</strong> PostgreSQL</div>
                        </div>
                    </div>
                    <div class="project-links">
                        <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/IoT" class="btn btn-primary" target="_blank">Voir le code source →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projet 5: Voyage -->
    <section id="projet-voyage" class="project-detail-section<?= !is_visible('projet-voyage', $projets_actifs) ? ' hidden' : '' ?>">
        <div class="container">
            <div class="project-detail-card">
                <div class="project-detail-header">
                    <h2>Projet Voyage</h2>
                    <div class="project-badges">
                        <span class="badge badge-web">Web</span>
                        <span class="badge badge-php">PHP</span>
                    </div>
                </div>
                <?= competence_tags('projet-voyage', $projet_competences) ?>
                <div class="project-content">
                    <div class="project-overview">
                        <h3>Description du projet</h3>
                        <p>Application web de gestion de voyages avec catalogue de destinations, réservations
                        et suivi client.</p>
                    </div>
                    <div class="project-tech">
                        <h3>Technologies utilisées</h3>
                        <div class="tech-grid">
                            <div class="tech-item"><strong>Frontend :</strong> HTML / CSS / JS</div>
                            <div class="tech-item"><strong>Backend :</strong> PHP</div>
                            <div class="tech-item"><strong>Base de données :</strong> MySQL / PHPMyAdmin</div>
                        </div>
                    </div>
                    <div class="project-links">
                        <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/Projet_Voyage" class="btn btn-primary" target="_blank">Voir le projet →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projet 6: Symfony -->
    <section id="projet-symfony" class="project-detail-section<?= !is_visible('projet-symfony', $projets_actifs) ? ' hidden' : '' ?>">
        <div class="container">
            <div class="project-detail-card">
                <div class="project-detail-header">
                    <h2>Projet Symfony — St-Gentlemen</h2>
                    <div class="project-badges">
                        <span class="badge badge-web">Web</span>
                        <span class="badge badge-symfony">Symfony</span>
                    </div>
                </div>
                <?= competence_tags('projet-symfony', $projet_competences) ?>
                <div class="project-content">
                    <div class="project-overview">
                        <h3>Description du projet</h3>
                        <p>Application web de borne de commande développée avec le framework Symfony,
                        containerisée avec Docker et connectée à une base PostgreSQL.</p>
                    </div>
                    <div class="project-tech">
                        <h3>Technologies utilisées</h3>
                        <div class="tech-grid">
                            <div class="tech-item"><strong>Framework :</strong> Symfony</div>
                            <div class="tech-item"><strong>Langage :</strong> PHP</div>
                            <div class="tech-item"><strong>Conteneur :</strong> Docker</div>
                            <div class="tech-item"><strong>Base de données :</strong> PostgreSQL / PHPMyAdmin</div>
                        </div>
                    </div>
                    <div class="project-links">
                        <a href="https://github.com/Xen0-Prime/st-gentlemen.git" class="btn btn-primary" target="_blank">Voir le projet →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    // Message si aucun projet visible
    $nb_visibles = 0;
    if ($projets_actifs !== null) {
        foreach (['gestion-stock','gestion-absences','vwati-nef','projet-iot','projet-voyage','projet-symfony'] as $pid) {
            if (in_array($pid, $projets_actifs)) $nb_visibles++;
        }
    } else {
        $nb_visibles = 6;
    }
    if ($nb_visibles === 0): ?>
    <section class="section">
        <div class="container" style="text-align:center; color:var(--text-light); padding:3rem 0;">
            <p>Aucun projet associé à la compétence <strong><?= htmlspecialchars($filtre) ?></strong>.</p>
            <a href="projets.php" class="btn btn-secondary mt-3">Voir tous les projets</a>
        </div>
    </section>
    <?php endif; ?>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Portfolio BTS SIO SLAM · Killian Narasson Mohamedaly</p>
        </div>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>
