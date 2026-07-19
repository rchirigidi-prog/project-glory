<?php

namespace App\Services;

use App\Models\Artist;

class ArtistService
{
    private Artist $artist;

    public function __construct()
    {
        $this->artist = new Artist();
    }

    /**
     * Get all artists.
     */
    public function all(): array
    {
        return $this->artist->allLatest();
    }

    /**
     * Find one artist.
     */
    public function find(int $id): ?array
    {
        return $this->artist->find($id);
    }

    /**
     * Create an artist.
     */
    public function create(array $data): bool
    {
        return $this->artist->create([
            'name'           => trim((string) ($data['name'] ?? '')),
            'slug'           => $this->generateSlug(
                (string) ($data['name'] ?? '')
            ),
            'photo_media_id' => !empty($data['photo_media_id'])
                ? (int) $data['photo_media_id']
                : null,
            'biography'      => trim((string) ($data['biography'] ?? '')),
            'language'       => $this->normalizeLanguage(
                (string) ($data['language'] ?? 'English')
            ),
            'status'         => $this->normalizeStatus(
                (string) ($data['status'] ?? 'draft')
            ),
        ]);
    }

    /**
     * Update an artist.
     */
    public function update(int $id, array $data): bool
    {
        return $this->artist->update($id, [
            'name'           => trim((string) ($data['name'] ?? '')),
            'slug'           => $this->generateSlug(
                (string) ($data['name'] ?? '')
            ),
            'photo_media_id' => !empty($data['photo_media_id'])
                ? (int) $data['photo_media_id']
                : null,
            'biography'      => trim((string) ($data['biography'] ?? '')),
            'language'       => $this->normalizeLanguage(
                (string) ($data['language'] ?? 'English')
            ),
            'status'         => $this->normalizeStatus(
                (string) ($data['status'] ?? 'draft')
            ),
        ]);
    }

    /**
     * Delete an artist.
     */
    public function delete(int $id): bool
    {
        return $this->artist->delete($id);
    }

    /**
     * Generate SEO-friendly slug.
     */
    private function generateSlug(string $name): string
    {
        $slug = strtolower(trim($name));

        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);

        return trim($slug ?? '', '-');
    }

    /**
     * Allow only supported languages.
     */
    private function normalizeLanguage(string $language): string
    {
        return match ($language) {
            'Hindi' => 'Hindi',
            'Telugu' => 'Telugu',
            'Instrumental' => 'Instrumental',
            'Multi-language' => 'Multi-language',
            default => 'English',
        };
    }

    /**
     * Allow only valid status values.
     */
    private function normalizeStatus(string $status): string
    {
        return match ($status) {
            'published' => 'published',
            default => 'draft',
        };
    }
}