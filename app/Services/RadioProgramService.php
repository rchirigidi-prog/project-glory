<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\RadioProgram;

class RadioProgramService
{
    private RadioProgram $program;

    public function __construct()
    {
        $this->program = new RadioProgram();
    }

    /**
     * Get all programs ordered by priority.
     */
    public function all(): array
    {
        return $this->program->allOrdered();
    }

    /**
     * Get only active programs.
     */
    public function active(): array
    {
        return $this->program->active();
    }

    /**
     * Find program by ID.
     */
    public function find(int $id): ?array
    {
        return $this->program->find($id);
    }

    /**
     * Find program by slug.
     */
    public function findBySlug(string $slug): ?array
    {
        return $this->program->findBySlug($slug);
    }

    /**
     * Create a new radio program.
     */
    public function create(array $data): bool
    {
        return $this->program->create([
            'name'               => trim($data['name']),
            'slug'               => trim($data['slug']),
            'description'        => trim($data['description'] ?? ''),
            'language'           => $data['language'],
            'category'           => trim($data['category'] ?? ''),
            'estimated_duration' => (int) $data['estimated_duration'],
            'priority'           => (int) ($data['priority'] ?? 0),
            'is_active'          => (int) ($data['is_active'] ?? 1),
            'created_by'         => $data['created_by'] ?? null,
        ]);
    }

    /**
     * Update an existing radio program.
     */
    public function update(int $id, array $data): bool
    {
        return $this->program->update($id, [
            'name'               => trim($data['name']),
            'slug'               => trim($data['slug']),
            'description'        => trim($data['description'] ?? ''),
            'language'           => $data['language'],
            'category'           => trim($data['category'] ?? ''),
            'estimated_duration' => (int) $data['estimated_duration'],
            'priority'           => (int) ($data['priority'] ?? 0),
            'is_active'          => (int) ($data['is_active'] ?? 1),
        ]);
    }

    /**
     * Delete a radio program.
     */
    public function delete(int $id): bool
    {
        return $this->program->delete($id);
    }

    /**
     * Check whether a slug already exists.
     */
    public function slugExists(string $slug): bool
    {
        return $this->program->slugExists($slug);
    }

    /**
     * Get available categories.
     */
    public function categories(): array
    {
        return $this->program->categories();
    }

    /**
     * Get supported languages.
     */
    public function languages(): array
    {
        return $this->program->languages();
    }
}