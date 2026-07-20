<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Admin Module Registry
|--------------------------------------------------------------------------
|
| Register every admin module here.
| The dashboard loader uses this registry to locate module pages.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Core
    |--------------------------------------------------------------------------
    */

    'dashboard' => [
        'title' => 'Dashboard',
        'icon'  => 'fa-solid fa-gauge-high',
        'file'  => ADMIN_MODULES . '/dashboard/index.php',
    ],

    /*
    |--------------------------------------------------------------------------
    | Website
    |--------------------------------------------------------------------------
    */

    'website' => [
        'title' => 'Website',
        'icon'  => 'fa-solid fa-globe',
        'file'  => ADMIN_MODULES . '/website/index.php',
    ],

    /*
    |--------------------------------------------------------------------------
    | Media Library
    |--------------------------------------------------------------------------
    */

    'media' => [
        'title' => 'Media Library',
        'icon'  => 'fa-solid fa-photo-film',
        'file'  => ADMIN_MODULES . '/media/index.php',
    ],

    /*
    |--------------------------------------------------------------------------
    | Radio Automation Studio
    |--------------------------------------------------------------------------
    */

    'radio' => [
        'title' => 'Radio Automation',
        'icon'  => 'fa-solid fa-radio',
        'file'  => ADMIN_MODULES . '/radio/dashboard.php',
    ],

    /*
    |--------------------------------------------------------------------------
    | Music Library
    |--------------------------------------------------------------------------
    */

    'artists' => [
        'title' => 'Artists',
        'icon'  => 'fa-solid fa-user-music',
        'file'  => ADMIN_MODULES . '/artists/index.php',
    ],

    'albums' => [
        'title' => 'Albums',
        'icon'  => 'fa-solid fa-compact-disc',
        'file'  => ADMIN_MODULES . '/albums/index.php',
    ],

    'songs' => [
        'title' => 'Songs',
        'icon'  => 'fa-solid fa-music',
        'file'  => ADMIN_MODULES . '/songs/index.php',
    ],

    'lyrics' => [
        'title' => 'Lyrics',
        'icon'  => 'fa-solid fa-file-lines',
        'file'  => ADMIN_MODULES . '/lyrics/index.php',
    ],

    'genres' => [
        'title' => 'Genres',
        'icon'  => 'fa-solid fa-tags',
        'file'  => ADMIN_MODULES . '/genres/index.php',
    ],

    /*
    |--------------------------------------------------------------------------
    | Administration
    |--------------------------------------------------------------------------
    */

    'users' => [
        'title' => 'Users',
        'icon'  => 'fa-solid fa-users',
        'file'  => ADMIN_MODULES . '/users/index.php',
    ],

    'settings' => [
        'title' => 'Settings',
        'icon'  => 'fa-solid fa-gear',
        'file'  => ADMIN_MODULES . '/settings/index.php',
    ],

];