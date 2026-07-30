<?php

namespace App\Controllers;

use App\Services\SupportMinistryService;

class SupportMinistryController
{
    private SupportMinistryService $service;

    public function __construct()
    {
        $this->service = new SupportMinistryService();
    }

    /**
     * Display and update Support Ministry settings.
     */
    public function index(): array
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($this->service->update($_POST)) {

                $_SESSION['success'] = 'Support Ministry updated successfully.';
            }
        }

        return $this->service->index();
    }
}