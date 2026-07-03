<?php

namespace App\Services;

use App\Models\SiteSetting;

class SeoService
{
    private SiteSetting $settings;

    private array $allowedKeys = [
        'seo_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
    ];

    public function __construct()
    {
        $this->settings = new SiteSetting();
    }

    public function getSettings(): array
    {
        $allSettings = $this->settings->getAll();

        $seoSettings = [];

        foreach ($this->allowedKeys as $key) {
            $seoSettings[$key] = $allSettings[$key] ?? '';
        }

        return $seoSettings;
    }

    public function updateSettings(array $data): void
    {
        foreach ($this->allowedKeys as $key) {
            if (array_key_exists($key, $data)) {
                $this->settings->set(
                    $key,
                    trim((string) $data[$key])
                );
            }
        }
    }
}
