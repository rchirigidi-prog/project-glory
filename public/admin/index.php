<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

use App\Services\AuthService;

$auth = new AuthService();

if ($auth->check()) {
    header('Location: dashboard.php');
    exit;
}

header('Location: login.php');
exit;