<?php

namespace App\Core;

class Response
{
    public static function redirect(string $url): never
    {
        header("Location: {$url}");
        exit;
    }

    public static function json(array $data, int $status = 200): never
    {
        http_response_code($status);

        header('Content-Type: application/json');

        echo json_encode($data);

        exit;
    }

    public static function notFound(): never
    {
        http_response_code(404);

        exit('404 - Page Not Found');
    }

    public static function forbidden(): never
    {
        http_response_code(403);

        exit('403 - Access Denied');
    }
}