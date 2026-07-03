<?php

namespace App\Services;

use App\Models\SiteSetting;

class FooterService
{
    private SiteSetting $settings;

    private array $allowedKeys = [
        'footer_text',
    ];

    public function __construct()
    {
        $this->settings = new SiteSetting();
    }

    public function getSettings(): array
    {
        $allSettings = $this->settings->getAll();

        $footerSettings = [];

        foreach ($this->allowedKeys as $key) {
            $footerSettings[$key] = $allSettings[$key] ?? '';
        }

        return $footerSettings;
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
