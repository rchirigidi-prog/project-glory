<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;
use PDO;

class RadioProgram extends Model
{
    /**
     * Database table.
     */
    protected string $table = 'radio_programs';

    /**
     * Get all programs ordered by priority and name.
     */
    public function allOrdered(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM radio_programs
            ORDER BY
                priority ASC,
                name ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get only active programs.
     */
    public function active(): array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM radio_programs
            WHERE is_active = 1
            ORDER BY
                priority ASC,
                name ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find program by slug.
     */
    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM radio_programs
            WHERE slug = ?
            LIMIT 1
        ");

        $stmt->execute([$slug]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Check whether a slug already exists.
     */
    public function slugExists(string $slug): bool
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*)
            FROM radio_programs
            WHERE slug = ?
        ");

        $stmt->execute([$slug]);

        return (int) $stmt->fetchColumn() > 0;
    }

    /**
     * Get available categories.
     */
    public function categories(): array
    {
        $stmt = $this->db->query("
            SELECT DISTINCT category
            FROM radio_programs
            WHERE category IS NOT NULL
              AND category <> ''
            ORDER BY category ASC
        ");

        return array_column(
            $stmt->fetchAll(PDO::FETCH_ASSOC),
            'category'
        );
    }

    /**
     * Get available languages.
     */
    public function languages(): array
    {
        return [
            'english',
            'hindi',
            'telugu',
            'bilingual',
            'multilingual',
        ];
    }
}