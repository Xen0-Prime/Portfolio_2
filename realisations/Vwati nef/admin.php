<?php
require_once 'db_config.php';

/* ══════════════════════════════════════════════
   KPIs — Chiffre d'affaires
══════════════════════════════════════════════ */
$stmt = $pdo->query("
    SELECT
        COALESCE(SUM(r.montant_total), 0)  AS ca_total,
        COUNT(*)                            AS nb_confirmees,
        COALESCE(AVG(r.montant_total), 0)  AS panier_moyen
    FROM RESERVATION r
    JOIN STATUT_RESERVATION s ON r.id_statut = s.id_statut
    WHERE s.libelle = 'confirmée'
");
$kpi_conf = $stmt->fetch();

$stmt = $pdo->query("
    SELECT
        COUNT(*)                            AS nb_annulees,
        COALESCE(SUM(r.montant_total), 0)  AS montant_annule
    FROM RESERVATION r
    JOIN STATUT_RESERVATION s ON r.id_statut = s.id_statut
    WHERE s.libelle = 'annulée'
");
$kpi_ann = $stmt->fetch();

$stmt = $pdo->query("SELECT COUNT(*) AS total FROM RESERVATION");
$total_res = $stmt->fetch()['total'];

/* ══════════════════════════════════════════════
   Détail de toutes les réservations (pour tab CA)
══════════════════════════════════════════════ */
$stmt = $pdo->query("
    SELECT
        r.id_reservation,
        CONCAT(cl.prenom, ' ', cl.nom)           AS client,
        CONCAT(m.nom_marque, ' ', v.modele)      AS vehicule,
        r.date_debut,
        r.date_fin,
        DATEDIFF(r.date_fin, r.date_debut)       AS nb_jours,
        r.montant_total,
        s.libelle                                 AS statut
    FROM RESERVATION r
    JOIN CLIENT cl              ON r.id_client  = cl.id_client
    JOIN VOITURE v              ON r.id_voiture = v.id_voiture
    JOIN MARQUE m               ON v.id_marque  = m.id_marque
    JOIN STATUT_RESERVATION s   ON r.id_statut  = s.id_statut
    ORDER BY r.id_reservation
");
$reservations_ca = $stmt->fetchAll();

/* ══════════════════════════════════════════════
   Véhicules
══════════════════════════════════════════════ */
$stmt = $pdo->query("
    SELECT
        v.id_voiture,
        m.nom_marque,
        v.modele,
        v.annee,
        v.cylindree,
        v.puissance_ch,
        c.type_carburant,
        v.prix_journalier,
        v.disponible
    FROM VOITURE v
    JOIN MARQUE   m ON v.id_marque    = m.id_marque
    JOIN CARBURANT c ON v.id_carburant = c.id_carburant
    ORDER BY m.nom_marque, v.modele
");
$vehicules = $stmt->fetchAll();

/* ══════════════════════════════════════════════
   Réservations (onglet complet)
══════════════════════════════════════════════ */
$stmt = $pdo->query("
    SELECT
        r.id_reservation,
        CONCAT(cl.prenom, ' ', cl.nom)           AS client,
        CONCAT(m.nom_marque, ' ', v.modele)      AS vehicule,
        r.date_debut,
        r.date_fin,
        r.montant_total,
        s.libelle                                 AS statut
    FROM RESERVATION r
    JOIN CLIENT cl              ON r.id_client  = cl.id_client
    JOIN VOITURE v              ON r.id_voiture = v.id_voiture
    JOIN MARQUE m               ON v.id_marque  = m.id_marque
    JOIN STATUT_RESERVATION s   ON r.id_statut  = s.id_statut
    ORDER BY r.id_reservation
");
$reservations = $stmt->fetchAll();

/* ══════════════════════════════════════════════
   Marques & clients pour les selects des modals
══════════════════════════════════════════════ */
$marques  = $pdo->query("SELECT id_marque, nom_marque FROM MARQUE ORDER BY nom_marque")->fetchAll();
$clients  = $pdo->query("SELECT id_client, CONCAT(prenom,' ',nom) AS nom_complet FROM CLIENT ORDER BY nom")->fetchAll();
$carbs    = $pdo->query("SELECT id_carburant, type_carburant FROM CARBURANT")->fetchAll();
$statuts  = $pdo->query("SELECT id_statut, libelle FROM STATUT_RESERVATION")->fetchAll();
$veh_list = $pdo->query("SELECT v.id_voiture, CONCAT(m.nom_marque,' ',v.modele) AS label FROM VOITURE v JOIN MARQUE m ON v.id_marque=m.id_marque ORDER BY m.nom_marque, v.modele")->fetchAll();

/* ══════════════════════════════════════════════
   Logs
══════════════════════════════════════════════ */
$stmt = $pdo->query("
    SELECT
        l.id_log,
        l.id_reservation,
        CONCAT(cl.prenom, ' ', cl.nom)  AS client,
        l.action,
        l.champ_modifie,
        l.ancienne_valeur,
        l.nouvelle_valeur,
        l.date_action,
        l.utilisateur
    FROM LOGS_RESERVATION l
    JOIN RESERVATION r  ON l.id_reservation = r.id_reservation
    JOIN CLIENT cl      ON r.id_client      = cl.id_client
    ORDER BY l.date_action DESC
");
$logs = $stmt->fetchAll();

/* ── helpers ── */
function fmt_money(float $v): string {
    return number_format($v, 2, ',', ' ') . ' €';
}
function fmt_date(string $d): string {
    return date('d/m/Y', strtotime($d));
}
function fmt_datetime(string $d): string {
    return date('d/m/Y H:i', strtotime($d));
}
function badge(string $statut): string {
    $cls = match($statut) {
        'confirmée'  => 'confirmée',
        'annulée'    => 'annulée',
        'en attente' => 'attente',
        'terminée'   => 'terminée',
        default      => 'attente',
    };
    return '<span class="badge ' . $cls . '">' . htmlspecialchars(ucfirst($statut)) . '</span>';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voiti Nèf — Administration</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            background: #f4f4f4;
            color: #1e293b;
        }

        /* ── HEADER ── */
        header {
            background-color: #800020;
            height: 100px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
        header img.logo {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
        header h1 {
            color: white;
            font-size: 22px;
            margin-left: 16px;
            flex: 1;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 8px 14px;
            font-size: 15px;
            transition: opacity .2s;
        }
        nav a:hover { opacity: .75; }
        nav a.active {
            border-bottom: 3px solid white;
            font-weight: 700;
        }

        /* ── LAYOUT ── */
        .wrapper {
            margin-top: 130px;
            padding: 24px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ── ONGLETS ── */
        .tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
        .tab-btn {
            background: white;
            border: 2px solid #800020;
            color: #800020;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }
        .tab-btn:hover, .tab-btn.active {
            background: #800020;
            color: white;
        }

        /* ── SECTIONS ── */
        .section { display: none; }
        .section.active { display: block; }

        /* ── CARDS KPI ── */
        .kpi-row {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
        .kpi-card {
            background: white;
            border-radius: 10px;
            padding: 20px 24px;
            flex: 1;
            min-width: 180px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-left: 5px solid #800020;
        }
        .kpi-card .label { font-size: 12px; color: #64748b; text-transform: uppercase; font-weight: 700; letter-spacing: .5px; }
        .kpi-card .value { font-size: 28px; font-weight: 700; color: #800020; margin-top: 6px; }
        .kpi-card .sub   { font-size: 12px; color: #94a3b8; margin-top: 4px; }

        /* ── TABLEAUX ── */
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 24px;
        }
        .card-header {
            background: #800020;
            color: white;
            padding: 14px 20px;
            font-size: 15px;
            font-weight: 700;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-body { padding: 0; overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        thead th {
            background: #f8fafc;
            color: #475569;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
            padding: 10px 14px;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
        }
        tbody tr { border-bottom: 1px solid #f1f5f9; transition: background .15s; }
        tbody tr:hover { background: #fef2f2; }
        tbody td { padding: 10px 14px; }

        /* ── BADGES STATUT ── */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }
        .badge.confirmée { background: #dcfce7; color: #166534; }
        .badge.annulée   { background: #fee2e2; color: #991b1b; }
        .badge.attente   { background: #fef3c7; color: #92400e; }
        .badge.terminée  { background: #e0e7ff; color: #3730a3; }

        /* ── BOUTON AJOUT ── */
        .btn {
            background: white;
            border: 2px solid white;
            color: #800020;
            padding: 7px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
        }
        .btn:hover { background: #800020; color: white; border-color: #800020; }

        /* ── FORMULAIRE MODAL ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 200;
            justify-content: center;
            align-items: center;
        }
        .modal-overlay.open { display: flex; }
        .modal {
            background: white;
            border-radius: 12px;
            padding: 28px;
            width: 480px;
            max-width: 95vw;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        }
        .modal h2 { font-size: 17px; color: #800020; margin-bottom: 18px; }
        .form-group { margin-bottom: 14px; }
        .form-group label { display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 5px; }
        .form-group input, .form-group select {
            width: 100%;
            padding: 9px 12px;
            border: 1.5px solid #e2e8f0;
            border-radius: 6px;
            font-size: 13px;
            outline: none;
            transition: border-color .2s;
        }
        .form-group input:focus, .form-group select:focus { border-color: #800020; }
        .form-row { display: flex; gap: 12px; }
        .form-row .form-group { flex: 1; }
        .modal-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
        .btn-cancel { background: #f1f5f9; border: none; color: #475569; padding: 9px 18px; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 600; }
        .btn-save { background: #800020; border: none; color: white; padding: 9px 18px; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 600; }

        /* ── LOG PILL ── */
        .log-action {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
            background: #e0e7ff;
            color: #3730a3;
        }

        /* ── DISPO TOGGLE ── */
        .dispo   { color: #166534; font-weight: 700; }
        .indispo { color: #991b1b; font-weight: 700; }

        /* ── FOOTER ── */
        footer {
            background: #800020;
            color: white;
            text-align: center;
            padding: 16px;
            font-size: 13px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header>
    <img src="ressources%20voiti%20nef/logo.png" alt="Logo Voiti Nèf" class="logo">
    <h1>Administration — Voiti Nèf</h1>
    <nav>
        <a href="Accueil.php">Accueil</a>
        <a href="nosVoitures.php">Nos voitures</a>
        <a href="aPropos.php">À propos</a>
        <a href="admin.php" class="active">Admin</a>
        <a href="avis.html">Avis</a>
    </nav>
</header>

<div class="wrapper">

    <!-- ONGLETS -->
    <div class="tabs">
        <button class="tab-btn active" onclick="showTab('ca', this)">📊 Chiffre d'affaires</button>
        <button class="tab-btn" onclick="showTab('vehicules', this)">🚗 Véhicules</button>
        <button class="tab-btn" onclick="showTab('reservations', this)">📋 Réservations</button>
        <button class="tab-btn" onclick="showTab('logs', this)">🗂️ Logs</button>
    </div>

    <!-- ══════════════════════════════════
         SECTION 1 : CHIFFRE D'AFFAIRES
    ═══════════════════════════════════ -->
    <div id="tab-ca" class="section active">

        <div class="kpi-row">
            <div class="kpi-card">
                <div class="label">CA Total confirmé</div>
                <div class="value"><?= fmt_money((float)$kpi_conf['ca_total']) ?></div>
                <div class="sub">Réservations confirmées</div>
            </div>
            <div class="kpi-card">
                <div class="label">Réservations confirmées</div>
                <div class="value"><?= (int)$kpi_conf['nb_confirmees'] ?></div>
                <div class="sub">sur <?= $total_res ?> réservation<?= $total_res > 1 ? 's' : '' ?></div>
            </div>
            <div class="kpi-card">
                <div class="label">Panier moyen</div>
                <div class="value"><?= fmt_money((float)$kpi_conf['panier_moyen']) ?></div>
                <div class="sub">par réservation confirmée</div>
            </div>
            <div class="kpi-card">
                <div class="label">Réservations annulées</div>
                <div class="value" style="color:#991b1b"><?= (int)$kpi_ann['nb_annulees'] ?></div>
                <div class="sub">Montant perdu : <?= fmt_money((float)$kpi_ann['montant_annule']) ?></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Détail de toutes les réservations</div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Véhicule</th>
                            <th>Du</th>
                            <th>Au</th>
                            <th>Jours</th>
                            <th>Montant</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations_ca as $r): ?>
                        <tr>
                            <td><?= $r['id_reservation'] ?></td>
                            <td><?= htmlspecialchars($r['client']) ?></td>
                            <td><?= htmlspecialchars($r['vehicule']) ?></td>
                            <td><?= fmt_date($r['date_debut']) ?></td>
                            <td><?= fmt_date($r['date_fin']) ?></td>
                            <td><?= max(0, (int)$r['nb_jours']) ?></td>
                            <td><strong><?= fmt_money((float)$r['montant_total']) ?></strong></td>
                            <td><?= badge($r['statut']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr style="background:#fef2f2;">
                            <td colspan="6" style="padding:10px 14px; font-weight:700; color:#800020;">TOTAL CA CONFIRMÉ</td>
                            <td style="padding:10px 14px; font-weight:700; font-size:16px; color:#800020;"><?= fmt_money((float)$kpi_conf['ca_total']) ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════
         SECTION 2 : VÉHICULES
    ═══════════════════════════════════ -->
    <div id="tab-vehicules" class="section">
        <div class="card">
            <div class="card-header">
                Gestion des véhicules (<?= count($vehicules) ?>)
                <button class="btn" onclick="openModal('modal-vehicule')">+ Ajouter un véhicule</button>
            </div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Marque</th>
                            <th>Modèle</th>
                            <th>Année</th>
                            <th>Cylindrée</th>
                            <th>Puissance</th>
                            <th>Carburant</th>
                            <th>Prix/jour</th>
                            <th>Disponible</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicules as $v): ?>
                        <tr>
                            <td><?= $v['id_voiture'] ?></td>
                            <td><?= htmlspecialchars($v['nom_marque']) ?></td>
                            <td><?= htmlspecialchars($v['modele']) ?></td>
                            <td><?= $v['annee'] ?></td>
                            <td><?= htmlspecialchars($v['cylindree'] ?? '—') ?></td>
                            <td><?= $v['puissance_ch'] ? $v['puissance_ch'] . ' ch' : '—' ?></td>
                            <td><?= htmlspecialchars($v['type_carburant']) ?></td>
                            <td><?= fmt_money((float)$v['prix_journalier']) ?></td>
                            <td class="<?= $v['disponible'] ? 'dispo' : 'indispo' ?>">
                                <?= $v['disponible'] ? '✔ Oui' : '✘ Non' ?>
                            </td>
                            <td>
                                <button class="btn-save" style="padding:4px 10px;font-size:12px;border-radius:4px;border:none;cursor:pointer;"
                                    onclick="openModal('modal-vehicule')">Modifier</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════
         SECTION 3 : RÉSERVATIONS
    ═══════════════════════════════════ -->
    <div id="tab-reservations" class="section">
        <div class="card">
            <div class="card-header">
                Gestion des réservations (<?= count($reservations) ?>)
                <button class="btn" onclick="openModal('modal-reservation')">+ Nouvelle réservation</button>
            </div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Véhicule</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $r): ?>
                        <tr>
                            <td><?= $r['id_reservation'] ?></td>
                            <td><?= htmlspecialchars($r['client']) ?></td>
                            <td><?= htmlspecialchars($r['vehicule']) ?></td>
                            <td><?= fmt_date($r['date_debut']) ?></td>
                            <td><?= fmt_date($r['date_fin']) ?></td>
                            <td><?= fmt_money((float)$r['montant_total']) ?></td>
                            <td><?= badge($r['statut']) ?></td>
                            <td>
                                <button class="btn-save" style="padding:4px 10px;font-size:12px;border-radius:4px;border:none;cursor:pointer;"
                                    onclick="openModal('modal-reservation')">Modifier</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════
         SECTION 4 : LOGS
    ═══════════════════════════════════ -->
    <div id="tab-logs" class="section">
        <div class="card">
            <div class="card-header">Historique des modifications — Réservations (<?= count($logs) ?> entrée<?= count($logs) > 1 ? 's' : '' ?>)</div>
            <div class="card-body">
                <?php if (empty($logs)): ?>
                <p style="padding:20px;color:#64748b;">Aucun log enregistré.</p>
                <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Réservation</th>
                            <th>Action</th>
                            <th>Champ modifié</th>
                            <th>Ancienne valeur</th>
                            <th>Nouvelle valeur</th>
                            <th>Date</th>
                            <th>Utilisateur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $l): ?>
                        <tr>
                            <td><?= $l['id_log'] ?></td>
                            <td>#<?= $l['id_reservation'] ?> — <?= htmlspecialchars($l['client']) ?></td>
                            <td><span class="log-action"><?= htmlspecialchars($l['action']) ?></span></td>
                            <td><?= htmlspecialchars($l['champ_modifie'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($l['ancienne_valeur'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($l['nouvelle_valeur'] ?? '—') ?></td>
                            <td><?= fmt_datetime($l['date_action']) ?></td>
                            <td><?= htmlspecialchars($l['utilisateur']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div><!-- /wrapper -->

<!-- ══════════════════════════════════
     MODAL : VÉHICULE
═══════════════════════════════════ -->
<div class="modal-overlay" id="modal-vehicule">
    <div class="modal">
        <h2>🚗 Ajouter / Modifier un véhicule</h2>
        <div class="form-row">
            <div class="form-group">
                <label>Marque</label>
                <select>
                    <?php foreach ($marques as $m): ?>
                    <option value="<?= $m['id_marque'] ?>"><?= htmlspecialchars($m['nom_marque']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Modèle</label>
                <input type="text" placeholder="ex : A3">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Année</label>
                <input type="number" value="2024" min="2000" max="2030">
            </div>
            <div class="form-group">
                <label>Cylindrée</label>
                <input type="text" placeholder="ex : 1.5L">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Puissance (ch)</label>
                <input type="number" placeholder="ex : 110">
            </div>
            <div class="form-group">
                <label>Carburant</label>
                <select>
                    <?php foreach ($carbs as $c): ?>
                    <option value="<?= $c['id_carburant'] ?>"><?= htmlspecialchars($c['type_carburant']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Prix / jour (€)</label>
                <input type="number" placeholder="ex : 75" step="0.01">
            </div>
            <div class="form-group">
                <label>Disponible</label>
                <select>
                    <option value="1">Oui</option>
                    <option value="0">Non</option>
                </select>
            </div>
        </div>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeModal('modal-vehicule')">Annuler</button>
            <button class="btn-save">Enregistrer</button>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════
     MODAL : RÉSERVATION
═══════════════════════════════════ -->
<div class="modal-overlay" id="modal-reservation">
    <div class="modal">
        <h2>📋 Modifier la réservation</h2>
        <div class="form-row">
            <div class="form-group">
                <label>Client</label>
                <select>
                    <?php foreach ($clients as $cl): ?>
                    <option value="<?= $cl['id_client'] ?>"><?= htmlspecialchars($cl['nom_complet']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Véhicule</label>
                <select>
                    <?php foreach ($veh_list as $vl): ?>
                    <option value="<?= $vl['id_voiture'] ?>"><?= htmlspecialchars($vl['label']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Date début</label>
                <input type="date">
            </div>
            <div class="form-group">
                <label>Date fin</label>
                <input type="date">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Montant total (€)</label>
                <input type="number" placeholder="ex : 250.00" step="0.01">
            </div>
            <div class="form-group">
                <label>Statut</label>
                <select>
                    <?php foreach ($statuts as $s): ?>
                    <option value="<?= $s['id_statut'] ?>"><?= htmlspecialchars(ucfirst($s['libelle'])) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeModal('modal-reservation')">Annuler</button>
            <button class="btn-save">Enregistrer</button>
        </div>
    </div>
</div>

<footer>
    <p>© 2024 Voiti Nèf — Administration · Tous droits réservés</p>
</footer>

<script>
    function showTab(name, btn) {
        document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.getElementById('tab-' + name).classList.add('active');
        btn.classList.add('active');
    }

    function openModal(id) {
        document.getElementById(id).classList.add('open');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
    }

    // Fermer modal en cliquant à l'extérieur
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('open');
        });
    });
</script>

</body>
</html>
