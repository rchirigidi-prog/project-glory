<?php

declare(strict_types=1);

namespace App\Core;

final class ModuleLoader
{
    private string $module;
    private string $action;

    public function __construct()
    {
        $this->module = $this->sanitize(
            $_GET['module'] ?? 'dashboard'
        );

        $this->action = $this->sanitizeAction(
            $_GET['action'] ?? 'index'
        );
    }

    public function current(): string
    {
        return $this->module;
    }

    public function currentAction(): string
    {
        return $this->action;
    }

    public function url(string $module, string $action = 'index'): string
    {
        return '/admin/dashboard.php?module='
            . urlencode($module)
            . '&action='
            . urlencode($action);
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
        $file = ADMIN_MODULES
            . '/'
            . $this->module
            . '/'
            . $this->action
            . '.php';

        if (is_file($file)) {
            return $file;
        }

        return ADMIN_MODULES
            . '/'
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

    private function sanitizeAction(string $action): string
    {
        $action = trim($action);

        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $action)) {
            return 'index';
        }

        return $action;
    }

    private function notFound(): void
    {
        require ADMIN_MODULES . '/errors/404.php';
    }
}