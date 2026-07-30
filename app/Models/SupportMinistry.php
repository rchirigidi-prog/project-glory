<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class SupportMinistry
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Get Support Ministry settings.
     */
    public function get(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM support_ministry LIMIT 1"
        );

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ?: [];
    }

    /**
     * Update Support Ministry settings.
     */
    public function update(array $data): bool
    {
        $sql = "
            UPDATE support_ministry SET

                section_title = :section_title,
                section_subtitle = :section_subtitle,
                section_description = :section_description,

                prayer_enabled = :prayer_enabled,
                prayer_title = :prayer_title,
                prayer_description = :prayer_description,
                prayer_button_text = :prayer_button_text,
                prayer_button_url = :prayer_button_url,

                donate_enabled = :donate_enabled,
                donate_title = :donate_title,
                donate_description = :donate_description,
                donate_button_text = :donate_button_text,
                donate_button_url = :donate_button_url,

                volunteer_enabled = :volunteer_enabled,
                volunteer_title = :volunteer_title,
                volunteer_description = :volunteer_description,
                volunteer_button_text = :volunteer_button_text,
                volunteer_button_url = :volunteer_button_url,

                sponsor_enabled = :sponsor_enabled,
                sponsor_title = :sponsor_title,
                sponsor_description = :sponsor_description,
                sponsor_button_text = :sponsor_button_text,
                sponsor_button_url = :sponsor_button_url
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([

            ':section_title' => trim($data['section_title'] ?? ''),
            ':section_subtitle' => trim($data['section_subtitle'] ?? ''),
            ':section_description' => trim($data['section_description'] ?? ''),

            ':prayer_enabled' => isset($data['prayer_enabled']) ? 1 : 0,
            ':prayer_title' => trim($data['prayer_title'] ?? ''),
            ':prayer_description' => trim($data['prayer_description'] ?? ''),
            ':prayer_button_text' => trim($data['prayer_button_text'] ?? ''),
            ':prayer_button_url' => trim($data['prayer_button_url'] ?? '#'),

            ':donate_enabled' => isset($data['donate_enabled']) ? 1 : 0,
            ':donate_title' => trim($data['donate_title'] ?? ''),
            ':donate_description' => trim($data['donate_description'] ?? ''),
            ':donate_button_text' => trim($data['donate_button_text'] ?? ''),
            ':donate_button_url' => trim($data['donate_button_url'] ?? '#'),

            ':volunteer_enabled' => isset($data['volunteer_enabled']) ? 1 : 0,
            ':volunteer_title' => trim($data['volunteer_title'] ?? ''),
            ':volunteer_description' => trim($data['volunteer_description'] ?? ''),
            ':volunteer_button_text' => trim($data['volunteer_button_text'] ?? ''),
            ':volunteer_button_url' => trim($data['volunteer_button_url'] ?? '#'),

            ':sponsor_enabled' => isset($data['sponsor_enabled']) ? 1 : 0,
            ':sponsor_title' => trim($data['sponsor_title'] ?? ''),
            ':sponsor_description' => trim($data['sponsor_description'] ?? ''),
            ':sponsor_button_text' => trim($data['sponsor_button_text'] ?? ''),
            ':sponsor_button_url' => trim($data['sponsor_button_url'] ?? '#'),

        ]);
    }
}