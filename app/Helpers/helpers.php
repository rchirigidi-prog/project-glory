<?php

/**
 * ----------------------------------------------------------
 * SingThyGlory Studio
 * Global Helper Functions
 * ----------------------------------------------------------
 */

if (!function_exists('config')) {

    function config(string $key = null)
    {
        static $config = null;

        if ($config === null) {
            $config = require __DIR__ . '/../../config/app.php';
        }

        if ($key === null) {
            return $config;
        }

        return $config[$key] ?? null;
    }
}

if (!function_exists('asset')) {

    function asset(string $path = ''): string
    {
        return rtrim(config('asset_url'), '/') . '/' . ltrim($path, '/');
    }
}

if (!function_exists('url')) {

    function url(string $path = ''): string
    {
        return rtrim(config('base_url'), '/') . '/' . ltrim($path, '/');
    }
}

if (!function_exists('admin_url')) {

    function admin_url(string $path = ''): string
    {
        return rtrim(config('admin_url'), '/') . '/' . ltrim($path, '/');
    }
}

if (!function_exists('upload_url')) {

    function upload_url(string $path = ''): string
    {
        return rtrim(config('upload_url'), '/') . '/' . ltrim($path, '/');
    }
}