<?php

namespace App\Core;

class View
{
    public static function render(string $view, array $data = []): void
    {
        extract($data);

        require APP_PATH . '/Views/' . $view . '.php';
    }
}