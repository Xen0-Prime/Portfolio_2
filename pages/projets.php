<?php
// ─── Mapping compétences → projets ───────────────────
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

$competences_short = [
    'B1' => 'Support',
    'B2' => 'Incidents',
    'B3' => 'Développement',
    'B4' => 'Équipe',
    'B5' => 'Infrastructure',
    'B6' => 'Organisation',
];

// Compétences de chaque projet
$projet_competences = [
    'gestion-stock'    => ['B2', 'B3', 'B5'],
    'gestion-absences' => ['B3', 'B4', 'B5'],
    'vwati-nef'        => ['B1', 'B3', 'B4'],
    'projet-iot'       => ['B2', 'B3', 'B5'],
    'projet-voyage'    => ['B1', 'B3', 'B6'],
    'projet-symfony'   => ['B3', 'B4', 'B6'],
];

$filtre = isset($_GET['competence']) ? strtoupper(trim($_GET['competence'])) : null;
$projets_actifs = ($filtre && isset($competences_map[$filtre])) ? $competences_map[$filtre] : null;

function is_visible(string $id, ?array $actifs): bool {
    return $actifs === null || in_array($id, $actifs);
}

function comp_tags(string $id, array $map): string {
    global $competences_labels;
    $out = '<div class="card-comps">';
    foreach ($map[$id] ?? [] as $code) {
        $lbl = $competences_labels[$code] ?? $code;
        $out .= '<span class="ctag ctag-' . strtolower($code) . '" title="' . htmlspecialchars($lbl) . '">' . $code . '</span>';
    }
    return $out . '</div>';
}

