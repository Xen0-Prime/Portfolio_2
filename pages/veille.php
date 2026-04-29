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
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Veille Technologique</h1>
            <p class="page-subtitle">Actualités et innovations informatiques</p>
        </div>
    </section>

    <!-- Veille Content -->
    <section class="section">
        <div class="container">
            <p class="intro-text">
                Dans le cadre du BTS SIO, je maintiens une veille technologique active pour rester 
                informé des dernières évolutions et tendances du secteur informatique.
            </p>
        </div>
    </section>

    <!-- Smartphone -->
    <section id="smartphone" class="veille-detail-section">
        <div class="container">
            <div class="veille-detail-card">
                <div class="veille-detail-header">
                    <h2><i class="fas fa-mobile-alt"></i> Smartphones & Mobilité</h2>
                    <div class="veille-badges">
                        <span class="badge badge-mobile">Mobile</span>
                        <span class="badge badge-innovation">Innovation</span>
                    </div>
                </div>
                
                <div class="veille-content">
                    <div class="veille-overview">
                        <h3>Pourquoi cette veille ?</h3>
                        <p>
                            Les smartphones évoluent constamment avec de nouvelles technologies : 5G, IA intégrée, 
                            réalité augmentée, interface utilisateur. Cette veille m'aide à comprendre les 
                            contraintes et opportunités du développement mobile.
                        </p>
                    </div>

                    <div class="veille-recent">
                        <h3><i class="fas fa-newspaper"></i> Actualités récentes</h3>
                        <div class="news-grid">
                            <div class="news-item">
                                <h4>Intelligence artificielle embarquée</h4>
                                <p>Les SoC intègrent désormais des puces IA dédiées pour améliorer les performances des assistants vocaux et de la reconnaissance d'images.</p>
                                <span class="date">Février 2026</span>
                            </div>
                            <div class="news-item">
                                <h4>Écrans pliables nouvelle génération</h4>
                                <p>Amélioration de la durabilité des écrans flexibles et nouvelles interfaces adaptatives.</p>
                                <span class="date">Janvier 2026</span>
                            </div>
                            <div class="news-item">
                                <h4>6G : premiers prototypes</h4>
                                <p>Les premières démonstrations de connectivité 6G promettent des débits révolutionnaires.</p>
                                <span class="date">Décembre 2025</span>
                            </div>
                        </div>
                    </div>

                    <div class="veille-impact">
                        <h3><i class="fas fa-lightbulb"></i> Impact sur le développement</h3>
                        <ul class="impact-list">
                            <li>Nouvelles API pour exploiter l'IA embarquée</li>
                            <li>Adaptation des interfaces pour écrans pliables</li>
                            <li>Optimisation des applications pour la 5G/6G</li>
                            <li>Sécurité renforcée avec l'authentification biométrique</li>
                        </ul>
                    </div>

                    <div class="veille-sources">
                        <h3><i class="fas fa-book"></i> Sources suivies</h3>
                        <div class="sources-grid">
                            <span class="source-tag">Jojol</span>
                            <span class="source-tag">Monsieur GRrr</span>
                            <span class="source-tag">Brandon le Proktor</span>
                            <span class="source-tag">Leo TechMaker</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Composants PC -->
    <section id="composants-pc" class="veille-detail-section bg-light">
        <div class="container">
            <div class="veille-detail-card">
                <div class="veille-detail-header">
                    <h2><i class="fas fa-laptop"></i> Hardware & Composants PC</h2>
                    <div class="veille-badges">
                        <span class="badge badge-hardware">Hardware</span>
                        <span class="badge badge-performance">Performance</span>
                    </div>
                </div>
                
                <div class="veille-content">
                    <div class="veille-overview">
                        <h3> Pourquoi cette veille ?</h3>
                        <p>
                            L'évolution rapide des composants PC (processeurs, cartes graphiques, stockage) 
                            influence directement les performances des applications que je développe. 
                            Comprendre ces évolutions m'aide à optimiser mes développements.
                        </p>
                    </div>

                    <div class="veille-recent">
                        <h3><i class="fas fa-newspaper"></i> Actualités récentes</h3>
                        <div class="news-grid">
                            <div class="news-item">
                                <h4>Processeurs ARM pour PC</h4>
                                <p>Apple M3 et Qualcomm Snapdragon X révolutionnent l'architecture des ordinateurs portables avec une efficacité énergétique exceptionnelle.</p>
                                <span class="date">Février 2026</span>
                            </div>
                            <div class="news-item">
                                <h4>SSD NVMe 6.0</h4>
                                <p>Les nouveaux standards de stockage atteignent des vitesses de 32 Go/s, révolutionnant les temps de chargement.</p>
                                <span class="date">Janvier 2026</span>
                            </div>
                            <div class="news-item">
                                <h4>Ray Tracing démocratisé</h4>
                                <p>Les cartes graphiques milieu de gamme intègrent désormais le ray tracing hardware.</p>
                                <span class="date">Décembre 2025</span>
                            </div>
                        </div>
                    </div>

                    <div class="veille-impact">
                        <h3><i class="fas fa-lightbulb"></i> Impact sur le développement</h3>
                        <ul class="impact-list">
                            <li>Optimisation multi-architecture (x86, ARM)</li>
                            <li>Exploitation du stockage ultra-rapide</li>
                            <li>Développement d'applications gourmandes en ressources</li>
                            <li>Compatibilité avec les nouvelles architectures</li>
                        </ul>
                    </div>

                    <div class="veille-sources">
                        <h3><i class="fas fa-book"></i> Sources suivies</h3>
                        <div class="sources-grid">
                            <span class="source-tag">Leo TechMaker</span>
                            <span class="source-tag">French Hardware</span>
                            <span class="source-tag">KAPPA Studio</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Intelligence Artificielle Sources à suivre -->
    <section id="intelligence-artificielle" class="veille-detail-section">
        <div class="container">
            <div class="veille-detail-card">
                <div class="veille-detail-header">
                    <h2><i class="fas fa-robot"></i> Intelligence Artificielle</h2>
                    <div class="veille-badges">
                        <span class="badge badge-ai">IA</span>
                        <span class="badge badge-ml">Machine Learning</span>
                    </div>
                </div>
                
                <div class="veille-content">
                    <div class="veille-overview">
                        <h3> Pourquoi cette veille ?</h3>
                        <p>
                            L'IA transforme le développement logiciel : assistants de code, génération automatique, 
                            analyse de données intelligente. Cette veille m'aide à intégrer ces outils dans 
                            mes projets et à anticiper les évolutions du métier.
                        </p>
                    </div>

                    <div class="veille-recent">
                        <h3><i class="fas fa-newspaper"></i> Actualités récentes</h3>
                        <div class="news-grid">
                            <div class="news-item">
                                <h4>IA générative pour le code</h4>
                                <p>Claude, ChatGPT et GitHub Copilot X révolutionnent l'assistance au développement avec une meilleure compréhension contextuelle.</p>
                                <span class="date">Février 2026</span>
                            </div>
                            <div class="news-item">
                                <h4>Modèles open source performants</h4>
                                <p>Llama 3 et Mistral 8x22B offrent des alternatives viables aux modèles propriétaires.</p>
                                <span class="date">Janvier 2026</span>
                            </div>
                            <div class="news-item">
                                <h4>IA multimodale</h4>
                                <p>Les nouveaux modèles traitent simultanément texte, image, audio et vidéo.</p>
                                <span class="date">Décembre 2025</span>
                            </div>
                        </div>
                    </div>

                    <div class="veille-impact">
                        <h3><i class="fas fa-lightbulb"></i> Impact sur le développement</h3>
                        <ul class="impact-list">
                            <li>Assistance intelligente à la programmation</li>
                            <li>Génération automatique de tests</li>
                            <li>Analyse et optimisation de code</li>
                            <li>Nouvelles interfaces utilisateur conversationnelles</li>
                        </ul>
                    </div>

                    <div class="veille-sources">
                        <h3><i class="fas fa-book"></i> Sources suivies</h3>
                        <div class="sources-grid">
                            <span class="source-tag">Google AI</span>
                            <span class="source-tag">Anthropic</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Réseaux & Sécurité -->
    <section id="reseaux-securite" class="veille-detail-section bg-light">
        <div class="container">
            <div class="veille-detail-card">
                <div class="veille-detail-header">
                    <h2><i class="fas fa-lock"></i> Réseaux & Cybersécurité</h2>
                    <div class="veille-badges">
                        <span class="badge badge-security">Sécurité</span>
                        <span class="badge badge-network">Réseaux</span>
                    </div>
                </div>
                
                <div class="veille-content">
                    <div class="veille-overview">
                        <h3> Pourquoi cette veille ?</h3>
                        <p>
                            La cybersécurité est cruciale dans tous mes développements. Cette veille m'aide 
                            à rester informé des nouvelles menaces, des bonnes pratiques de sécurisation 
                            et des évolutions des infrastructures réseau.
                        </p>
                    </div>

                    <div class="veille-recent">
                        <h3><i class="fas fa-newspaper"></i> Actualités récentes</h3>
                        <div class="news-grid">
                            <div class="news-item">
                                <h4>Sécurité post-quantique</h4>
                                <p>Préparation aux algorithmes de chiffrement résistants aux ordinateurs quantiques.</p>
                                <span class="date">Février 2026</span>
                            </div>
                            <div class="news-item">
                                <h4>Zero Trust Architecture</h4>
                                <p>Adoption croissante du modèle "ne jamais faire confiance, toujours vérifier" dans les entreprises.</p>
                                <span class="date">Janvier 2026</span>
                            </div>
                            <div class="news-item">
                                <h4>IA contre les cyberattaques</h4>
                                <p>Utilisation de l'intelligence artificielle pour détecter et contrer les menaces en temps réel.</p>
                                <span class="date">Décembre 2025</span>
                            </div>
                        </div>
                    </div>

                    <div class="veille-impact">
                        <h3><i class="fas fa-lightbulb"></i> Impact sur le développement</h3>
                        <ul class="impact-list">
                            <li>Implémentation de protocoles sécurisés</li>
                            <li>Chiffrement et protection des données</li>
                            <li>Authentification multi-facteurs</li>
                            <li>Tests de sécurité automatisés</li>
                        </ul>
                    </div>

                    <div class="veille-sources">
                        <h3><i class="fas fa-book"></i> Sources suivies</h3>
                        <div class="sources-grid">
                            <span class="source-tag">V2F</span>
                            <span class="source-tag">Micode</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gaming -->
    <section id="gaming" class="veille-detail-section">
        <div class="container">
            <div class="veille-detail-card">
                <div class="veille-detail-header">
                    <h2><i class="fas fa-gamepad"></i> Gaming & Technologies Ludiques</h2>
                    <div class="veille-badges">
                        <span class="badge badge-gaming">Gaming</span>
                        <span class="badge badge-graphics">Graphiques</span>
                    </div>
                </div>
                
                <div class="veille-content">
                    <div class="veille-overview">
                        <h3> Pourquoi cette veille ?</h3>
                        <p>
                            L'industrie du jeu vidéo pousse l'innovation technologique : moteurs 3D, 
                            réalité virtuelle, cloud gaming. Ces technologies trouvent souvent des 
                            applications dans d'autres domaines du développement.
                        </p>
                    </div>

                    <div class="veille-recent">
                        <h3><i class="fas fa-newspaper"></i> Actualités récentes</h3>
                        <div class="news-grid">
                            <div class="news-item">
                                <h4>Unreal Engine 6 en développement</h4>
                                <p>Epic Games annonce des améliorations révolutionnaires pour le rendu en temps réel et l'IA procédurale.</p>
                                <span class="date">Février 2026</span>
                            </div>
                            <div class="news-item">
                                <h4>Cloud gaming 4K/120fps</h4>
                                <p>GeForce Now et Xbox Cloud atteignent des performances natives grâce aux processeurs ARM.</p>
                                <span class="date">Janvier 2026</span>
                            </div>
                            <div class="news-item">
                                <h4>VR/AR abordable</h4>
                                <p>Démocratisation de la réalité virtuelle avec des casques à moins de 300€.</p>
                                <span class="date">Décembre 2025</span>
                            </div>
                        </div>
                    </div>

                    <div class="veille-impact">
                        <h3><i class="fas fa-lightbulb"></i> Impact sur le développement</h3>
                        <ul class="impact-list">
                            <li>Techniques de rendu 3D avancées</li>
                            <li>Optimisation des performances graphiques</li>
                            <li>Interfaces immersives et interactives</li>
                            <li>Développement d'applications VR/AR</li>
                        </ul>
                    </div>

                    <div class="veille-sources">
                        <h3><i class="fas fa-book"></i> Sources suivies</h3>
                        <div class="sources-grid">
                            <span class="source-tag">Leo TechMaker</span>
                            <span class="source-tag">Playstation France</span>
                            <span class="source-tag">Nintendo France</span>
                            <span class="source-tag">Edouard_EMB</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Vue d'ensemble et méthode à refaire -->
    <section class="veille-methodology bg-light">
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
                    <h3> Application</h3>
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
            <p>&copy; 2025 Portfolio BTS SIO SLAM - Tous droits réservés</p>
        </div>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>
