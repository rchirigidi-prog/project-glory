<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Supporter extends Model
{
    protected string $table = 'supporters';

    /**
     * Get all supporters ordered by display order then newest first.
     */
    public function allLatest(): array
    {
        $stmt = $this->db->query(
            "SELECT *
             FROM {$this->table}
             ORDER BY display_order ASC, created_at DESC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get featured supporters for the website homepage.
     */
    public function featured(int $limit = 6): array
    {
        $stmt = $this->db->prepare(
            "SELECT *
             FROM {$this->table}
             WHERE status = 'active'
               AND is_featured = 1
             ORDER BY display_order ASC,
                      created_at DESC
             LIMIT :limit"
        );

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}