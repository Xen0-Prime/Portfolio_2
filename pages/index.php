<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio BTS SIO SLAM</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">Portfolio</div>
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php" class="active">Accueil</a></li>
                <li><a href="#about">À propos</a></li>
                <li><a href="#competences">Compétences</a></li>
                <li><a href="#projets">Projets</a></li>
                <li><a href="#veille">Veille</a></li>
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Killian Narasson Mohamedaly</h1>
                <p class="hero-subtitle">Étudiant BTS SIO option SLAM</p>
                <p class="hero-description">
                    Passionné par le développement d'applications et la programmation,
                    je suis à la recherche d'opportunités pour mettre en pratique mes compétences.
                </p>
                <div class="hero-buttons">
                    <a href="projets.php" class="btn btn-primary">Voir mes projets</a>
                    <a href="contact.php" class="btn btn-secondary">Me contacter</a>
                    <a href="../stages/docs/CV-NARASSON-MOHAMEDALY Killian.pdf" class="btn btn-secondary" download>Télécharger mon CV</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <h2 class="section-title">À propos</h2>
            <div class="about-content">
                <div class="about-text">
                    <h3>Parcours</h3>
                    <p>
                        Actuellement en deuxième année de BTS Services Informatiques aux Organisations,
                        option Solutions Logicielles et Applications Métiers (SLAM), je développe des
                        compétences en programmation et en gestion de projets informatiques.
                    </p>
                    <h3>Formation</h3>
                    <ul class="timeline">
                        <li>
                            <strong>2024 - 2026</strong> - BTS SIO option SLAM<br>
                            <span class="text-muted">LGT Baimbridge</span>
                            <span class="text-muted"> (en cours)</span><br>
                            <span class="text-muted"> Matière principales :
                                <ul class="spe">
                                    <li>CEJM</li>
                                    <li>AP</li>
                                    <li>Cybersécurité</li>
                                    <li>Algorithmie et programmation</li>
                                    <li>Base de données</li>
                                    <li>Développement d'applications</li>
                                </ul>
                            </span>
                        </li>
                        <li>
                            <strong>2022-2024</strong> - Baccalauréat STL<br>
                            <span class="text-muted">LGT Providence</span><br>
                            <span class="text-muted"> Spécialitées :
                                <ul class="spe">
                                    <li>Biochimie-Biologie</li>
                                    <li>Physique-Chimie et Mathématiques</li>
                                    <li>Sciences physiques et chimiques en laboratoire</li>
                                </ul>
                            </span>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Compétences Section -->
    <section id="competences" class="section bg-light">
        <div class="container">
            <h2 class="section-title">Compétences</h2>
            
            <!-- Blocs de compétences BTS SIO -->
            <div class="competences-blocs">
                <div class="bloc-card">
                    <h3>Support et mise à disposition</h3>
                    <ul>
                        <li>Gérer le patrimoine informatique</li>
                        <li>Répondre aux incidents et aux demandes</li>
                        <li>Développer la présence en ligne</li>
                    </ul>
                </div>
                
                <div class="bloc-card">
                    <h3>Conception et développement</h3>
                    <ul>
                        <li>Concevoir et développer une solution applicative</li>
                        <li>Assurer la maintenance corrective ou évolutive</li>
                        <li>Gérer les données</li>
                    </ul>
                </div>
                
                <div class="bloc-card">
                    <h3>Cybersécurité</h3>
                    <ul>
                        <li>Protéger les données à caractère personnel</li>
                        <li>Préserver l'identité numérique</li>
                        <li>Sécuriser les équipements et les usages</li>
                    </ul>
                </div>
            </div>

            <!-- Technologies -->
            <h3 class="mt-5">Technologies maîtrisées</h3>
            <div class="skills-grid">
                <div class="skill-card">
                    <h4>Langages</h4>
                    <div class="skill-tags">
                        <span class="tag">Java</span>
                        <span class="tag">JavaScript</span>
                        <span class="tag">Python</span>
                        <span class="tag">SQL</span>
                        <span class="tag">HTML/CSS</span>
                    </div>
                </div>
                
                <div class="skill-card">
                    <h4>Frameworks</h4>
                    <div class="skill-tags">
                        <span class="tag">React Native</span>
                        <span class="tag">Node.js</span>
                        <span class="tag">Bootstrap</span>
                    </div>
                </div>
                
                <div class="skill-card">
                    <h4>Bases de données</h4>
                    <div class="skill-tags">
                        <span class="tag">MySQL</span>
                        <span class="tag">PHPMyAdmin</span>
                        <span class="tag">PostgreSQL</span>
                    </div>
                </div>
                
                <div class="skill-card">
                    <h4>Outils</h4>
                    <div class="skill-tags">
                        <span class="tag">GitHub</span>
                        <span class="tag">VS Code</span>
                        <span class="tag">Claude</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projets Section -->
     <section id="projets" class="section">
        <div class="container">
            <h2 class="section-title">Mes Projets</h2>
            <a href="projets.php" class="btn btn-all-projects mb-4">Voir tous les projets →</a>
            <div class="projects-grid">
                
                <!-- Projet 1 -->
                <div class="project-card">
                    <div class="project-header">
                        <h3>Gestion de Stock</h3>
                        <span class="project-tag">Java</span>
                    </div>
                    <p class="project-description">
                        Application de gestion de produits développée en Java avec interface graphique,
                        connectée à une base de données MySQL via PHPMyAdmin.
                    </p>
                    <div class="project-tech">
                        <span class="tech-badge">Java</span>
                        <span class="tech-badge">MySQL</span>
                        <span class="tech-badge">JDBC</span>
                    </div>
                    <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/Gestion%20de%20stock" class="project-link">Voir le code source du projet →</a>
                    <a href="projets.php#gestion-stock" class="btn btn-primary mt-2">Voir les détails →</a>

                </div>

                <!-- Projet 2 -->
                <div class="project-card">
                    <div class="project-header">
                        <h3>Gestion d'Absences</h3>
                        <span class="project-tag">Mobile</span>
                    </div>
                    <p class="project-description">
                        Application mobile React Native permettant aux utilisateurs de gérer
                        leurs demandes d'absence avec un système de validation.
                    </p>
                    <div class="project-tech">
                        <span class="tech-badge">React Native</span>
                        <span class="tech-badge">JavaScript</span>
                        <span class="tech-badge">API REST</span>
                        <span class="tech-badge">Node.js</span>
                        <span class="tech-badge">PostgreSQL</span>
                    </div>
                    <a href="https://github.com/Laeticia18/Appli-mobile-react.git" class="project-link">Voir le code source du projet →</a>
                    <a href="projets.php#gestion-absences" class="btn btn-primary mt-2">Voir les détails →</a>
                
                </div>

                <!-- Projet 3 -->
                <div class="project-card">
                    <div class="project-header">
                        <h3>Vwati Nef</h3>
                        <span class="project-tag">Web</span>
                    </div>
                    <p class="project-description">
                        Site web de concessionnaire automobile avec catalogue de véhicules,
                        système de recherche et interface d'administration.
                    </p>
                    <div class="project-tech">
                        <span class="tech-badge">HTML/CSS</span>
                        <span class="tech-badge">JavaScript</span>
                        <span class="tech-badge">PHP</span>
                    </div>
                    <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/Vwati%20nef" class="project-link">Voir le code source du projet →</a>
                    <a href="projets.php#vwati-nef" class="btn btn-primary mt-2">Voir les détails →</a>
                </div>

                <!-- Projet 4 -->
                <div class="project-card">
                    <div class="project-header">
                        <h3>Projet IoT</h3>
                        <span class="project-tag">Stage</span>
                    </div>
                    <p class="project-description">
                        Projet réalisé en stage intégrant des capteurs IoT pour la collecte
                        et l'analyse de données en temps réel.
                    </p>
                    <div class="project-tech">
                        <span class="tech-badge">IoT</span>
                        <span class="tech-badge">Python</span>
                        <span class="tech-badge">MQTT</span>
                        <span class="tech-badge">Three.js</span>
                        <span class="tech-badge">Node.js</span>
                        <span class="tech-badge">API REST</span>
                        <span class="tech-badge">PostgreSQL</span>
                    </div>
                    <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/IoT" class="project-link">Voir le code source du projet →</a>
                    <a href="projets.php#projet-iot" class="btn btn-primary mt-2">Voir les détails →</a>

                </div>

                <!-- Projet 5 -->
                <div class="project-card">
                    <div class="project-header">
                        <h3>Projet Voyage</h3>
                        <span class="project-tag">Web</span>
                    </div>
                    <p class="project-description">
                        Description du projet voyage. À personnaliser selon votre projet.
                    </p>
                    <div class="project-tech">
                        <span class="tech-badge">HTML/CSS</span>
                        <span class="tech-badge">JavaScript</span>
                        <span class="tech-badge">PHP</span>
                        <span class="tech-badge">PHPMyAdmin</span>
                        <span class="tech-badge">MySQL</span>
                    </div>
                    <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/Voyage" class="project-link">Voir le projet →</a>
                    <a href="projets.php#projet-voyage" class="btn btn-primary mt-2">Voir les détails →</a>
                </div>

                <!-- Projet 6 -->
                <div class="project-card">
                    <div class="project-header">
                        <h3>Projet Symfony</h3>
                        <span class="project-tag">Web</span>
                    </div>
                    <p class="project-description">
                        Description du projet Symfony. À personnaliser selon votre projet.
                    </p>
                    <div class="project-tech">
                        <span class="tech-badge">Docker</span>
                        <span class="tech-badge">Symfony</span>
                        <span class="tech-badge">PHP</span>
                        <span class="tech-badge">PHPMyAdmin</span>
                        <span class="tech-badge">PostgreSQL</span>
                    </div>
                    <a href=" class="project-link">Voir le projet →</a>
                    <a href="">Voir les détails →</a>
                </div>


            </div>
        </div>
    </section>

    <!-- Veille Section -->
    <section id="veille" class="section bg-light">
        <div class="container">
            <h2 class="section-title">Veille Technologique</h2>
            <a href="veille.php" class="btn btn-all-projects mb-4">Voir tous les sujets de veille →</a>
            <div class="veille-content">
                <p class="veille-intro">
                    Dans le cadre du BTS SIO, je maintiens une veille technologique active sur les
                    domaines suivants :
                </p>
                
                <div class="veille-grid">
                    <div class="veille-card">
                        <h3>Smartphone</h3>
                        <p>
                           Évolution des technologies mobiles et innovations
                        </p>
                        <a href="veille.php#smartphone" class="btn btn-secondary btn-sm">Lire la suite →</a>
                    </div>
                    
                    <div class="veille-card">
                        <h3>Composants PC</h3>
                        <p>
                           Actualités hardware et nouvelles technologies
                        </p>
                        <a href="veille.php#composants-pc" class="btn btn-secondary btn-sm">Lire la suite →</a>
                    </div>
                    
                    <div class="veille-card">
                        <h3>IA</h3>
                        <p>
                            Intelligence artificielle et machine learning
                        </p>
                        <a href="veille.php#intelligence-artificielle" class="btn btn-secondary btn-sm">Lire la suite →</a>
                    </div>

                    <div class="veille-card">
                        <h3>Réseaux</h3>
                        <p>
                            Cybersécurité et infrastructures réseau
                        </p>
                        <a href="veille.php#reseaux-securite" class="btn btn-secondary btn-sm">Lire la suite →</a>
                    </div>

                    <div class="veille-card">
                        <h3>Jeux vidéos</h3>
                        <p>
                            Technologies gaming et développement ludique
                        </p>
                        <a href="veille.php#gaming" class="btn btn-secondary btn-sm">Lire la suite →</a>
                    </div>

                    <div class="veille-card">
                        <h3>Développement mobile</h3>
                        <p>
                            Frameworks et tendances du mobile
                        </p>
                        <a href="veille.php#developpement-mobile" class="btn btn-secondary btn-sm">Lire la suite →</a>
                    </div>
                </div>

                <div class="veille-sources mt-4">
                    <h3>Sources de veille</h3>
                    <ul>
                        <li>YouTube pour les tutoriels et conférences</li>
                        <li>X pour voir les actualités technologiques</li>
                        <li>Instagram pour suivre les tendances et communautés</li>
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

    <!-- Bouton retour en haut -->
    <button id="backToTop" class="back-to-top" title="Retour en haut">
        ↑
    </button>

    <script src="../js/script.js"></script>
</body>
</html>
