<?php
/* ── Composant navbar — inclure avec $current_page et $nav_title définis avant ── */
$current_page = $current_page ?? '';
$nav_title    = $nav_title    ?? 'Voiti Nèf';
?>
<header>
    <img src="ressources%20voiti%20nef/logo.png" alt="Logo Voiti Nèf" class="logo">
    <span class="site-title"><?= htmlspecialchars($nav_title) ?></span>
    <nav class="main-nav">
        <a href="Accueil.php"     <?= $current_page === 'accueil'   ? 'class="active"' : '' ?>>Accueil</a>
        <a href="nosVoitures.php" <?= $current_page === 'voitures'  ? 'class="active"' : '' ?>>Nos voitures</a>
        <a href="aPropos.php"     <?= $current_page === 'apropos'   ? 'class="active"' : '' ?>>À propos</a>
        <a href="admin.php"       <?= $current_page === 'admin'     ? 'class="active"' : '' ?>>Admin</a>
    </nav>
</header>
