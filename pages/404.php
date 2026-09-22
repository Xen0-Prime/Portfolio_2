<?php http_response_code(404); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page introuvable — Portfolio L3 MIAGE</title>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .error-wrap {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 4rem 1rem;
            min-height: 60vh;
        }
        .error-code {
            font-family: var(--font-mono);
            font-size: 5rem;
            font-weight: 700;
            color: var(--secondary-color);
            line-height: 1;
            margin-bottom: .5rem;
        }
        .error-title {
            font-size: 1.4rem;
            color: var(--primary-color);
            margin-bottom: .75rem;
        }
        .error-text {
            color: var(--text-light);
            font-size: 14px;
            max-width: 420px;
            margin-bottom: 2rem;
        }
        body { display: flex; flex-direction: column; min-height: 100vh; }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">Portfolio</div>
            <div class="nav-right">
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="projets.php">Projets</a></li>
                <li><a href="../stages/stages.php">Stages</a></li>
                <li><a href="veille.php">Veille</a></li>
                <li><a href="certifications.php">Certifications</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <button class="theme-toggle" id="themeToggle" aria-label="Changer de thème" title="Changer de thème">
                <i class="fas fa-sun"></i>
                <i class="fas fa-moon"></i>
            </button>
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
            </div>
        </div>
    </nav>

    <div class="error-wrap">
        <div class="error-code">404</div>
        <h1 class="error-title">Page introuvable</h1>
        <p class="error-text">La page que tu cherches n'existe pas ou a été déplacée.</p>
        <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour à l'accueil</a>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Portfolio L3 MIAGE · Killian Narasson Mohamedaly</p>
        </div>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>
