<?php

namespace App\Models;

use App\Core\Model;

class BibleReading extends Model
{
    /**
     * Database table.
     */
    protected string $table = 'bible_readings';

    /**
     * Get all Bible readings, newest first.
     */
    public function allLatest(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM bible_readings
            ORDER BY id DESC
        ");

        return $stmt->fetchAll();
    }
}
