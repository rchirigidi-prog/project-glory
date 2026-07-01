<?php

// ==========================================
// SingThyGlory CMS Configuration
// ==========================================

session_start();

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

?>
