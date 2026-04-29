<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veille Technologique - Portfolio BTS SIO</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/veille.css">
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
                <li><a href="projets.php">Projets</a></li>
                <li><a href="veille.php" class="active">Veille</a></li>
                <li><a href="certifications.php">Certifications</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="../stages/stages.php">Stages</a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- Masthead -->
    <header class="veille-masthead">
        <div class="container">
            <div class="masthead-inner">
                <h1 class="masthead-title">Veille Technologique</h1>
                <div class="masthead-meta">
                    <span class="edition">BTS SIO SLAM — Option SLAM</span>
                    Mis à jour : Avril 2026<br>
                    5 domaines · 15 sources
                </div>
            </div>

            <!-- Category nav -->
            <nav class="cat-nav">
                <a href="#smartphone"           class="cat-nav-item"><i class="fas fa-mobile-alt"></i> Smartphones</a>
                <a href="#composants-pc"         class="cat-nav-item"><i class="fas fa-laptop"></i> Hardware</a>
                <a href="#intelligence-artificielle" class="cat-nav-item"><i class="fas fa-robot"></i> Intelligence Artificielle</a>
                <a href="#reseaux-securite"       class="cat-nav-item"><i class="fas fa-lock"></i> Cybersécurité</a>
                <a href="#gaming"                class="cat-nav-item"><i class="fas fa-gamepad"></i> Gaming</a>
            </nav>
        </div>

        <!-- Intro -->
        <div class="container">
            <p class="intro-text">
                Dans le cadre du BTS SIO option SLAM, je maintiens une veille technologique active
                pour rester informé des dernières évolutions et tendances du secteur informatique.
            </p>
        </div>
    </header>

    <!-- ════════════════════════════════════════════════
         À LA UNE — Intelligence Artificielle
    ════════════════════════════════════════════════ -->
    <section class="featured-section">
        <div class="container">
            <div class="featured-label">À la une</div>
            <div class="featured-card">
                <div class="featured-visual">
                    <img src="../stages/docs/claude.png" alt="Claude AI" class="featured-image" style="width:1.2em;height:1.2em;object-fit:contain;">
                    <span class="featured-visual-cat">Intelligence Artificielle</span>
                </div>
                <div class="featured-body">
                    <h2>L'IA générative transforme le développement logiciel</h2>
                    <p>
                        Claude, ChatGPT et GitHub Copilot X atteignent une compréhension contextuelle
                        inédite du code, permettant une assistance quasi-humaine sur l'ensemble du cycle
                        de développement. En parallèle, des modèles open source comme Llama 3 et
                        Mistral offrent des alternatives viables aux solutions propriétaires, ouvrant
                        la voie à une IA embarquée directement dans les outils de développement.
                    </p>
                    <div class="featured-meta">
                        <span class="featured-date"><i class="fas fa-calendar-alt"></i> Février 2026</span>
                        <a class="featured-src-link" href="https://www.anthropic.com/news" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-external-link-alt"></i> Anthropic Blog
                        </a>
                        <a class="featured-src-link" href="https://openai.com/blog" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-external-link-alt"></i> OpenAI Blog
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════
         SECTION 1 — Smartphones
    ════════════════════════════════════════════════ -->
    <section id="smartphone" class="mag-section sec-mobile">
        <div class="container">

            <div class="mag-section-header">
                <h2 class="mag-section-title">
                    <i class="fas fa-mobile-alt"></i> Smartphones &amp; Mobilité
                </h2>
                <span class="mag-section-count">3 articles</span>
            </div>

            <p class="mag-section-why">
                Les smartphones évoluent constamment : 5G, IA embarquée, réalité augmentée,
                interfaces adaptatives. Cette veille m'aide à comprendre les contraintes et
                opportunités du développement mobile.
            </p>

            <div class="articles-row">
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Février 2026</span>
                    <h4>Intelligence artificielle embarquée</h4>
                    <p>Les SoC intègrent désormais des puces IA dédiées pour améliorer les performances des assistants vocaux et de la reconnaissance d'images.</p>
                </div>
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Janvier 2026</span>
                    <h4>Écrans pliables nouvelle génération</h4>
                    <p>Amélioration de la durabilité des écrans flexibles et nouvelles interfaces adaptatives permettant des usages inédits.</p>
                </div>
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Décembre 2025</span>
                    <h4>6G : premiers prototypes</h4>
                    <p>Les premières démonstrations de connectivité 6G promettent des débits révolutionnaires et une latence quasi nulle.</p>
                </div>
            </div>

            <div class="sources-bar">
                <span class="sources-bar-label"><i class="fas fa-book"></i> Sources</span>
                <a class="source-link" href="https://www.youtube.com/@Jojol" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> Jojol
                </a>
                <a class="source-link" href="https://www.youtube.com/@MonsieurGRrr" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> Monsieur GRrr
                </a>
                <a class="source-link" href="https://www.youtube.com/@BrandonLeProktor" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> Brandon le Proktor
                </a>
                <a class="source-link" href="https://www.youtube.com/@LeoTechMaker" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> Leo TechMaker
                </a>
                <a class="source-link" href="https://www.gsmarena.com" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> GSMArena
                </a>
                <a class="source-link" href="https://www.theverge.com/phones" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> The Verge
                </a>
                <a class="source-link" href="https://www.androidauthority.com" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> Android Authority
                </a>
                <a class="source-link" href="https://www.01net.com/smartphones/" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> 01net
                </a>
            </div>

        </div>
    </section>

    <!-- ════════════════════════════════════════════════
         SECTION 2 — Hardware PC
    ════════════════════════════════════════════════ -->
    <section id="composants-pc" class="mag-section sec-hw">
        <div class="container">

            <div class="mag-section-header">
                <h2 class="mag-section-title">
                    <i class="fas fa-laptop"></i> Hardware &amp; Composants PC
                </h2>
                <span class="mag-section-count">3 articles</span>
            </div>

            <p class="mag-section-why">
                L'évolution rapide des composants (processeurs, GPU, stockage) influence directement
                les performances des applications que je développe. Comprendre ces évolutions m'aide
                à optimiser mes développements pour les architectures modernes.
            </p>

            <div class="articles-row">
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Février 2026</span>
                    <h4>Processeurs ARM pour PC</h4>
                    <p>Apple M3 et Qualcomm Snapdragon X révolutionnent l'architecture portable avec une efficacité énergétique exceptionnelle.</p>
                </div>
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Janvier 2026</span>
                    <h4>SSD NVMe 6.0</h4>
                    <p>Les nouveaux standards de stockage atteignent des vitesses de 32 Go/s, révolutionnant les temps de chargement des applications.</p>
                </div>
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Décembre 2025</span>
                    <h4>Ray Tracing démocratisé</h4>
                    <p>Les cartes graphiques milieu de gamme intègrent désormais le ray tracing hardware pour un rendu photoréaliste accessible.</p>
                </div>
            </div>

            <div class="sources-bar">
                <span class="sources-bar-label"><i class="fas fa-book"></i> Sources</span>
                <a class="source-link" href="https://www.youtube.com/@LeoTechMaker" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> Leo TechMaker
                </a>
                <a class="source-link" href="https://www.youtube.com/@FrenchHardware" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> French Hardware
                </a>
                <a class="source-link" href="https://www.youtube.com/@KappaStudio" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> KAPPA Studio
                </a>
                <a class="source-link" href="https://www.youtube.com/@LinusTechTips" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> Linus Tech Tips
                </a>
                <a class="source-link" href="https://www.tomshardware.com" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> Tom's Hardware
                </a>
                <a class="source-link" href="https://www.anandtech.com" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> AnandTech
                </a>
                <a class="source-link" href="https://www.01net.com/high-tech/" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> 01net
                </a>
            </div>

        </div>
    </section>

    <!-- ════════════════════════════════════════════════
         SECTION 3 — Intelligence Artificielle
    ════════════════════════════════════════════════ -->
    <section id="intelligence-artificielle" class="mag-section sec-ai">
        <div class="container">

            <div class="mag-section-header">
                <h2 class="mag-section-title">
                    <i class="fas fa-robot"></i> Intelligence Artificielle
                </h2>
                <span class="mag-section-count">3 articles</span>
            </div>

            <p class="mag-section-why">
                L'IA transforme le développement logiciel : assistants de code, génération automatique,
                analyse de données intelligente. Cette veille m'aide à intégrer ces outils dans mes
                projets et à anticiper les évolutions du métier de développeur.
            </p>

            <div class="articles-row">
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Février 2026</span>
                    <h4>IA générative pour le code</h4>
                    <p>Claude, ChatGPT et GitHub Copilot X révolutionnent l'assistance au développement avec une meilleure compréhension contextuelle.</p>
                </div>
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Janvier 2026</span>
                    <h4>Modèles open source performants</h4>
                    <p>Llama 3 et Mistral 8x22B offrent des alternatives viables aux modèles propriétaires avec des performances comparables.</p>
                </div>
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Décembre 2025</span>
                    <h4>IA multimodale</h4>
                    <p>Les nouveaux modèles traitent simultanément texte, image, audio et vidéo, ouvrant de nouvelles possibilités d'interaction.</p>
                </div>
            </div>

            <div class="sources-bar">
                <span class="sources-bar-label"><i class="fas fa-book"></i> Sources</span>
                <a class="source-link" href="https://blog.google/technology/ai/" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> Google AI Blog
                </a>
                <a class="source-link" href="https://www.anthropic.com/news" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> Anthropic
                </a>
                <a class="source-link" href="https://openai.com/blog" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> OpenAI Blog
                </a>
                <a class="source-link" href="https://huggingface.co/blog" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> Hugging Face
                </a>
                <a class="source-link" href="https://paperswithcode.com" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> Papers With Code
                </a>
                <a class="source-link" href="https://www.technologyreview.com/topic/artificial-intelligence/" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> MIT Tech Review
                </a>
                <a class="source-link" href="https://www.youtube.com/@underscoreAI" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> Underscore_
                </a>
            </div>

        </div>
    </section>

    <!-- ════════════════════════════════════════════════
         SECTION 4 — Réseaux & Cybersécurité
    ════════════════════════════════════════════════ -->
    <section id="reseaux-securite" class="mag-section sec-secu">
        <div class="container">

            <div class="mag-section-header">
                <h2 class="mag-section-title">
                    <i class="fas fa-lock"></i> Réseaux &amp; Cybersécurité
                </h2>
                <span class="mag-section-count">3 articles</span>
            </div>

            <p class="mag-section-why">
                La cybersécurité est cruciale dans tous mes développements. Cette veille m'aide à
                rester informé des nouvelles menaces, des bonnes pratiques de sécurisation et des
                évolutions des infrastructures réseau.
            </p>

            <div class="articles-row">
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Février 2026</span>
                    <h4>Sécurité post-quantique</h4>
                    <p>Préparation aux algorithmes de chiffrement résistants aux ordinateurs quantiques, un enjeu critique pour les prochaines années.</p>
                </div>
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Janvier 2026</span>
                    <h4>Zero Trust Architecture</h4>
                    <p>Adoption croissante du modèle « ne jamais faire confiance, toujours vérifier » dans les entreprises pour sécuriser les accès.</p>
                </div>
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Décembre 2025</span>
                    <h4>IA contre les cyberattaques</h4>
                    <p>Utilisation de l'intelligence artificielle pour détecter et contrer les menaces en temps réel, réduisant les délais de réponse.</p>
                </div>
            </div>

            <div class="sources-bar">
                <span class="sources-bar-label"><i class="fas fa-book"></i> Sources</span>
                <a class="source-link" href="https://www.youtube.com/@V2F" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> V2F
                </a>
                <a class="source-link" href="https://www.youtube.com/@Micode" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> Micode
                </a>
                <a class="source-link" href="https://www.cert.ssi.gouv.fr" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> CERT-FR (ANSSI)
                </a>
                <a class="source-link" href="https://owasp.org" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> OWASP
                </a>
                <a class="source-link" href="https://krebsonsecurity.com" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> Krebs on Security
                </a>
                <a class="source-link" href="https://thehackernews.com" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> The Hacker News
                </a>
                <a class="source-link" href="https://www.zataz.com" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> ZATAZ
                </a>
            </div>

        </div>
    </section>

    <!-- ════════════════════════════════════════════════
         SECTION 5 — Gaming
    ════════════════════════════════════════════════ -->
    <section id="gaming" class="mag-section sec-gaming">
        <div class="container">

            <div class="mag-section-header">
                <h2 class="mag-section-title">
                    <i class="fas fa-gamepad"></i> Gaming &amp; Technologies Ludiques
                </h2>
                <span class="mag-section-count">3 articles</span>
            </div>

            <p class="mag-section-why">
                L'industrie du jeu vidéo pousse l'innovation technologique : moteurs 3D, réalité
                virtuelle, cloud gaming. Ces technologies trouvent souvent des applications directes
                dans d'autres domaines du développement logiciel.
            </p>

            <div class="articles-row">
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Février 2026</span>
                    <h4>Unreal Engine 6 en développement</h4>
                    <p>Epic Games annonce des améliorations révolutionnaires pour le rendu en temps réel et l'IA procédurale dans les jeux AAA.</p>
                </div>
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Janvier 2026</span>
                    <h4>Cloud gaming 4K/120fps</h4>
                    <p>GeForce Now et Xbox Cloud atteignent des performances natives grâce aux processeurs ARM de nouvelle génération.</p>
                </div>
                <div class="mag-article">
                    <span class="mag-article-date"><i class="fas fa-calendar-alt"></i> Décembre 2025</span>
                    <h4>VR/AR abordable</h4>
                    <p>Démocratisation de la réalité virtuelle avec des casques à moins de 300€, ouvrant la voie à de nouveaux usages grand public.</p>
                </div>
            </div>

            <div class="sources-bar">
                <span class="sources-bar-label"><i class="fas fa-book"></i> Sources</span>
                <a class="source-link" href="https://www.youtube.com/@LeoTechMaker" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> Leo TechMaker
                </a>
                <a class="source-link" href="https://www.youtube.com/@PlayStationFrance" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> PlayStation France
                </a>
                <a class="source-link" href="https://www.youtube.com/@NintendoFrance" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> Nintendo France
                </a>
                <a class="source-link" href="https://www.youtube.com/@EdouardEMB" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i> Edouard_EMB
                </a>
                <a class="source-link" href="https://fr.ign.com" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> IGN France
                </a>
                <a class="source-link" href="https://www.gamekult.com" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> Gamekult
                </a>
                <a class="source-link" href="https://www.jeuxvideo.com" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i> Jeuxvideo.com
                </a>
            </div>

        </div>
    </section>

    <!-- ════════════════════════════════════════════════
         MÉTHODE DE VEILLE
    ════════════════════════════════════════════════ -->
    <section class="veille-methodology">
        <div class="container">
            <h2 class="section-title">Ma Méthode de Veille</h2>
            <div class="methodology-grid">
                <div class="method-card">
                    <h3><i class="fas fa-search"></i> Recherche</h3>
                    <ul>
                        <li>Lecture quotidienne de sources spécialisées</li>
                        <li>Suivi des leaders d'opinion sur les réseaux</li>
                        <li>Participation à des communautés techniques</li>
                    </ul>
                </div>
                <div class="method-card">
                    <h3><i class="fas fa-pen"></i> Organisation</h3>
                    <ul>
                        <li>Synthèse hebdomadaire des informations</li>
                        <li>Classification par domaine et impact</li>
                        <li>Conservation des articles de référence</li>
                    </ul>
                </div>
                <div class="method-card">
                    <h3><i class="fas fa-rocket"></i> Application</h3>
                    <ul>
                        <li>Test des nouvelles technologies</li>
                        <li>Adaptation des projets en cours</li>
                        <li>Partage avec la communauté étudiante</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Portfolio BTS SIO SLAM — Tous droits réservés</p>
        </div>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>
