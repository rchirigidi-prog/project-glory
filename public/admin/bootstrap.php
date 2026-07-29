<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
|--------------------------------------------------------------------------
| Project Root
|--------------------------------------------------------------------------
*/

define('ROOT_PATH', dirname(__DIR__, 2));

require_once ROOT_PATH . '/vendor/autoload.php';

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
define('ADMIN_COMPONENTS', ADMIN_ROOT . '/components');
define('ADMIN_ASSETS', '/admin/assets');