<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Middleware\AuthMiddleware;

AuthMiddleware::handle();

/*
|--------------------------------------------------------------------------
| Admin Constants
|--------------------------------------------------------------------------
*/

define('ADMIN_ROOT', __DIR__);
define('ADMIN_INCLUDES', ADMIN_ROOT . '/includes');
define('ADMIN_MODULES', ADMIN_ROOT . '/modules');
define('ADMIN_LAYOUTS', ADMIN_ROOT . '/layouts');
define('ADMIN_ASSETS', '/admin/assets');
