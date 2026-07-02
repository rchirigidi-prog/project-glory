<?php

// ==========================================
// SingThyGlory Studio Configuration
// ==========================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Asia/Kolkata');

// ==========================================
// Application Information
// ==========================================

define('SITE_NAME', 'SingThyGlory Studio');
define('SITE_VERSION', '1.0');
define('ADMIN_EMAIL', 'cloudpeak.pune@gmail.com');

// ==========================================
// URLs
// ==========================================

// Root URL
define('BASE_URL', '');

// Admin URL
define('ADMIN_URL', '/admin');

// Shared Assets
define('ASSET_URL', '/assets');

// Uploads
define('UPLOAD_URL', '/uploads');

// ==========================================
// Storage
// ==========================================

define('STORAGE_PATH', __DIR__ . '/../storage');

// ==========================================
// Authentication
// ==========================================

define('LOGIN_SESSION', 'stg_admin');

// ==========================================
// Development
// ==========================================

error_reporting(E_ALL);
ini_set('display_errors', 1);

// ==========================================
// Database
// ==========================================

$config = require __DIR__ . '/../../../config/database.php';

$host     = $config['host'];
$database = $config['database'];
$username = $config['username'];
$password = $config['password'];
$charset  = $config['charset'];