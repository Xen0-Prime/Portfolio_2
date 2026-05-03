<?php
require_once __DIR__ . '/../config/auth.php';
auth_session_start();
auth_logout();
header('Location: login.php');
exit;
