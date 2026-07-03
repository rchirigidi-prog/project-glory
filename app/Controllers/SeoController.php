<?php

namespace App\Controllers;

use App\Services\SeoService;

class SeoController
{
    private SeoService $service;

    public function __construct()
    {
        $this->service = new SeoService();
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

        $_SESSION['success'] = 'SEO settings updated successfully.';

        header('Location: index.php');
        exit;
    }
}
