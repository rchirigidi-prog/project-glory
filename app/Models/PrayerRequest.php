<?php

namespace App\Models;

use App\Core\Model;

class PrayerRequest extends Model
{
    /**
     * Database table.
     */
    protected string $table = 'prayer_requests';

    /**
     * Get all prayer requests ordered newest first.
     */
    public function allLatest(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM prayer_requests
            ORDER BY id DESC
        ");

        return $stmt->fetchAll();
    }
}