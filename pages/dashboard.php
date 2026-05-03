<?php
require_once __DIR__ . '/../config/supabase.php';

$rows = supabase_request('GET', '/rest/v1/certifications?order=ordre') ?? [];

$track_labels = [
    'dev'     => 'Dev',
    'secu'    => 'Sécu & Infra',
    'culture' => 'Culture & Méthodes',
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Portfolio Killian Narasson</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ── Layout ─────────────────────────────────────────── */
        .dash-header {
            background: var(--white);
            padding: 2.5rem 0 0;
        }
        .dash-masthead {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 1rem;
            padding-bottom: 1.25rem;
            border-bottom: 3px solid var(--secondary-color);
        }
        .dash-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }
        .dash-title i {
            color: var(--secondary-color);
            margin-right: .5rem;
            font-size: 1.6rem;
        }
        .dash-meta {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--text-light);
        }
        .dash-section { padding: 2.5rem 0 4rem; }

        /* ── Table ───────────────────────────────────────────── */
        .dash-table-wrap {
            background: var(--bg-light);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
        }
        .dash-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        .dash-table thead tr {
            background: var(--bg-surface);
            border-bottom: 2px solid var(--border-color);
        }
        .dash-table th {
            padding: .75rem 1.25rem;
            text-align: left;
            font-family: var(--font-mono);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--text-light);
            white-space: nowrap;
        }
        .dash-table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: background .15s;
        }
        .dash-table tbody tr:last-child { border-bottom: none; }
        .dash-table tbody tr:hover { background: var(--bg-surface); }
        .dash-table td {
            padding: .85rem 1.25rem;
            vertical-align: middle;
            color: var(--text-color);
        }

        /* feedback states */
        .dash-table tbody tr.row-saved {
            outline: 2px solid var(--accent2);
            outline-offset: -1px;
        }
        .dash-table tbody tr.row-error {
            outline: 2px solid #ef4444;
            outline-offset: -1px;
        }

        /* ── Cell: nom ───────────────────────────────────────── */
        .cell-nom {
            font-weight: 600;
            color: var(--primary-color);
            max-width: 280px;
        }

        /* ── Cell: track badge ───────────────────────────────── */
        .track-pill {
            display: inline-block;
            font-family: var(--font-mono);
            font-size: 9px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            white-space: nowrap;
        }
        .pill-dev     { background: rgba(14,165,233,.12); border: 1px solid rgba(14,165,233,.3); color: var(--secondary-color); }
        .pill-secu    { background: rgba(239,68,68,.1);   border: 1px solid rgba(239,68,68,.25); color: #ef4444; }
        .pill-culture { background: rgba(16,185,129,.1);  border: 1px solid rgba(16,185,129,.25); color: #10b981; }

        /* ── Cell: select ────────────────────────────────────── */
        .statut-select {
            appearance: none;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            color: var(--primary-color);
            font-family: var(--font-mono);
            font-size: 11px;
            padding: .35rem 2rem .35rem .6rem;
            cursor: pointer;
            transition: border-color .2s;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%238b949e'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right .55rem center;
        }
        .statut-select:focus {
            outline: none;
            border-color: var(--secondary-color);
        }
        .statut-select.val-obtenue { border-color: rgba(6,214,160,.4);  color: var(--accent2); }
        .statut-select.val-en_cours{ border-color: rgba(245,158,11,.4); color: var(--accent3); }
        .statut-select.val-prevu   { border-color: var(--border-color); color: var(--text-light); }

        /* ── Cell: range ─────────────────────────────────────── */
        .prog-wrap {
            display: flex;
            align-items: center;
            gap: .6rem;
            min-width: 160px;
        }
        .prog-range {
            flex: 1;
            appearance: none;
            height: 4px;
            border-radius: 2px;
            background: var(--border-color);
            outline: none;
            cursor: pointer;
        }
        .prog-range::-webkit-slider-thumb {
            appearance: none;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: var(--secondary-color);
            cursor: pointer;
            transition: transform .15s;
        }
        .prog-range::-webkit-slider-thumb:hover { transform: scale(1.25); }
        .prog-range::-moz-range-thumb {
            width: 14px;
            height: 14px;
            border: none;
            border-radius: 50%;
            background: var(--secondary-color);
            cursor: pointer;
        }
        .prog-val {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--text-light);
            min-width: 32px;
            text-align: right;
        }
        /* grise le range quand statut ≠ en_cours */
        .prog-range:disabled {
            opacity: .35;
            cursor: not-allowed;
        }
        .prog-range:disabled::-webkit-slider-thumb { cursor: not-allowed; }

        /* ── Cell: bouton ────────────────────────────────────── */
        .btn-save {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            font-family: var(--font-mono);
            font-size: 11px;
            font-weight: 700;
            padding: .4rem .9rem;
            border-radius: 6px;
            border: 1px solid var(--secondary-color);
            background: rgba(14,165,233,.1);
            color: var(--secondary-color);
            cursor: pointer;
            transition: background .2s, transform .1s;
            white-space: nowrap;
        }
        .btn-save:hover  { background: rgba(14,165,233,.2); }
        .btn-save:active { transform: scale(.96); }
        .btn-save:disabled { opacity: .5; cursor: not-allowed; }

        /* ── Responsive ──────────────────────────────────────── */
        @media (max-width: 768px) {
            .dash-table th:nth-child(2),
            .dash-table td:nth-child(2) { display: none; }
        }
        @media (max-width: 560px) {
            .dash-table { font-size: 12px; }
            .dash-table th, .dash-table td { padding: .65rem .75rem; }
            .prog-wrap { min-width: 120px; }
        }
    </style>
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
                <li><a href="certifications.php">Certifications</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="dashboard.php" class="active">Dashboard</a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- ─── Header ─── -->
    <header class="dash-header">
        <div class="container">
            <div class="dash-masthead">
                <h1 class="dash-title">
                    <i class="fas fa-sliders"></i>Dashboard certifications
                </h1>
                <span class="dash-meta"><?= count($rows) ?> formation<?= count($rows) > 1 ? 's' : '' ?> · mise à jour en temps réel</span>
            </div>
        </div>
    </header>

    <!-- ─── Content ─── -->
    <main class="dash-section">
        <div class="container">

<?php if (empty($rows)): ?>
            <p style="color:var(--text-light);font-family:var(--font-mono);font-size:13px;">
                Aucune certification trouvée. Vérifie la connexion Supabase ou exécute le SQL de seed.
            </p>
<?php else: ?>
            <div class="dash-table-wrap">
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Track</th>
                            <th>Formation</th>
                            <th>Statut</th>
                            <th>Progression</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
<?php foreach ($rows as $c):
    $id      = (int)$c['id'];
    $statut  = $c['statut'] ?? 'prevu';
    $prog    = (int)($c['progression'] ?? 0);
    $track   = $c['track'] ?? 'dev';
    $pill_cls= ['dev' => 'pill-dev', 'secu' => 'pill-secu', 'culture' => 'pill-culture'][$track] ?? 'pill-dev';
    $track_lbl = $track_labels[$track] ?? $track;
    $disabled  = ($statut !== 'en_cours') ? 'disabled' : '';
?>
                        <tr id="row-<?= $id ?>">
                            <td style="font-family:var(--font-mono);font-size:11px;color:var(--text-light);"><?= $id ?></td>
                            <td><span class="track-pill <?= $pill_cls ?>"><?= htmlspecialchars($track_lbl) ?></span></td>
                            <td class="cell-nom"><?= htmlspecialchars($c['nom'] ?? '') ?></td>
                            <td>
                                <select
                                    class="statut-select val-<?= $statut ?>"
                                    data-id="<?= $id ?>"
                                    onchange="onStatutChange(this)"
                                >
                                    <option value="obtenue"  <?= $statut === 'obtenue'  ? 'selected' : '' ?>>Obtenue</option>
                                    <option value="en_cours" <?= $statut === 'en_cours' ? 'selected' : '' ?>>En cours</option>
                                    <option value="prevu"    <?= $statut === 'prevu'    ? 'selected' : '' ?>>Prévu</option>
                                </select>
                            </td>
                            <td>
                                <div class="prog-wrap">
                                    <input
                                        type="range" min="0" max="100"
                                        value="<?= $prog ?>"
                                        class="prog-range"
                                        data-id="<?= $id ?>"
                                        <?= $disabled ?>
                                        oninput="onProgInput(this)"
                                    >
                                    <span class="prog-val" id="pct-<?= $id ?>"><?= $prog ?>%</span>
                                </div>
                            </td>
                            <td>
                                <button class="btn-save" onclick="save(<?= $id ?>)">
                                    <i class="fas fa-floppy-disk"></i> Sauvegarder
                                </button>
                            </td>
                        </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
<?php endif; ?>

        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Portfolio BTS SIO SLAM · Killian Narasson Mohamedaly</p>
        </div>
    </footer>

    <script src="../js/script.js"></script>
    <script>
    // ── Live % display ────────────────────────────────────────────────────────
    function onProgInput(range) {
        document.getElementById('pct-' + range.dataset.id).textContent = range.value + '%';
    }

    // ── Statut change → enable/disable range ─────────────────────────────────
    function onStatutChange(select) {
        const id    = select.dataset.id;
        const range = document.querySelector('.prog-range[data-id="' + id + '"]');
        const isProgress = select.value === 'en_cours';

        // update select color class
        select.className = 'statut-select val-' + select.value;

        // enable/disable range
        range.disabled = !isProgress;
        if (!isProgress) {
            const val = select.value === 'obtenue' ? 100 : 0;
            range.value = val;
            document.getElementById('pct-' + id).textContent = val + '%';
        }
    }

    // ── Save ──────────────────────────────────────────────────────────────────
    async function save(id) {
        const row    = document.getElementById('row-' + id);
        const select = row.querySelector('.statut-select');
        const range  = row.querySelector('.prog-range');
        const btn    = row.querySelector('.btn-save');

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi…';

        // auto-set progression to 100 if obtained, 0 if planned
        let progression = parseInt(range.value, 10);
        if (select.value === 'obtenue')  progression = 100;
        if (select.value === 'prevu')    progression = 0;

        try {
            const res = await fetch('../api/save_certif.php', {
                method:  'POST',
                headers: { 'Content-Type': 'application/json' },
                body:    JSON.stringify({ id, statut: select.value, progression }),
            });

            const json = await res.json();

            if (!res.ok || json.error) throw new Error(json.error ?? 'Erreur serveur');

            // sync display
            range.value = progression;
            document.getElementById('pct-' + id).textContent = progression + '%';

            flash(row, 'row-saved');
        } catch (err) {
            console.error(err);
            flash(row, 'row-error');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-floppy-disk"></i> Sauvegarder';
        }
    }

    // ── Visual feedback (green / red border 2 s) ──────────────────────────────
    function flash(row, cls) {
        row.classList.remove('row-saved', 'row-error');
        void row.offsetWidth;               // force reflow pour relancer l'animation
        row.classList.add(cls);
        setTimeout(() => row.classList.remove(cls), 2000);
    }
    </script>
</body>
</html>
