<?php

namespace App\Models;

use App\Core\Model;
use PDO;

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

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get only audio files.
     */
    public function getAudioFiles(): array
    {
        $stmt = $this->db->prepare("
            SELECT
                id,
                original_name,
                filename,
                mime_type
            FROM media
            WHERE mime_type LIKE 'audio/%'
            ORDER BY original_name ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get only image files.
     */
    public function getImageFiles(): array
    {
        $stmt = $this->db->prepare("
            SELECT
                id,
                original_name,
                filename,
                mime_type
            FROM media
            WHERE mime_type LIKE 'image/%'
            ORDER BY original_name ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}