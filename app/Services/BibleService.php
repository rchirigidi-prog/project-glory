<?php

namespace App\Services;

use App\Models\BibleReading;

class BibleService
{
    private BibleReading $bibleReading;

    public function __construct()
    {
        $this->bibleReading = new BibleReading();
    }

    /**
     * Get all Bible readings.
     */
    public function all(): array
    {
        return $this->bibleReading->allLatest();
    }

    /**
     * Find one Bible reading.
     */
    public function find(int $id): ?array
    {
        return $this->bibleReading->find($id);
    }

    /**
     * Create a Bible reading.
     */
    public function create(array $data): bool
    {
        return $this->bibleReading->create([
            'title' => trim((string) ($data['title'] ?? '')),
            'bible_reference' => trim((string) ($data['bible_reference'] ?? '')),
            'content' => trim((string) ($data['content'] ?? '')),
            'language' => trim((string) ($data['language'] ?? 'English')),
            'status' => $this->normalizeStatus(
                (string) ($data['status'] ?? 'draft')
            ),
        ]);
    }

    /**
     * Update a Bible reading.
     */
    public function update(int $id, array $data): bool
    {
        return $this->bibleReading->update($id, [
            'title' => trim((string) ($data['title'] ?? '')),
            'bible_reference' => trim((string) ($data['bible_reference'] ?? '')),
            'content' => trim((string) ($data['content'] ?? '')),
            'language' => trim((string) ($data['language'] ?? 'English')),
            'status' => $this->normalizeStatus(
                (string) ($data['status'] ?? 'draft')
            ),
        ]);
    }

    /**
     * Delete a Bible reading.
     */
    public function delete(int $id): bool
    {
        return $this->bibleReading->delete($id);
    }

    /**
     * Allow only valid database status values.
     */
    private function normalizeStatus(string $status): string
    {
        return $status === 'published'
            ? 'published'
            : 'draft';
    }
}
