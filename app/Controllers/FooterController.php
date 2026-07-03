<?php

namespace App\Controllers;

use App\Services\FooterService;

class FooterController
{
    private FooterService $service;

    public function __construct()
    {
        $this->service = new FooterService();
    }

    public function index(): array
    {
        return $this->service->getSettings();
    }

    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $this->service->updateSettings($_POST);

        $_SESSION['success'] = 'Footer settings updated successfully.';

        header('Location: index.php');
        exit;
    }
}
