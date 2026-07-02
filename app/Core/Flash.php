<?php

namespace App\Core;

class Flash
{
    /**
     * Store a flash message.
     */
    public static function set(string $type, string $message): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['flash'][$type] = $message;
    }

    /**
     * Get and remove a flash message.
     */
    public static function get(string $type): ?string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['flash'][$type])) {
            return null;
        }

        $message = $_SESSION['flash'][$type];

        unset($_SESSION['flash'][$type]);

        return $message;
    }

    /**
     * Check if a flash message exists.
     */
    public static function has(string $type): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['flash'][$type]);
    }

    /**
     * Remove all flash messages.
     */
    public static function clear(): void
    {
        unset($_SESSION['flash']);
    }
}