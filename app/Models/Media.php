<?php

namespace App\Models;

use App\Core\Model;

class Media extends Model
{
    /**
     * Database table.
     */
    protected string $table = 'media';

    /**
     * Get all media with uploader name.
     */
    public function allWithUploader(): array
    {
        $stmt = $this->db->query("
            SELECT
                m.*,
                u.name AS uploader_name
            FROM media m
            LEFT JOIN users u
                ON m.uploaded_by = u.id
            ORDER BY m.id DESC
        ");

        return $stmt->fetchAll();
    }
}