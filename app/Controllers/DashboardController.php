<?php

namespace App\Controllers;

use App\Services\DashboardService;

class DashboardController
{
    private DashboardService $service;

    public function __construct()
    {
        $this->service = new DashboardService();
    }

    public function index(): array
    {
        return $this->service->stats();
    }
}
