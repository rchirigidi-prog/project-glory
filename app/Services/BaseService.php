<?php

namespace App\Services;

abstract class BaseService
{
    /**
     * Standard success response.
     */
    protected function success(
        string $message = '',
        array $data = []
    ): array {
        return [
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ];
    }

    /**
     * Standard error response.
     */
    protected function error(
        string $message,
        array $errors = []
    ): array {
        return [
            'success' => false,
            'message' => $message,
            'errors'  => $errors,
        ];
    }
}