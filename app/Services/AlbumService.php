<?php

namespace App\Services;

use App\Models\Album;

class AlbumService
{
    private Album $album;

    public function __construct()
    {
        $this->album = new Album();
    }

    /**
     * Get all albums.
     */
    public function all(): array
    {
        return $this->album->allLatest();
    }

    /**
     * Find one album.
     */
    public function find(int $id): ?array
    {
        return $this->album->find($id);
    }

    /**
     * Create an album.
     */
    public function create(array $data): bool
    {
        return $this->album->create([
            'title'          => trim((string) ($data['title'] ?? '')),
            'slug'           => $this->generateSlug(
                (string) ($data['title'] ?? '')
            ),
            'artist_id'      => !empty($data['artist_id'])
                ? (int) $data['artist_id']
                : null,
            'cover_media_id' => !empty($data['cover_media_id'])
                ? (int) $data['cover_media_id']
                : null,
            'description'    => trim((string) ($data['description'] ?? '')),
            'language'       => $this->normalizeLanguage(
                (string) ($data['language'] ?? 'English')
            ),
            'release_date'   => !empty($data['release_date'])
                ? $data['release_date']
                : null,
            'status'         => $this->normalizeStatus(
                (string) ($data['status'] ?? 'draft')
            ),
        ]);
    }

    /**
     * Update an album.
     */
    public function update(int $id, array $data): bool
    {
        return $this->album->update($id, [
            'title'          => trim((string) ($data['title'] ?? '')),
            'slug'           => $this->generateSlug(
                (string) ($data['title'] ?? '')
            ),
            'artist_id'      => !empty($data['artist_id'])
                ? (int) $data['artist_id']
                : null,
            'cover_media_id' => !empty($data['cover_media_id'])
                ? (int) $data['cover_media_id']
                : null,
            'description'    => trim((string) ($data['description'] ?? '')),
            'language'       => $this->normalizeLanguage(
                (string) ($data['language'] ?? 'English')
            ),
            'release_date'   => !empty($data['release_date'])
                ? $data['release_date']
                : null,
            'status'         => $this->normalizeStatus(
                (string) ($data['status'] ?? 'draft')
            ),
        ]);
    }

    /**
     * Delete an album.
     */
    public function delete(int $id): bool
    {
        return $this->album->delete($id);
    }

    /**
     * Generate SEO-friendly slug.
     */
    private function generateSlug(string $title): string
    {
        $slug = strtolower(trim($title));

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