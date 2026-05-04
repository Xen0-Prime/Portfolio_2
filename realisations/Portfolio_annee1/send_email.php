<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: contact.html");
    exit;
}

$name    = htmlspecialchars(trim($_POST['name']    ?? ''));
$email   = htmlspecialchars(trim($_POST['email']   ?? ''));
$subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
$message = htmlspecialchars(trim($_POST['message'] ?? ''));

$to           = "killian.narasson-m@outlook.fr";
$email_subject = "Nouveau message portfolio : $subject";
$email_body    = "Nom : $name\nEmail : $email\n\nMessage :\n$message";
$headers       = "From: noreply@killiannarasson.alwaysdata.net\r\nReply-To: $email";

mail($to, $email_subject, $email_body, $headers);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message envoyé</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
<div class="portfolio-container" style="display:flex;align-items:center;justify-content:center;min-height:100vh;">
    <div style="text-align:center;padding:2rem;">
        <p style="font-size:3rem;">✅</p>
        <h2 style="color:#fff;margin-bottom:.75rem;">Message envoyé !</h2>
        <p style="color:#aaa;margin-bottom:1.5rem;">Merci <?= $name ?>, je vous répondrai bientôt.</p>
        <a href="contact.html" style="color:#4fc3f7;text-decoration:none;">← Retour</a>
    </div>
</div>
</body>
</html>
