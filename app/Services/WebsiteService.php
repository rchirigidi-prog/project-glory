<?php

namespace App\Services;

use App\Models\SiteSetting;

class WebsiteService
{
    private SiteSetting $settings;

    public function __construct()
    {
        $this->settings = new SiteSetting();
    }

    public function getSettings(): array
    {
        return $this->settings->getAll();
    }

    public function updateSettings(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->settings->update($key, trim((string)$value));
        }
    }
}
