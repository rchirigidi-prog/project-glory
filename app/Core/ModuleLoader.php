<?php

declare(strict_types=1);

namespace App\Core;

final class ModuleLoader
{
    private string $module;

    public function __construct()
    {
        $this->module = $this->sanitize(
            $_GET['module'] ?? 'dashboard'
        );
    }

    public function current(): string
    {
        return $this->module;
    }

    public function url(string $module): string
    {
        return '/admin/dashboard.php?module=' . urlencode($module);
    }

    public function isActive(string $module): bool
    {
        return $this->module === $module;
    }

    public function render(): void
    {
        $file = $this->resolve();

        if (is_file($file)) {
            require $file;
            return;
        }

        $this->notFound();
    }

    private function resolve(): string
    {
        return ADMIN_MODULES . '/'
            . $this->module
            . '/index.php';
    }

    private function sanitize(string $module): string
    {
        $module = trim($module, '/');

        if (!preg_match('#^[a-zA-Z0-9/_-]+$#', $module)) {
            return 'errors/404';
        }

        return $module;
    }

    private function notFound(): void
    {
        require ADMIN_MODULES . '/errors/404.php';
    }
}