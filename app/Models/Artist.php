<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Artist extends Model
{
    protected string $table = 'artists';

    /**
     * Get all artists ordered by newest first.
     */
    public function allLatest(): array
    {
        $stmt = $this->db->query(
            "SELECT *
             FROM {$this->table}
             ORDER BY created_at DESC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}