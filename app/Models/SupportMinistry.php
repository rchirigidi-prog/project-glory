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
     * Get the single Support Ministry configuration.
     */
    public function get(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM support_ministry LIMIT 1"
        );

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            $this->createDefault();

            $stmt = $this->db->query(
                "SELECT * FROM support_ministry LIMIT 1"
            );

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $data ?: [];
    }

    /**
     * Create the initial configuration row.
     */
    private function createDefault(): void
    {
        $sql = "
            INSERT INTO support_ministry (
                prayer_title,
                prayer_description,
                prayer_button_text,
                prayer_button_link,

                donate_title,
                donate_description,
                donate_button_text,
                donate_button_link,

                volunteer_title,
                volunteer_description,
                volunteer_button_text,
                volunteer_button_link,

                sponsor_title,
                sponsor_description,
                sponsor_button_text,
                sponsor_button_link,

                section_title,
                section_subtitle,
                is_enabled
            )
            VALUES (
                'Prayer Partner',
                '',
                'Request Prayer',
                '#',

                'Donate',
                '',
                'Donate Now',
                '#',

                'Volunteer',
                '',
                'Join Us',
                '#',

                'Sponsor a Project',
                '',
                'Learn More',
                '#',

                'Support Our Ministry',
                '',
                1
            )
        ";

        $this->db->exec($sql);
    }

    /**
     * Update Support Ministry configuration.
     */
    public function update(array $data): bool
    {
        $sql = "
            UPDATE support_ministry SET

            prayer_title = :prayer_title,
            prayer_description = :prayer_description,
            prayer_button_text = :prayer_button_text,
            prayer_button_link = :prayer_button_link,

            donate_title = :donate_title,
            donate_description = :donate_description,
            donate_button_text = :donate_button_text,
            donate_button_link = :donate_button_link,

            volunteer_title = :volunteer_title,
            volunteer_description = :volunteer_description,
            volunteer_button_text = :volunteer_button_text,
            volunteer_button_link = :volunteer_button_link,

            sponsor_title = :sponsor_title,
            sponsor_description = :sponsor_description,
            sponsor_button_text = :sponsor_button_text,
            sponsor_button_link = :sponsor_button_link,

            section_title = :section_title,
            section_subtitle = :section_subtitle,
            is_enabled = :is_enabled

            WHERE id = 1
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':prayer_title' => $data['prayer_title'] ?? '',
            ':prayer_description' => $data['prayer_description'] ?? '',
            ':prayer_button_text' => $data['prayer_button_text'] ?? '',
            ':prayer_button_link' => !empty($data['prayer_button_link']) ? $data['prayer_button_link'] : '#',

            ':donate_title' => $data['donate_title'] ?? '',
            ':donate_description' => $data['donate_description'] ?? '',
            ':donate_button_text' => $data['donate_button_text'] ?? '',
            ':donate_button_link' => !empty($data['donate_button_link']) ? $data['donate_button_link'] : '#',

            ':volunteer_title' => $data['volunteer_title'] ?? '',
            ':volunteer_description' => $data['volunteer_description'] ?? '',
            ':volunteer_button_text' => $data['volunteer_button_text'] ?? '',
            ':volunteer_button_link' => !empty($data['volunteer_button_link']) ? $data['volunteer_button_link'] : '#',

            ':sponsor_title' => $data['sponsor_title'] ?? '',
            ':sponsor_description' => $data['sponsor_description'] ?? '',
            ':sponsor_button_text' => $data['sponsor_button_text'] ?? '',
            ':sponsor_button_link' => !empty($data['sponsor_button_link']) ? $data['sponsor_button_link'] : '#',

            ':section_title' => $data['section_title'] ?? '',
            ':section_subtitle' => $data['section_subtitle'] ?? '',
            ':is_enabled' => isset($data['is_enabled']) ? 1 : 0,
        ]);
    }
}