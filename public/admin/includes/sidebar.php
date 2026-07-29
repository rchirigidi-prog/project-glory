<?php

use App\Core\ModuleLoader;

$loader = new ModuleLoader();

function navLink(
    ModuleLoader $loader,
    string $module,
    string $icon,
    string $label
): void {
    $active = $loader->isActive($module) ? ' active' : '';

    echo <<<HTML
<li class="nav-item">
    <a href="{$loader->url($module)}" class="nav-link{$active}">
        <i class="{$icon}"></i>
        {$label}
    </a>
</li>
HTML;
}
?>

<div class="sidebar">

    <div class="logo text-center py-4">

        <img src="<?= ASSET_URL ?>/images/logo/logo.png"
             width="80"
             class="mb-3">

        <h4 class="text-white mb-0">
            SingThyGlory
        </h4>

        <small class="text-warning">
            Studio v1.0
        </small>

    </div>

    <ul class="nav flex-column">

        <?php navLink($loader, 'dashboard', 'fa-solid fa-house', 'Dashboard'); ?>

        <li class="nav-item mt-3">
            <small class="text-uppercase text-secondary ps-3">Website</small>
        </li>

        <?php
        navLink($loader, 'website', 'fa-solid fa-globe', 'Website Manager');
        navLink($loader, 'social-media', 'fa-solid fa-share-nodes', 'Social Media');
        navLink($loader, 'seo', 'fa-solid fa-magnifying-glass-chart', 'SEO Manager');
        navLink($loader, 'footer', 'fa-solid fa-shoe-prints', 'Footer Manager');
        ?>

        <li class="nav-item mt-3">
            <small class="text-uppercase text-secondary ps-3">Content</small>
        </li>

        <?php
        navLink($loader, 'bible', 'fa-solid fa-book-bible', 'Bible');
        navLink($loader, 'prayer', 'fa-solid fa-hands-praying', 'Prayer');
        navLink($loader, 'announcements', 'fa-solid fa-bullhorn', 'Announcements');
        ?>

        <li class="nav-item mt-3">
            <small class="text-uppercase text-secondary ps-3">Music</small>
        </li>

        <?php
        navLink($loader, 'artists', 'fa-solid fa-microphone', 'Artists');
        navLink($loader, 'albums', 'fa-solid fa-compact-disc', 'Albums');
        navLink($loader, 'music', 'fa-solid fa-music', 'Songs');
        ?>

        <li class="nav-item mt-3">
            <small class="text-uppercase text-secondary ps-3">Media</small>
        </li>

        <?php
        navLink($loader, 'media', 'fa-solid fa-photo-film', 'Media Library');
        navLink($loader, 'radio', 'fa-solid fa-radio', 'Radio');
        navLink($loader, 'youtube', 'fa-brands fa-youtube', 'YouTube');
        ?>

        <li class="nav-item mt-3">
            <small class="text-uppercase text-secondary ps-3">Administration</small>
        </li>

        <?php
        navLink($loader, 'supporters', 'fa-solid fa-hand-holding-heart', 'Supporters');
        navLink($loader, 'users', 'fa-solid fa-users', 'Users');
        navLink($loader, 'roles', 'fa-solid fa-user-shield', 'Roles');
        navLink($loader, 'settings', 'fa-solid fa-gear', 'Settings');
        ?>

    </ul>

</div>