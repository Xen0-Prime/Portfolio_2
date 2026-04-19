<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Projets - Portfolio BTS SIO</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/projets.css">
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
            <h1 class="page-title">Mes Projets</h1>
            <p class="page-subtitle">Portfolio de développements BTS SIO SLAM</p>
        </div>
    </section>

    <!-- Projects Content -->
    <section class="section">
        <div class="container">
            <p class="intro-text">
                Découvrez en détail mes projets développés dans le cadre du BTS SIO option SLAM.
                Chaque projet illustre mes compétences techniques et ma progression.
            </p>
        </div>
    </section>

    <!-- Projet 1: Gestion de Stock -->
    <section id="gestion-stock" class="project-detail-section">
        <div class="container">
            <div class="project-detail-card">
                <div class="project-detail-header">
                    <h2>Gestion de Stock</h2>
                    <div class="project-badges">
                        <span class="badge badge-java">Java</span>
                        <span class="badge badge-database">Base de données</span>
                    </div>
                </div>
                
                <div class="project-content">
                    <div class="project-overview">
                        <h3>Description du projet</h3>
                        <p>
                            Application de gestion de stock développée en Java avec interface graphique Swing.
                            Elle permet de gérer les produits, les stocks, les fournisseurs et de générer des rapports.
                            L'application est connectée à une base de données MySQL pour la persistance des données.
                        </p>
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
                            <div class="tech-item">
                                <strong>Langage :</strong> Java 11
                            </div>
                            <div class="tech-item">
                                <strong>Interface :</strong> Java Swing
                            </div>
                            <div class="tech-item">
                                <strong>Base de données :</strong> MySQL
                            </div>
                            <div class="tech-item">
                                <strong>Connecteur :</strong> JDBC
                            </div>
                            <div class="tech-item">
                                <strong>IDE :</strong> NetBeans
                            </div>
                            <div class="tech-item">
                                <strong>Gestion BD :</strong> PHPMyAdmin
                            </div>
                        </div>
                    </div>

                    <div class="project-competences">
                        <h3>Compétences développées</h3>
                        <div class="competences-badges">
                            <span class="comp-badge">Programmation orientée objet</span>
                            <span class="comp-badge">Interface graphique</span>
                            <span class="comp-badge">Base de données relationnelles</span>
                            <span class="comp-badge">SQL</span>
                            <span class="comp-badge">Architecture MVC</span>
                        </div>
                    </div>

                    <div class="project-links">
                        <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/Gestion%20de%20stock" class="btn btn-secondary" target="_blank">
                            <i class="fab fa-github"></i> Code source
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projet 2: Gestion d'Absences -->
    <section id="gestion-absences" class="project-detail-section bg-light">
        <div class="container">
            <div class="project-detail-card">
                <div class="project-detail-header">
                    <h2>Gestion d'Absences</h2>
                    <div class="project-badges">
                        <span class="badge badge-mobile">Mobile</span>
                        <span class="badge badge-react">React Native</span>
                    </div>
                </div>
                
                <div class="project-content">
                    <div class="project-overview">
                        <h3>Description du projet</h3>
                        <p>
                            Application mobile développée en React Native permettant aux employés de gérer leurs demandes d'absence.
                            L'application inclut un système de validation hiérarchique et des notifications push pour informer
                            des statuts des demandes. Backend développé avec Node.js et base de données PostgreSQL.
                        </p>
                    </div>

                    <div class="project-features">
                        <h3>Fonctionnalités principales</h3>
                        <ul class="features-list">
                            <li>Inscription et authentification utilisateurs</li>
                            <li>Création et suivi des demandes d'absence</li>
                            <li>Système de validation par le manager</li>
                            <li>Calendrier intégré pour visualiser les absences</li>
                            <li>Notifications push en temps réel</li>
                            <li>Historique des demandes</li>
                            <li>Interface responsive</li>
                        </ul>
                    </div>

                    <div class="project-tech">
                        <h3>Technologies utilisées</h3>
                        <div class="tech-grid">
                            <div class="tech-item">
                                <strong>Frontend :</strong> React Native
                            </div>
                            <div class="tech-item">
                                <strong>Backend :</strong> Node.js + Express
                            </div>
                            <div class="tech-item">
                                <strong>Base de données :</strong> PostgreSQL
                            </div>
                            <div class="tech-item">
                                <strong>API :</strong> REST
                            </div>
                            <div class="tech-item">
                                <strong>Authentification :</strong> JWT
                            </div>
                            <div class="tech-item">
                                <strong>Notifications :</strong> Push notifications
                            </div>
                        </div>
                    </div>

                    <div class="project-competences">
                        <h3>Compétences développées</h3>
                        <div class="competences-badges">
                            <span class="comp-badge">Développement mobile</span>
                            <span class="comp-badge">API REST</span>
                            <span class="comp-badge">JavaScript ES6+</span>
                            <span class="comp-badge">Base de données NoSQL</span>
                            <span class="comp-badge">Architecture client-serveur</span>
                        </div>
                    </div>

                    <div class="project-links">
                        <a href="https://github.com/Laeticia18/Appli-mobile-react.git" class="btn btn-secondary" target="_blank">
                            <i class="fab fa-github"></i> Code source
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projet 3: Vwati Nef -->
    <section id="vwati-nef" class="project-detail-section">
        <div class="container">
            <div class="project-detail-card">
                <div class="project-detail-header">
                    <h2>Vwati Nef</h2>
                    <div class="project-badges">
                        <span class="badge badge-web">Web</span>
                        <span class="badge badge-php">PHP</span>
                    </div>
                </div>
                
                <div class="project-content">
                    <div class="project-overview">
                        <h3>Description du projet</h3>
                        <p>
                            Site web de concessionnaire automobile développé en PHP avec une base de données MySQL.
                            Le site permet aux clients de consulter le catalogue de véhicules, de rechercher par critères
                            et aux administrateurs de gérer l'inventaire. Interface moderne et responsive.
                        </p>
                    </div>

                    <div class="project-features">
                        <h3>Fonctionnalités principales</h3>
                        <ul class="features-list">
                            <li>Catalogue de véhicules avec photos</li>
                            <li>Système de recherche avancée</li>
                            <li>Filtrage par marque, prix, année</li>
                            <li>Interface d'administration</li>
                            <li>Gestion des stocks de véhicules</li>
                            <li>Formulaire de contact intégré</li>
                            <li>Design responsive</li>
                        </ul>
                    </div>

                    <div class="project-tech">
                        <h3>Technologies utilisées</h3>
                        <div class="tech-grid">
                            <div class="tech-item">
                                <strong>Backend :</strong> PHP 7.4
                            </div>
                            <div class="tech-item">
                                <strong>Frontend :</strong> HTML5, CSS3, JavaScript
                            </div>
                            <div class="tech-item">
                                <strong>Base de données :</strong> MySQL
                            </div>
                            <div class="tech-item">
                                <strong>Framework CSS :</strong> Bootstrap
                            </div>
                            <div class="tech-item">
                                <strong>Serveur :</strong> Apache (WAMP)
                            </div>
                            <div class="tech-item">
                                <strong>Gestion BD :</strong> PHPMyAdmin
                            </div>
                        </div>
                    </div>

                    <div class="project-competences">
                        <h3>Compétences développées</h3>
                        <div class="competences-badges">
                            <span class="comp-badge">Développement web</span>
                            <span class="comp-badge">PHP orienté objet</span>
                            <span class="comp-badge">Requêtes SQL complexes</span>
                            <span class="comp-badge">Design responsive</span>
                            <span class="comp-badge">Sécurité web</span>
                        </div>
                    </div>

                    <div class="project-links">
                        <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/Vwati%20nef" class="btn btn-secondary" target="_blank">
                            <i class="fab fa-github"></i> Code source
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projet 4: Projet IoT -->
    <section id="projet-iot" class="project-detail-section bg-light">
        <div class="container">
            <div class="project-detail-card">
                <div class="project-detail-header">
                    <h2>Projet IoT</h2>
                    <div class="project-badges">
                        <span class="badge badge-stage">Stage</span>
                        <span class="badge badge-iot">IoT</span>
                    </div>
                </div>
                
                <div class="project-content">
                    <div class="project-overview">
                        <h3>Description du projet</h3>
                        <p>
                            Projet réalisé en stage de 2ème année intégrant des capteurs IoT pour la collecte et l'analyse de données
                            environnementales en temps réel. Le système comprend des capteurs de température, humidité
                            et qualité de l'air, avec visualisation 3D des données via Three.js et tableau de bord interactif.
                        </p>
                    </div>

                    <div class="project-features">
                        <h3>Fonctionnalités principales</h3>
                        <ul class="features-list">
                            <li>Collecte de données en temps réel</li>
                            <li>Communication MQTT entre capteurs</li>
                            <li>Stockage dans base de données PostgreSQL</li>
                            <li>Visualisation 3D des données</li>
                            <li>Tableau de bord interactif</li>
                            <li>Système d'alertes automatiques</li>
                            <li>API REST pour accès aux données</li>
                        </ul>
                    </div>

                    <div class="project-tech">
                        <h3>Technologies utilisées</h3>
                        <div class="tech-grid">
                            <div class="tech-item">
                                <strong>Capteurs :</strong> Arduino, Raspberry Pi
                            </div>
                            <div class="tech-item">
                                <strong>Communication :</strong> MQTT
                            </div>
                            <div class="tech-item">
                                <strong>Backend :</strong> Python, Node.js
                            </div>
                            <div class="tech-item">
                                <strong>Visualisation :</strong> Three.js
                            </div>
                            <div class="tech-item">
                                <strong>Base de données :</strong> PostgreSQL
                            </div>
                            <div class="tech-item">
                                <strong>API :</strong> REST
                            </div>
                        </div>
                    </div>

                    <div class="project-competences">
                        <h3>Compétences développées</h3>
                        <div class="competences-badges">
                            <span class="comp-badge">Internet des Objets (IoT)</span>
                            <span class="comp-badge">Protocoles de communication</span>
                            <span class="comp-badge">Visualisation de données</span>
                            <span class="comp-badge">Programmation embarquée</span>
                            <span class="comp-badge">Architecture distribuée</span>
                        </div>
                    </div>

                    <div class="project-links">
                        <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/IoT" class="btn btn-secondary" target="_blank">
                            <i class="fab fa-github"></i> Code source
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projet 5: Projet Voyage -->
    <section id="projet-voyage" class="project-detail-section">
        <div class="container">
            <div class="project-detail-card">
                <div class="project-detail-header">
                    <h2>Projet Voyage</h2>
                    <div class="project-badges">
                        <span class="badge badge-web">Web</span>
                        <span class="badge badge-php">PHP</span>
                    </div>
                </div>
                
                <div class="project-content">
                    <div class="project-overview">
                        <h3>Description du projet</h3>
                        <p>
                            Plateforme web de réservation de voyages développée en PHP avec MySQL.
                            Le site permet aux utilisateurs de rechercher, comparer et réserver des voyages.
                            Interface d'administration pour la gestion des destinations et des réservations.
                        </p>
                    </div>

                    <div class="project-features">
                        <h3>Fonctionnalités principales</h3>
                        <ul class="features-list">
                            <li>Catalogue de destinations</li>
                            <li>Système de recherche et filtres</li>
                            <li>Processus de réservation complet</li>
                            <li>Gestion des comptes utilisateurs</li>
                            <li>Interface d'administration</li>
                            <li>Système de paiement simulé</li>
                            <li>Notifications par email</li>
                        </ul>
                    </div>

                    <div class="project-tech">
                        <h3>Technologies utilisées</h3>
                        <div class="tech-grid">
                            <div class="tech-item">
                                <strong>Backend :</strong> PHP 7.4
                            </div>
                            <div class="tech-item">
                                <strong>Frontend :</strong> HTML5, CSS3, JavaScript
                            </div>
                            <div class="tech-item">
                                <strong>Base de données :</strong> MySQL
                            </div>
                            <div class="tech-item">
                                <strong>Gestion BD :</strong> PHPMyAdmin
                            </div>
                            <div class="tech-item">
                                <strong>Framework :</strong> Bootstrap
                            </div>
                            <div class="tech-item">
                                <strong>Serveur :</strong> Apache
                            </div>
                        </div>
                    </div>

                    <div class="project-competences">
                        <h3>Compétences développées</h3>
                        <div class="competences-badges">
                            <span class="comp-badge">E-commerce</span>
                            <span class="comp-badge">Gestion de sessions</span>
                            <span class="comp-badge">Sécurité des paiements</span>
                            <span class="comp-badge">UX/UI Design</span>
                            <span class="comp-badge">Tests et débogage</span>
                        </div>
                    </div>

                    <div class="project-links">
                        <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/Projet_Voyage" class="btn btn-secondary" target="_blank">
                            <i class="fab fa-github"></i> Code source
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Projet 6: Appli Symfony -->
    <section id="projet-symfony" class="project-detail-section">
        <div class="container">
            <div class="project-detail-card">
                <div class="project-detail-header">
                    <h2>Application Symfony</h2>
                    <div class="project-badges">
                        <span class="badge badge-php">PHP</span>
                        <span class="badge badge-database">Base de données</span>
                    </div>
                </div>
                
                <div class="project-content">
                    <div class="project-overview">
                        <h3>Description du projet</h3>
                        <p>
                            Application de gestion de stock développée en PHP avec le framework Symfony.
                            Le contexte de ce projet est de créer une interface pour les bornes dans les fast foods, permettant de gérer les commandes et les stocks en temps réel. L'application est connectée à une base de données PostgreSQL pour la persistance des données.
                            Mon application est une borne pour customiser son kebab, ajouter, modifier ou supprimer des éléments dans le kebab, et valider la commande. L'application est conçue pour être utilisée sur des bornes tactiles dans les fast foods, offrant une expérience utilisateur fluide et intuitive.
                        </p>
                    </div>

                    <div class="project-features">
                        <h3>Fonctionnalités principales</h3>
                        <ul class="features-list">
                            <li>Consultation de la carte</li>
                            <li>Personnalisation des kebabs</li>
                            <li>Gestion du panier</li>
                            <li>Validation des commandes</li>
                        </ul>
                    </div>

                    <div class="project-tech">
                        <h3>Technologies utilisées</h3>
                        <div class="tech-grid">
                            <div class="tech-item">
                                <strong>Langage :</strong> PHP 8
                            </div>
                            <div class="tech-item">
                                <strong>Framework :</strong> Symfony 5
                            </div>
                            <div class="tech-item">
                                <strong>Base de données :</strong> PostgreSQL
                            </div>
                            <div class="tech-item">
                                <strong>Connecteur :</strong> Doctrine ORM
                            </div>
                            <div class="tech-item">
                                <strong>IDE :</strong> PhpStorm
                            </div>
                            <div class="tech-item">
                                <strong>Gestion BD :</strong> PHPMyAdmin
                            </div>
                        </div>
                    </div>

                    <div class="project-competences">
                        <h3>Compétences développées</h3>
                        <div class="competences-badges">
                            <span class="comp-badge">Programmation orientée objet</span>
                            <span class="comp-badge">Interface graphique</span>
                            <span class="comp-badge">Base de données relationnelles</span>
                            <span class="comp-badge">SQL</span>
                            <span class="comp-badge">Architecture MVC</span>
                        </div>
                    </div>

                    <div class="project-links">
                        <a href="https://github.com/Xen0-Prime/Portfolio_projets/tree/main/borne-kebab" class="btn btn-secondary" target="_blank">
                            <i class="fab fa-github"></i> Code source
                        </a>
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