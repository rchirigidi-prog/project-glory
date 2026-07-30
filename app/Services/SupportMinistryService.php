<?php

namespace App\Services;

use App\Models\SupportMinistry;

class SupportMinistryService
{
    private SupportMinistry $model;

    public function __construct()
    {
        $this->model = new SupportMinistry();
    }

    /**
     * Get Support Ministry configuration.
     */
    public function index(): array
    {
        return $this->model->get();
    }

    /**
     * Save Support Ministry configuration.
     */
    public function update(array $data): bool
    {
        return $this->model->update($data);
    }
}