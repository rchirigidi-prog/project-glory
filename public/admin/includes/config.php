<?php

// ==========================================
// SingThyGlory CMS Configuration
// ==========================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Asia/Kolkata');

// Website Information
define('SITE_NAME', 'SingThyGlory CMS');
define('SITE_VERSION', '1.0');
define('ADMIN_EMAIL', 'cloudpeak.pune@gmail.com');

// Website URL
define('BASE_URL', '/admin');

// Assets
define('ASSET_URL', BASE_URL . '/assets');

// Storage
define('STORAGE_PATH', __DIR__ . '/../storage');

// Authentication
define('LOGIN_SESSION', 'stg_admin');

// Development
error_reporting(E_ALL);
ini_set('display_errors', 1);



// Database Configuration
$config = require __DIR__ . '/../../../config/database.php';

$host     = $config['host'];
$database = $config['database'];
$username = $config['username'];
$password = $config['password'];
$charset  = $config['charset'];

?>