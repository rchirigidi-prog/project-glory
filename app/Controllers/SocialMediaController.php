<?php

namespace App\Controllers;

use App\Services\SocialMediaService;

class SocialMediaController
{
    private SocialMediaService $service;

    public function __construct()
    {
        $this->service = new SocialMediaService();
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

        $_SESSION['success'] = 'Social media settings updated successfully.';

        header('Location: index.php');
        exit;
    }
}
