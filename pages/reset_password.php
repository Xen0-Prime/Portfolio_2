<?php
require_once __DIR__ . '/../config/auth.php';
auth_session_start();

$error   = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token    = $_POST['token']    ?? '';
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm']  ?? '';

    if (!hash_equals(RESET_TOKEN, $token)) {
        $error = 'Token incorrect.';
    } elseif (strlen($password) < 8) {
        $error = 'Le mot de passe doit faire au moins 8 caractères.';
    } elseif ($password !== $confirm) {
        $error = 'Les mots de passe ne correspondent pas.';
    } else {
        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        if (file_put_contents(HASH_FILE, $hash) !== false) {
            $success = true;
        } else {
            $error = 'Impossible d\'écrire le fichier hash. Vérifie les permissions.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset mot de passe · Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body { display:flex; align-items:center; justify-content:center; min-height:100vh; background:var(--bg-dark,#0d1117); }
        .reset-card {
            background: var(--bg-light, #161b22);
            border: 1px solid var(--border-color, #30363d);
            border-radius: 12px;
            padding: 2rem 2.5rem;
            width: 100%;
            max-width: 420px;
        }
        .reset-card h1 { font-size:1.25rem; color:var(--primary-color,#e6edf3); margin:0 0 1.5rem; }
        .form-group { margin-bottom:1rem; }
        .form-group label { display:block; font-size:12px; color:var(--text-light,#8b949e); margin-bottom:.4rem; font-family:monospace; text-transform:uppercase; letter-spacing:.05em; }
        .form-group input {
            width:100%; box-sizing:border-box;
            background:var(--bg-surface,#0d1117);
            border:1px solid var(--border-color,#30363d);
            border-radius:8px; padding:.6rem .85rem;
            color:var(--primary-color,#e6edf3); font-size:14px;
        }
        .form-group input:focus { outline:none; border-color:var(--secondary-color,#0ea5e9); }
        .btn-submit {
            width:100%; padding:.75rem; border-radius:8px; border:none; cursor:pointer;
            background:var(--secondary-color,#0ea5e9); color:#fff; font-size:14px; font-weight:600;
            margin-top:.5rem;
        }
        .btn-submit:hover { background:#0284c7; }
        .alert { padding:.75rem 1rem; border-radius:8px; font-size:13px; margin-bottom:1rem; }
        .alert-error   { background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); color:#f87171; }
        .alert-success { background:rgba(6,214,160,.1); border:1px solid rgba(6,214,160,.3); color:#06d6a0; }
        .back-link { display:block; text-align:center; margin-top:1rem; font-size:12px; color:var(--text-light,#8b949e); text-decoration:none; }
        .back-link:hover { color:var(--secondary-color,#0ea5e9); }
    </style>
</head>
<body>
<div class="reset-card">
    <h1>🔑 Reset mot de passe</h1>

    <?php if ($success): ?>
        <div class="alert alert-success">
            ✅ Mot de passe mis à jour. Tu peux maintenant te connecter.
        </div>
        <a href="login.php" class="back-link">← Aller à la connexion</a>
    <?php else: ?>
        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Token secret</label>
                <input type="password" name="token" placeholder="Token de reset" required autofocus>
            </div>
            <div class="form-group">
                <label>Nouveau mot de passe</label>
                <input type="password" name="password" placeholder="8 caractères minimum" required>
            </div>
            <div class="form-group">
                <label>Confirmer le mot de passe</label>
                <input type="password" name="confirm" placeholder="Répète le mot de passe" required>
            </div>
            <button type="submit" class="btn-submit">Réinitialiser</button>
        </form>
        <a href="login.php" class="back-link">← Retour à la connexion</a>
    <?php endif; ?>
</div>
</body>
</html>
