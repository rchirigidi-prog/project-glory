<?php

namespace App\Services;

use App\Models\SiteSetting;

class SeoService
{
    private SiteSetting $settings;

    private array $allowedKeys = [

        // Global SEO
        'seo_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'meta_robots',
        'seo_author',
        'seo_language',
        'theme_color',
        'favicon_url',

        // Open Graph
        'og_title',
        'og_description',
        'og_image',
        'og_url',
        'og_type',
        'og_site_name',
        'og_locale',

        // Twitter Cards
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'twitter_card',
        'twitter_site',

        // Search Engine Verification
        'google_verification',
        'bing_verification',
        'yandex_verification',
        'pinterest_verification',

        // Analytics
        'google_analytics',
        'google_tag_manager',
        'microsoft_clarity',
        'facebook_pixel',

        // Technical SEO
        'sitemap_url',
        'robots_txt_url',
        'apple_touch_icon',
        'manifest_url',
    ];

    public function __construct()
    {
        $this->settings = new SiteSetting();
    }

    public function getSettings(): array
    {
        $allSettings = $this->settings->getAll();

        $settings = [];

        foreach ($this->allowedKeys as $key) {
            $settings[$key] = $allSettings[$key] ?? '';
        }

        return $settings;
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