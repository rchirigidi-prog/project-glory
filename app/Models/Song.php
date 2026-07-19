<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Song extends Model
{
    protected string $table = 'songs';

    /**
     * Get all songs ordered by newest first.
     */
    public function allLatest(): array
    {
        $stmt = $this->db->query(
            "SELECT s.*,
                    a.name AS artist_name,
                    al.title AS album_title
             FROM {$this->table} s
             LEFT JOIN artists a
                 ON s.artist_id = a.id
             LEFT JOIN albums al
                 ON s.album_id = al.id
             ORDER BY s.created_at DESC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}