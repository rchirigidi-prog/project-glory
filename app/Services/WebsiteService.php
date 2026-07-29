<?php

namespace App\Services;

use App\Models\SiteSetting;

class WebsiteService
{
    private SiteSetting $settings;
    private SupporterService $supporters;

    public function __construct()
    {
        $this->settings = new SiteSetting();
        $this->supporters = new SupporterService();
    }

    /**
     * Get all website settings.
     */
    public function getSettings(): array
    {
        return $this->settings->getAll();
    }

    /**
     * Update website settings.
     */
    public function updateSettings(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->settings->set($key, $value);
        }
    }

    /**
     * Get featured supporters for the public website.
     */
    public function getFeaturedSupporters(int $limit = 6): array
    {
        return $this->supporters->featured($limit);
    }
}