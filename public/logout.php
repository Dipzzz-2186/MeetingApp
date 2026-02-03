<?php
require_once __DIR__ . '/../app/helpers/auth.php';

session_destroy();
header('Location: login');
exit;
