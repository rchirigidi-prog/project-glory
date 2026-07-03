<?php

namespace App\Services;

use App\Models\SiteSetting;

class SocialMediaService
{
    private SiteSetting $settings;

    private array $allowedKeys = [
        'youtube_url',
        'facebook_url',
        'instagram_url',
    ];

    public function __construct()
    {
        $this->settings = new SiteSetting();
    }

    public function getSettings(): array
    {
        $allSettings = $this->settings->getAll();

        $socialSettings = [];

        foreach ($this->allowedKeys as $key) {
            $socialSettings[$key] = $allSettings[$key] ?? '';
        }

        return $socialSettings;
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
