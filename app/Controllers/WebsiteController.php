<?php

namespace App\Controllers;

use App\Services\WebsiteService;

class WebsiteController
{
    private WebsiteService $service;

    public function __construct()
    {
        $this->service = new WebsiteService();
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

        $_SESSION['success'] = 'Website settings updated successfully.';

        header('Location: general.php');
        exit;
    }
}
