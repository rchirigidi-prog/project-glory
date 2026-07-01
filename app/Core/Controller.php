<?php

namespace App\Core;

abstract class Controller
{
    protected function view(string $file,array $data=[])
    {
        extract($data);

        require __DIR__ . "/../../public/views/{$file}.php";
    }

    protected function redirect(string $url)
    {
        header("Location: {$url}");

        exit;
    }
}