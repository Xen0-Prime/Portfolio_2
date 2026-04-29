<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Stages - Portfolio BTS SIO</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/stages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">Portfolio</div>
            <ul class="nav-menu" id="navMenu">
                <li><a href="../pages/index.php">Accueil</a></li>
                <li><a href="../pages/projets.php">Projets</a></li>
                <li><a href="stages.php" class="active">Stages</a></li>
                <li><a href="../pages/veille.php">Veille</a></li>
                <li><a href="../pages/certifications.php">Certifications</a></li>
                <li><a href="../pages/contact.php">Contact</a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- ─── Header masthead ─── -->
    <header class="stages-header">
        <div class="container">
            <div class="stages-masthead">
                <h1 class="stages-title">Mes Stages</h1>
                <div class="stages-meta">
                    <span class="meta-tag">BTS SIO SLAM</span>
                    2 entreprises · 12 semaines · 2025–2026
                </div>
            </div>
        </div>
    </header>

    <!-- ─── Timeline section ─── -->
    <section class="stages-section">
        <div class="container">
            <div class="stages-timeline">

                <!-- ═══ STAGE 1 — Fast Computer Company ═══ -->
                <div class="timeline-entry">

                    <div class="timeline-year-col">
                        <span class="timeline-year-label">Stage</span>
                        <span class="timeline-year-num y1">S1</span>
                    </div>

                    <div class="timeline-dot-col">
                        <div class="timeline-dot d1"></div>
                    </div>

                    <div class="timeline-stage-wrapper">
                        <div class="stage-card-new s1">

                            <!-- Card header -->
                            <div class="stage-card-header">
                                <div>
                                    <h2 class="stage-company-name">Fast Computer Company</h2>
                                    <div class="stage-period">
                                        <i class="fas fa-calendar-alt"></i>
                                        12 Mai 2025 — 21 Juin 2025
                                    </div>
                                </div>
                                <div class="stage-meta-right">
                                    <span class="stage-year-badge s1">1ère année</span>
                                    <span class="stage-duration-text">6 semaines · PME</span>
                                </div>
                            </div>

                            <!-- Card body -->
                            <div class="stage-card-body">

                                <!-- Contexte -->
                                <div>
                                    <p class="stage-context">
                                        Fast Computer Company est une PME spécialisée dans la vente et la réparation d'ordinateurs et périphériques informatiques.
                                        J'ai intégré l'équipe de développement web, chargée de la création et de la maintenance du site vitrine ainsi que de la production de contenus numériques.
                                    </p>
                                </div>

                                <!-- Missions + Compétences (2 colonnes) -->
                                <div class="stage-two-col">

                                    <!-- Missions -->
                                    <div>
                                        <p class="stage-block-title"><i class="fas fa-briefcase"></i>&nbsp;Missions confiées</p>
                                        <ul class="stage-missions-list">
                                            <li>
                                                <strong>Mission 1 — Site vitrine</strong>
                                                Conception, développement front-end et back-end, et mise en ligne du site de l'entreprise.
                                            </li>
                                            <li>
                                                <strong>Mission 2 — Tutoriel vidéo</strong>
                                                Création d'une vidéo tutorielle pour le site Magik 33 expliquant ses fonctionnalités.
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Compétences -->
                                    <div>
                                        <p class="stage-block-title"><i class="fas fa-book"></i>&nbsp;Compétences développées</p>

                                        <div class="stage-comp-item">
                                            <h4>B1 — Support &amp; mise à disposition</h4>
                                            <ul>
                                                <li>Recueil et analyse des besoins client</li>
                                                <li>Rédaction de la documentation technique</li>
                                            </ul>
                                        </div>

                                        <div class="stage-comp-item">
                                            <h4>B3 — Développement d'applications</h4>
                                            <ul>
                                                <li>Site web complet (HTML, CSS, JS, PHP)</li>
                                                <li>Conception et gestion d'une BDD MySQL</li>
                                                <li>Déploiement sur hébergeur</li>
                                            </ul>
                                        </div>

                                        <div class="stage-comp-item">
                                            <h4>B5 — Infrastructure</h4>
                                            <ul>
                                                <li>Sécurisation contre les injections SQL</li>
                                                <li>Gestion des accès BDD avec comptes restreints</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div><!-- /stage-two-col -->

                            </div><!-- /stage-card-body -->

                            <!-- Tech bar -->
                            <div class="stage-tech-bar">
                                <span class="stage-tech-label">Stack</span>
                                <span class="tech-tag">HTML</span>
                                <span class="tech-tag">CSS</span>
                                <span class="tech-tag">JavaScript</span>
                                <span class="tech-tag">PHP</span>
                                <span class="tech-tag">MySQL</span>
                            </div>

                            <!-- Apports + Défis -->
                            <div class="stage-bottom-grid">

                                <div class="stage-apport">
                                    <p class="stage-block-title"><i class="fas fa-lightbulb"></i>&nbsp;Apports</p>
                                    <p>
                                        Travailler en autonomie sur un projet concret en respectant les délais.
                                        Renforcement des compétences techniques full-stack et résolution de problèmes en conditions réelles.
                                    </p>
                                </div>

                                <div class="stage-defis">
                                    <p class="stage-block-title"><i class="fas fa-search"></i>&nbsp;Défis rencontrés</p>
                                    <div class="defi-box">
                                        <strong>Défi 1 — Base de données</strong>
                                        <p>Difficultés avec les relations MySQL entre tables — surmontées grâce à des tutoriels et l'aide de l'IA.</p>
                                    </div>
                                    <div class="defi-box">
                                        <strong>Défi 2 — Mise en ligne</strong>
                                        <p>Configuration de l'hébergeur — résolu en suivant la documentation pas à pas.</p>
                                    </div>
                                </div>

                            </div><!-- /stage-bottom-grid -->

                            <!-- Documents -->
                            <div class="stage-docs">
                                <p class="stage-docs-label"><i class="fas fa-file-alt"></i>&nbsp;Documents</p>
                                <div class="docs-row">
                                    <a href="docs/Attestation_Stage1.pdf" class="doc-link" target="_blank" rel="noopener noreferrer">
                                        <i class="fas fa-file-pdf"></i> Attestation de stage
                                    </a>
                                </div>
                            </div>

                        </div><!-- /stage-card-new.s1 -->
                    </div><!-- /timeline-stage-wrapper -->
                </div><!-- /timeline-entry -->


                <!-- ─── Connector between stages ─── -->
                <div class="timeline-connector">
                    <i class="fas fa-arrow-down"></i>
                    Montée en compétences — PME locale → Grande entreprise régionale · Technologies web → IoT &amp; temps réel
                </div>


                <!-- ═══ STAGE 2 — Orange Caraïbes ═══ -->
                <div class="timeline-entry">

                    <div class="timeline-year-col">
                        <span class="timeline-year-label">Stage</span>
                        <span class="timeline-year-num y2">S2</span>
                    </div>

                    <div class="timeline-dot-col">
                        <div class="timeline-dot d2"></div>
                    </div>

                    <div class="timeline-stage-wrapper">
                        <div class="stage-card-new s2">

                            <!-- Card header -->
                            <div class="stage-card-header">
                                <div>
                                    <h2 class="stage-company-name">Orange Caraïbes</h2>
                                    <div class="stage-period">
                                        <i class="fas fa-calendar-alt"></i>
                                        8 Décembre 2025 — 16 Janvier 2026
                                    </div>
                                </div>
                                <div class="stage-meta-right">
                                    <span class="stage-year-badge s2">2ème année</span>
                                    <span class="stage-duration-text">6 semaines · Grand groupe</span>
                                </div>
                            </div>

                            <!-- Card body -->
                            <div class="stage-card-body">

                                <!-- Contexte -->
                                <div>
                                    <p class="stage-context">
                                        Orange Caraïbes est un opérateur de télécommunications présent dans plusieurs îles des Caraïbes, offrant téléphonie mobile, internet et télévision.
                                        J'ai intégré l'équipe technique pour développer une interface de supervision d'objets connectés (IoT) en temps réel.
                                    </p>
                                </div>

                                <!-- Missions + Compétences (2 colonnes) -->
                                <div class="stage-two-col">

                                    <!-- Missions -->
                                    <div>
                                        <p class="stage-block-title"><i class="fas fa-briefcase"></i>&nbsp;Missions confiées</p>
                                        <ul class="stage-missions-list">
                                            <li>
                                                <strong>Mission 1 — Interface IoT</strong>
                                                Développement d'une interface web pour visualiser les données d'un objet connecté (humidité, pression, température, gyroscope) via MQTT.
                                            </li>
                                            <li>
                                                <strong>Mission 2 — Visualisation 3D</strong>
                                                Amélioration de l'interface avec une représentation 3D de l'objet (Three.js) et ajout de graphiques dynamiques.
                                            </li>
                                            <li>
                                                <strong>Mission 3 — Base de données</strong>
                                                Intégration de Supabase pour le stockage persistant des données collectées et une analyse approfondie.
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Compétences -->
                                    <div>
                                        <p class="stage-block-title"><i class="fas fa-book"></i>&nbsp;Compétences développées</p>

                                        <div class="stage-comp-item">
                                            <h4>B4 — Travail en équipe</h4>
                                            <ul>
                                                <li>Planification via diagramme de Gantt</li>
                                                <li>Intégration dans une équipe structurée</li>
                                            </ul>
                                        </div>

                                        <div class="stage-comp-item">
                                            <h4>B3 — Développement d'applications</h4>
                                            <ul>
                                                <li>Communication IoT temps réel via MQTT</li>
                                                <li>Visualisation 3D interactive avec Three.js</li>
                                                <li>Intégration Supabase (BDD cloud)</li>
                                            </ul>
                                        </div>

                                        <div class="stage-comp-item">
                                            <h4>B5 — Infrastructure</h4>
                                            <ul>
                                                <li>Sécurisation du broker MQTT (auth + ACL)</li>
                                                <li>Règles de sécurité Supabase (RLS)</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div><!-- /stage-two-col -->

                            </div><!-- /stage-card-body -->

                            <!-- Tech bar -->
                            <div class="stage-tech-bar">
                                <span class="stage-tech-label">Stack</span>
                                <span class="tech-tag">HTML</span>
                                <span class="tech-tag">CSS</span>
                                <span class="tech-tag">JavaScript</span>
                                <span class="tech-tag">MQTT</span>
                                <span class="tech-tag">Three.js</span>
                                <span class="tech-tag">Supabase</span>
                                <span class="tech-tag">Arduino</span>
                                <span class="tech-tag">Node-RED</span>
                            </div>

                            <!-- Apports + Défis -->
                            <div class="stage-bottom-grid">

                                <div class="stage-apport">
                                    <p class="stage-block-title"><i class="fas fa-lightbulb"></i>&nbsp;Apports</p>
                                    <p>
                                        Découverte de technologies avancées (IoT, MQTT, Three.js, Node-RED).
                                        Développement de compétences humaines dans un grand groupe structuré.
                                        Confirmation de mon orientation vers le développement web et l'IoT.
                                    </p>
                                </div>

                                <div class="stage-defis">
                                    <p class="stage-block-title"><i class="fas fa-search"></i>&nbsp;Défis rencontrés</p>
                                    <div class="defi-box">
                                        <strong>Défi 1 — Communication MQTT</strong>
                                        <p>Mise en place du protocole entre l'objet et l'interface — résolu avec docs, tutoriels et aide des collègues.</p>
                                    </div>
                                    <div class="defi-box">
                                        <strong>Défi 2 — Broker instable</strong>
                                        <p>Instabilité du broker public — résolu en migrant vers un broker interne correctement configuré.</p>
                                    </div>
                                </div>

                            </div><!-- /stage-bottom-grid -->

                            <!-- Documents -->
                            <div class="stage-docs">
                                <p class="stage-docs-label"><i class="fas fa-file-alt"></i>&nbsp;Documents</p>
                                <div class="docs-row">
                                    <a href="docs/Attestation_Stage2.pdf" class="doc-link" target="_blank" rel="noopener noreferrer">
                                        <i class="fas fa-file-pdf"></i> Attestation de stage
                                    </a>
                                </div>
                            </div>

                        </div><!-- /stage-card-new.s2 -->
                    </div><!-- /timeline-stage-wrapper -->
                </div><!-- /timeline-entry -->

            </div><!-- /stages-timeline -->
        </div><!-- /container -->
    </section>

    <!-- ─── Evolution bar ─── -->
    <section class="evolution-section">
        <div class="container">

            <div class="evolution-bar">
                <div class="evolution-bar-header">
                    Évolution entre les deux stages
                </div>
                <div class="evolution-grid">

                    <div class="evo-item">
                        <span class="evo-label">Structure</span>
                        <div class="evo-row">
                            <div class="evo-from">PME locale</div>
                            <span class="evo-arrow">→</span>
                            <div class="evo-to">Grand groupe</div>
                        </div>
                    </div>

                    <div class="evo-item">
                        <span class="evo-label">Technologie</span>
                        <div class="evo-row">
                            <div class="evo-from">Web classique</div>
                            <span class="evo-arrow">→</span>
                            <div class="evo-to">IoT + 3D temps réel</div>
                        </div>
                    </div>

                    <div class="evo-item">
                        <span class="evo-label">Complexité</span>
                        <div class="evo-row">
                            <div class="evo-from">Site vitrine</div>
                            <span class="evo-arrow">→</span>
                            <div class="evo-to">Dashboard temps réel</div>
                        </div>
                    </div>

                    <div class="evo-item">
                        <span class="evo-label">Autonomie</span>
                        <div class="evo-row">
                            <div class="evo-from">Encadrée</div>
                            <span class="evo-arrow">→</span>
                            <div class="evo-to">Confirmée</div>
                        </div>
                    </div>

                </div><!-- /evolution-grid -->
            </div><!-- /evolution-bar -->

        </div>
    </section>

    <!-- ─── Bilan section ─── -->
    <section class="stages-section" style="padding-top: 0;">
        <div class="container">

            <div class="bilan-section">
                <h2 class="section-title">Bilan de mes expériences</h2>
                <div class="bilan-content">

                    <div class="bilan-card">
                        <h3>Objectifs atteints</h3>
                        <ul>
                            <li>Travailler en autonomie sur des projets concrets</li>
                            <li>Développer des compétences techniques en développement web</li>
                            <li>Apprendre des technologies utilisées en entreprise</li>
                            <li>Comprendre le fonctionnement d'un grand groupe télécom</li>
                        </ul>
                    </div>

                    <div class="bilan-card">
                        <h3><i class="fas fa-rocket"></i> Projet professionnel</h3>
                        <p>
                            Ces deux stages m'ont permis de confirmer mon orientation vers le développement web et l'IoT.
                            Travailler sur des projets concrets dans des contextes très différents m'a donné une vision
                            complète du métier et des compétences humaines essentielles pour évoluer en entreprise.
                        </p>
                    </div>

                    <div class="bilan-card">
                        <h3><i class="fas fa-dumbbell"></i> Points forts développés</h3>
                        <div class="skills-badges">
                            <span class="skill-badge">Autonomie</span>
                            <span class="skill-badge">Adaptabilité</span>
                            <span class="skill-badge">Communication</span>
                            <span class="skill-badge">Rigueur</span>
                            <span class="skill-badge">Organisation</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Portfolio BTS SIO SLAM - Tous droits réservés</p>
        </div>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>
