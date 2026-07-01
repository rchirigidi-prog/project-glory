<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class SiteSetting
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Return all settings as:
     * [
     *   'site_name' => 'SingThyGlory',
     *   'hero_title' => 'Experience God...',
     * ]
     */
    public function getAll(): array
    {
        $stmt = $this->db->query("
            SELECT setting_key, setting_value
            FROM site_settings
            ORDER BY setting_key
        ");

        $settings = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }

        return $settings;
    }

    /**
     * Get one setting.
     */
    public function get(string $key, $default = null)
    {
        $stmt = $this->db->prepare("
            SELECT setting_value
            FROM site_settings
            WHERE setting_key = :key
            LIMIT 1
        ");

        $stmt->execute([
            'key' => $key
        ]);

        $value = $stmt->fetchColumn();

        return $value !== false ? $value : $default;
    }

    /**
     * Update one setting.
     */
    public function update(string $key, string $value): bool
    {
        $stmt = $this->db->prepare("
            UPDATE site_settings
            SET setting_value = :value
            WHERE setting_key = :key
        ");

        return $stmt->execute([
            'key' => $key,
            'value' => $value
        ]);
    }

    /**
     * Create or Update.
     */
    public function set(string $key, string $value): bool
    {
        if ($this->get($key) === null) {

            $stmt = $this->db->prepare("
                INSERT INTO site_settings
                (setting_key, setting_value)
                VALUES
                (:key, :value)
            ");

            return $stmt->execute([
                'key' => $key,
                'value' => $value
            ]);
        }

        return $this->update($key, $value);
    }
}