function data_comps(string $id, array $map): string {
    return implode(',', $map[$id] ?? []);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets · Portfolio BTS SIO SLAM</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/projets.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">Portfolio</div>
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php#about">À propos</a></li>
                <li><a href="index.php#competences">Compétences</a></li>
                <li><a href="projets.php" class="active">Projets</a></li>
                <li><a href="veille.php">Veille</a></li>
                <li><a href="certifications.php">Certifications</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="../stages/stages.php">Stages</a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- ═══════════ Header / Masthead ═══════════ -->
    <header class="projects-header">
        <div class="container">
            <div class="projects-masthead">
                <h1 class="projects-title">Mes Projets</h1>
                <div class="projects-meta">
                    <span class="meta-tag">BTS SIO SLAM</span>
                    6 projets · Portfolio de développements
                </div>
            </div>

            <!-- Filter pills -->
            <div class="filter-bar" id="filterBar">
                <span class="filter-bar-label"><i class="fas fa-filter"></i> Filtrer</span>

                <a href="projets.php"
                   class="filter-pill <?= !$filtre ? 'active' : '' ?>"
                   data-filter="all">
                    Tous
                </a>

                <?php foreach ($competences_labels as $code => $label): ?>
                <a href="projets.php?competence=<?= $code ?>"
                   class="filter-pill pill-<?= strtolower($code) ?> <?= ($filtre === $code) ? 'active' : '' ?>"
                   data-filter="<?= $code ?>">
                    <strong><?= $code ?></strong>
                    <span class="pill-sub">— <?= htmlspecialchars($competences_short[$code]) ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </header>

    <!-- ═══════════ Projects Grid ═══════════ -->
    <section class="projects-section">
        <div class="container">

            <?php if ($filtre && isset($competences_labels[$filtre])): ?>
            <div class="active-filter-banner">
                <i class="fas fa-tag" style="color:var(--secondary-color)"></i>
                <span>Filtre actif :</span>
                <span class="filter-name"><?= $filtre ?> — <?= htmlspecialchars($competences_labels[$filtre]) ?></span>
                <a href="projets.php" class="filter-reset-link">✕ Tous les projets</a>
            </div>
            <?php endif; ?>

            <div class="projects-grid" id="projectsGrid">

                <!-- ── Gestion de Stock ── -->
                <div class="project-card card-java <?= !is_visible('gestion-stock', $projets_actifs) ? 'hidden' : '' ?>"
                     data-comps="<?= data_comps('gestion-stock', $projet_competences) ?>">

                    <div class="card-header">
                        <div class="card-header-top">
                            <h3 class="card-title">Gestion de Stock</h3>
                            <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/Gestion%20de%20stock"
                               target="_blank" rel="noopener noreferrer" class="card-github" title="Voir sur GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                        <div class="card-badges">
                            <span class="badge badge-java">Java</span>
                            <span class="badge badge-database">Base de données</span>
                        </div>
                    </div>

                    <?= comp_tags('gestion-stock', $projet_competences) ?>

                    <div class="card-body">
                        <p class="card-desc">
                            Application desktop Java Swing connectée à MySQL. Gestion complète des
                            produits, stocks, fournisseurs et génération de rapports PDF.
                        </p>

                        <div>
                            <div class="card-section-label">Fonctionnalités</div>
                            <ul class="card-features">
                                <li>CRUD produits &amp; gestion des stocks en temps réel</li>
                                <li>Alertes automatiques pour les ruptures de stock</li>
                                <li>Gestion des fournisseurs</li>
                                <li>Génération de rapports PDF</li>
                                <li>Interface graphique intuitive (Swing)</li>
                            </ul>
                        </div>

                        <div class="card-tech">
                            <span class="tech-tag">Java 11</span>
                            <span class="tech-tag">Java Swing</span>
                            <span class="tech-tag">MySQL</span>
                            <span class="tech-tag">JDBC</span>
                            <span class="tech-tag">NetBeans</span>
                            <span class="tech-tag">PHPMyAdmin</span>
                        </div>
                    </div>
                </div>

                <!-- ── Gestion d'Absences ── -->
                <div class="project-card card-mobile <?= !is_visible('gestion-absences', $projets_actifs) ? 'hidden' : '' ?>"
                     data-comps="<?= data_comps('gestion-absences', $projet_competences) ?>">

                    <div class="card-header">
                        <div class="card-header-top">
                            <h3 class="card-title">Gestion d'Absences</h3>
                            <a href="https://github.com/Laeticia18/Appli-mobile-react.git"
                               target="_blank" rel="noopener noreferrer" class="card-github" title="Voir sur GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                        <div class="card-badges">
                            <span class="badge badge-mobile">Mobile</span>
                            <span class="badge badge-api">API REST</span>
                        </div>
                    </div>

                    <?= comp_tags('gestion-absences', $projet_competences) ?>

                    <div class="card-body">
                        <p class="card-desc">
                            Application mobile React Native permettant de gérer les demandes d'absence
                            avec un système de validation hiérarchique multi-niveaux.
                        </p>

                        <div>
                            <div class="card-section-label">Fonctionnalités</div>
                            <ul class="card-features">
                                <li>Authentification sécurisée (JWT)</li>
                                <li>Soumission &amp; suivi des demandes d'absence</li>
                                <li>Workflow de validation multi-niveaux</li>
                                <li>Notifications push temps réel</li>
                                <li>Interface responsive mobile-first</li>
                            </ul>
                        </div>

                        <div class="card-tech">
                            <span class="tech-tag">React Native</span>
                            <span class="tech-tag">JavaScript</span>
                            <span class="tech-tag">Node.js</span>
                            <span class="tech-tag">REST API</span>
                            <span class="tech-tag">PostgreSQL</span>
                        </div>
                    </div>
                </div>

                <!-- ── Vwati Nef ── -->
                <div class="project-card card-php <?= !is_visible('vwati-nef', $projets_actifs) ? 'hidden' : '' ?>"
                     data-comps="<?= data_comps('vwati-nef', $projet_competences) ?>">

                    <div class="card-header">
                        <div class="card-header-top">
                            <h3 class="card-title">Vwati Nef</h3>
                            <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/Vwati%20nef"
                               target="_blank" rel="noopener noreferrer" class="card-github" title="Voir sur GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                        <div class="card-badges">
                            <span class="badge badge-web">Web</span>
                            <span class="badge badge-php">PHP</span>
                        </div>
                    </div>

                    <?= comp_tags('vwati-nef', $projet_competences) ?>

                    <div class="card-body">
                        <p class="card-desc">
                            Site web de concessionnaire automobile avec catalogue de véhicules,
                            système de filtres avancés et interface d'administration complète.
                        </p>

                        <div>
                            <div class="card-section-label">Fonctionnalités</div>
                            <ul class="card-features">
                                <li>Catalogue de véhicules avec filtres multi-critères</li>
                                <li>Fiche détail par véhicule</li>
                                <li>Interface d'administration (CRUD)</li>
                                <li>Formulaire de contact intégré</li>
                                <li>Design responsive</li>
                            </ul>
                        </div>

                        <div class="card-tech">
                            <span class="tech-tag">PHP</span>
                            <span class="tech-tag">HTML / CSS</span>
                            <span class="tech-tag">JavaScript</span>
                            <span class="tech-tag">MySQL</span>
                        </div>
                    </div>
                </div>

                <!-- ── Projet IoT ── -->
                <div class="project-card card-python <?= !is_visible('projet-iot', $projets_actifs) ? 'hidden' : '' ?>"
                     data-comps="<?= data_comps('projet-iot', $projet_competences) ?>">

                    <div class="card-header">
                        <div class="card-header-top">
                            <h3 class="card-title">Projet IoT</h3>
                            <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/IoT"
                               target="_blank" rel="noopener noreferrer" class="card-github" title="Voir sur GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                        <div class="card-badges">
                            <span class="badge badge-stage">Stage</span>
                            <span class="badge badge-python">Python</span>
                        </div>
                    </div>

                    <?= comp_tags('projet-iot', $projet_competences) ?>

                    <div class="card-body">
                        <p class="card-desc">
                            Projet de stage intégrant des capteurs IoT pour la collecte et l'analyse
                            de données en temps réel avec visualisation 3D interactive.
                        </p>

                        <div>
                            <div class="card-section-label">Fonctionnalités</div>
                            <ul class="card-features">
                                <li>Collecte de données capteurs en temps réel</li>
                                <li>Communication via protocole MQTT</li>
                                <li>Visualisation 3D interactive avec Three.js</li>
                                <li>API REST pour l'accès aux données</li>
                                <li>Stockage et historique PostgreSQL</li>
                            </ul>
                        </div>

                        <div class="card-tech">
                            <span class="tech-tag">Python</span>
                            <span class="tech-tag">MQTT</span>
                            <span class="tech-tag">Three.js</span>
                            <span class="tech-tag">Node.js</span>
                            <span class="tech-tag">REST API</span>
                            <span class="tech-tag">PostgreSQL</span>
                        </div>
                    </div>
                </div>

                <!-- ── Projet Voyage ── -->
                <div class="project-card card-web <?= !is_visible('projet-voyage', $projets_actifs) ? 'hidden' : '' ?>"
                     data-comps="<?= data_comps('projet-voyage', $projet_competences) ?>">

                    <div class="card-header">
                        <div class="card-header-top">
                            <h3 class="card-title">Projet Voyage</h3>
                            <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/Projet_Voyage"
                               target="_blank" rel="noopener noreferrer" class="card-github" title="Voir sur GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                        <div class="card-badges">
                            <span class="badge badge-web">Web</span>
                            <span class="badge badge-php">PHP</span>
                        </div>
                    </div>

                    <?= comp_tags('projet-voyage', $projet_competences) ?>

                    <div class="card-body">
                        <p class="card-desc">
                            Application web de gestion de voyages avec catalogue de destinations,
                            système de réservations en ligne et suivi client.
                        </p>

                        <div>
                            <div class="card-section-label">Fonctionnalités</div>
                            <ul class="card-features">
                                <li>Catalogue de destinations avec filtres</li>
                                <li>Système de réservations en ligne</li>
                                <li>Espace client &amp; suivi des réservations</li>
                                <li>Interface d'administration</li>
                            </ul>
                        </div>

                        <div class="card-tech">
                            <span class="tech-tag">PHP</span>
                            <span class="tech-tag">HTML / CSS / JS</span>
                            <span class="tech-tag">MySQL</span>
                            <span class="tech-tag">PHPMyAdmin</span>
                        </div>
                    </div>
                </div>

                <!-- ── Symfony — St-Gentlemen ── -->
                <div class="project-card card-symfony <?= !is_visible('projet-symfony', $projets_actifs) ? 'hidden' : '' ?>"
                     data-comps="<?= data_comps('projet-symfony', $projet_competences) ?>">

                    <div class="card-header">
                        <div class="card-header-top">
                            <h3 class="card-title">Symfony — St-Gentlemen</h3>
                            <a href="https://github.com/Xen0-Prime/st-gentlemen.git"
                               target="_blank" rel="noopener noreferrer" class="card-github" title="Voir sur GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                        <div class="card-badges">
                            <span class="badge badge-symfony">Symfony</span>
                            <span class="badge badge-docker">Docker</span>
                        </div>
                    </div>

                    <?= comp_tags('projet-symfony', $projet_competences) ?>

                    <div class="card-body">
                        <p class="card-desc">
                            Application web de borne de commande développée avec Symfony,
                            containerisée avec Docker et connectée à une base PostgreSQL.
                        </p>

                        <div>
                            <div class="card-section-label">Fonctionnalités</div>
                            <ul class="card-features">
                                <li>Interface borne de commande tactile</li>
                                <li>Gestion du catalogue &amp; des commandes</li>
                                <li>Authentification &amp; rôles utilisateurs</li>
                                <li>Containerisation complète Docker</li>
                            </ul>
                        </div>

                        <div class="card-tech">
                            <span class="tech-tag">Symfony</span>
                            <span class="tech-tag">PHP</span>
                            <span class="tech-tag">Docker</span>
                            <span class="tech-tag">PostgreSQL</span>
                            <span class="tech-tag">Twig</span>
                        </div>
                    </div>
                </div>

            </div><!-- /.projects-grid -->

            <!-- Message aucun résultat -->
            <div class="no-results" id="noResults">
                <p>Aucun projet ne correspond à ce filtre.</p>
                <a href="projets.php">← Voir tous les projets</a>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Portfolio BTS SIO SLAM · Killian Narasson Mohamedaly</p>
        </div>
    </footer>

    <script src="../js/script.js"></script>
    <script>
    (function () {
        const pills   = document.querySelectorAll('#filterBar .filter-pill');
        const cards   = document.querySelectorAll('#projectsGrid .project-card');
        const noRes   = document.getElementById('noResults');

        function filterCards(code) {
            let visible = 0;
            cards.forEach(function (card) {
                const comps = card.dataset.comps ? card.dataset.comps.split(',') : [];
                const show  = (code === 'all') || comps.includes(code);
                card.classList.toggle('hidden', !show);
                if (show) visible++;
            });
            noRes.style.display = visible === 0 ? 'block' : 'none';
        }

        function setActive(code) {
            pills.forEach(function (p) {
                const isActive = (p.dataset.filter === code) ||
                                 (code === 'all' && p.dataset.filter === 'all');
                p.classList.toggle('active', isActive);
            });
        }

        pills.forEach(function (pill) {
            pill.addEventListener('click', function (e) {
                e.preventDefault();
                const code = pill.dataset.filter || 'all';
                setActive(code);
                filterCards(code);
                // Update URL without reload
                const url = code === 'all'
                    ? window.location.pathname
                    : window.location.pathname + '?competence=' + code;
                history.replaceState(null, '', url);
            });
        });

        // Initialise from PHP filter if set
        const initFilter = "<?= $filtre ?? 'all' ?>";
        if (initFilter && initFilter !== 'all') {
            setActive(initFilter);
            filterCards(initFilter);
        }
    })();
    </script>
</body>
</html>
