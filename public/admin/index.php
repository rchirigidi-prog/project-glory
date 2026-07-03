<?php

require_once __DIR__ . '/bootstrap.php';

/*
|--------------------------------------------------------------------------
| Admin Entry Point
|--------------------------------------------------------------------------
*/

if (isset($_SESSION['stg_admin'])) {
    header('Location: dashboard.php');
    exit;
}

header('Location: login.php');
exit;