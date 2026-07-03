<?php

namespace App\Core;

class Controller
{
    /**
     * Render a view.
     */
    protected function view(string $view, array $data = []): void
    {
        extract($data);

        require APP_PATH . '/Views/' . $view . '.php';
    }

    /**
     * Redirect.
     */
    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }

    /**
     * JSON Response.
     */
    protected function json(array $data, int $status = 200): void
    {
        http_response_code($status);

        header('Content-Type: application/json');

        echo json_encode($data);

        exit;
    }

    /**
     * Success Flash Message.
     */
    protected function success(string $message): void
    {
        Flash::success($message);
    }

    /**
     * Error Flash Message.
     */
    protected function error(string $message): void
    {
        Flash::error($message);
    }
}