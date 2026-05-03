<?php
require_once __DIR__ . '/../config/supabase.php';

// ── Fetch all certifications ordered by 'ordre' ─────────────────────────────
$rows = supabase_request('GET', '/rest/v1/certifications?order=ordre') ?? [];

// ── Track definitions (order matters for rendering) ──────────────────────────
$tracks_def = [
    'dev'     => ['label' => 'Dev track',              'icon' => 'fa-code',           'css' => 'tc-dev'],
    'secu'    => ['label' => 'Sécu &amp; Infra track', 'icon' => 'fa-shield-halved',  'css' => 'tc-secu'],
    'culture' => ['label' => 'Culture &amp; Méthodes', 'icon' => 'fa-brain',          'css' => 'tc-culture'],
];

$tracks = [];
foreach ($tracks_def as $key => $def) {
    $tracks[$key] = $def + ['items' => [], 'count' => 0, 'heures' => 0, 'progress' => 0, 'badge' => 'Prévu'];
}

foreach ($rows as $row) {
    $t = $row['track'] ?? 'dev';
    if (isset($tracks[$t])) {
        $tracks[$t]['items'][] = $row;
    }
}

// ── Per-track computed stats ─────────────────────────────────────────────────
foreach ($tracks as $key => &$track) {
    $items  = $track['items'];
    $n      = count($items);
    $track['count']  = $n;
    $track['heures'] = (int)array_sum(array_column($items, 'heures'));

    if ($n === 0) {
        $track['progress'] = 0;
        $track['badge']    = 'Prévu';
        continue;
    }

    // progress = average across all items (obtained counts as 100 %)
    $sum = 0;
    foreach ($items as $item) {
        $sum += ($item['statut'] === 'obtenue') ? 100 : (int)$item['progression'];
    }
    $track['progress'] = (int)round($sum / $n);

    // badge
    $statuts = array_column($items, 'statut');
    if (!in_array('en_cours', $statuts, true) && !in_array('prevu', $statuts, true)) {
        $track['badge'] = 'Terminé';
    } elseif (in_array('en_cours', $statuts, true)) {
        $track['badge'] = 'En cours';
    } else {
        $track['badge'] = 'Prévu';
    }
}
unset($track);

// ── Global stats ─────────────────────────────────────────────────────────────
$total_count  = count($rows);
$total_heures = (int)array_sum(array_column($rows, 'heures'));

// hours remaining = heures of non-obtained certifications
$heures_restantes = 0;
foreach ($rows as $r) {
    if ($r['statut'] !== 'obtenue') {
        $heures_restantes += (int)$r['heures'];
    }
}

