<?php

namespace App\Services;

use App\Models\SiteSetting;

class SocialMediaService
{
    private SiteSetting $settings;

    private array $allowedKeys = [

        // Social Platforms
        'youtube_url',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'threads_url',
        'telegram_url',
        'whatsapp_channel_url',

        // Music Platforms
        'spotify_url',
        'apple_music_url',
        'amazon_music_url',
        'youtube_music_url',
        'audiomack_url',
        'jiosaavn_url',
        'gaana_url',
        'wynk_url',

        // Ministry
        'website_url',
        'radio_url',
        'listen_live_url',
        'podcast_rss',
        'email_address',
        'donate_url',
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
                    trim((string)$data[$key])
                );
            }
        }
    }
}