// ── Tag helper ───────────────────────────────────────────────────────────────
function get_tags(array $c): array
{
    $tags = [];
    $nom  = mb_strtolower($c['nom'] ?? '');

    if (str_contains($nom, 'intelligence artificielle')
        || str_contains($nom, 'vibe coding')
        || str_contains($nom, 'agents ia')
        || (str_contains($nom, ' ia ') || str_ends_with($nom, ' ia'))) {
        $tags[] = ['cls' => 'ci-tag-ai', 'lbl' => 'IA'];
    }

    switch ($c['track'] ?? '') {
        case 'dev':     $tags[] = ['cls' => 'ci-tag-b3',      'lbl' => 'B3 Dev'];   break;
        case 'secu':    $tags[] = ['cls' => 'ci-tag-b5',      'lbl' => 'B5 Infra']; break;
        case 'culture': $tags[] = ['cls' => 'ci-tag-culture', 'lbl' => 'Méthodes']; break;
    }

    return $tags;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certifications — Portfolio BTS SIO SLAM · Killian Narasson</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/certifications.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">Portfolio</div>
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="projets.php">Projets</a></li>
                <li><a href="../stages/stages.php">Stages</a></li>
                <li><a href="veille.php">Veille</a></li>
                <li><a href="certifications.php" class="active">Certifications</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- ─── Header masthead ─── -->
    <header class="certif-header">
        <div class="container">
            <div class="certif-masthead">
                <h1 class="certif-title">Certifications</h1>
                <div class="certif-meta">
                    <span class="meta-tag">BTS SIO SLAM</span>
                    <?= $total_count ?> formations · <?= count($tracks_def) ?> tracks · 2025–2026
                </div>
            </div>
        </div>
    </header>

    <!-- ─── Main content ─── -->
    <main class="certif-section">
        <div class="container">

            <!-- ─── Stats row ─── -->
            <div class="certif-stats">
                <div class="certif-stat-card">
                    <div class="stat-num"><?= $total_count ?></div>
                    <div class="stat-lbl">Formations</div>
                </div>
                <div class="certif-stat-card">
                    <div class="stat-num">~<?= $heures_restantes ?>h</div>
                    <div class="stat-lbl">Restantes</div>
                </div>
                <div class="certif-stat-card">
                    <div class="stat-num">Juin 2026</div>
                    <div class="stat-lbl">Objectif</div>
                </div>
            </div>

            <!-- ─── Tracks grid ─── -->
            <div class="tracks-grid">

<?php foreach ($tracks as $track_key => $track): ?>
                <!-- ═══ <?= htmlspecialchars($track['label']) ?> ═══ -->
                <div class="track-card <?= $track['css'] ?>">
                    <div class="track-head">
                        <div class="track-head-top">
                            <div>
                                <h2 class="track-name">
                                    <i class="fas <?= $track['icon'] ?>"></i><?= $track['label'] ?>
                                </h2>
                                <span class="track-count">
                                    <?= $track['count'] ?> formation<?= $track['count'] > 1 ? 's' : '' ?> · ~<?= $track['heures'] ?>h
                                </span>
                            </div>
                            <span class="track-badge"><?= htmlspecialchars($track['badge']) ?></span>
                        </div>
                        <div class="track-progress-wrap">
                            <div class="track-progress-bar">
                                <div class="track-progress-fill" style="width: <?= $track['progress'] ?>%;"></div>
                            </div>
                            <span class="track-progress-pct">~<?= $track['progress'] ?>%</span>
                        </div>
                    </div>

<?php foreach ($track['items'] as $c):
    $statut  = $c['statut'] ?? 'prevu';
    $dot_cls = ['obtenue' => 'dot-obtained', 'en_cours' => 'dot-progress', 'prevu' => 'dot-planned'][$statut] ?? 'dot-planned';
    $sp_cls  = ['obtenue' => 'sp-obtained',  'en_cours' => 'sp-progress',  'prevu' => 'sp-planned'][$statut]  ?? 'sp-planned';
    $sp_lbl  = ['obtenue' => 'Obtenue',      'en_cours' => 'En cours',     'prevu' => 'Prévu'][$statut]       ?? 'Prévu';
    $prog    = (int)($c['progression'] ?? 0);
    $heures  = (int)($c['heures'] ?? 0);
    $tags    = get_tags($c);
?>
                    <div class="certif-item">
                        <div class="ci-dot <?= $dot_cls ?>"></div>
                        <div class="ci-content">
                            <div class="ci-name"><?= htmlspecialchars($c['nom'] ?? '') ?></div>
                            <div class="ci-issuer">
                                <?= htmlspecialchars($c['emetteur'] ?? '') ?><?= $heures > 0 ? ' · ~' . $heures . 'h' : '' ?>
                            </div>
<?php if ($statut === 'en_cours'): ?>
                            <div class="ci-progress-wrap">
                                <div class="ci-progress-bar">
                                    <div class="ci-progress-fill" style="width: <?= $prog ?>%;"></div>
                                </div>
                                <span class="ci-pct"><?= $prog ?>%</span>
                            </div>
<?php endif; ?>
<?php if (!empty($tags)): ?>
                            <div class="ci-tags" style="margin-top:.3rem;">
<?php foreach ($tags as $tag): ?>
                                <span class="ci-tag <?= $tag['cls'] ?>"><?= $tag['lbl'] ?></span>
<?php endforeach; ?>
                            </div>
<?php endif; ?>
                        </div>
                        <span class="ci-status <?= $sp_cls ?>"><?= $sp_lbl ?></span>
                    </div>

<?php endforeach; ?>
                </div><!-- /<?= $track['css'] ?> -->

<?php endforeach; ?>
            </div><!-- /tracks-grid -->

        </div><!-- /container -->
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Portfolio BTS SIO SLAM · Killian Narasson Mohamedaly</p>
        </div>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>
