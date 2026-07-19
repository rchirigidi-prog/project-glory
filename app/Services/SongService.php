<?php

namespace App\Services;

use App\Models\Song;

class SongService
{
    private Song $song;

    public function __construct()
    {
        $this->song = new Song();
    }

    /**
     * Get all songs.
     */
    public function all(): array
    {
        return $this->song->allLatest();
    }

    /**
     * Find one song.
     */
    public function find(int $id): ?array
    {
        return $this->song->find($id);
    }

    /**
     * Create a song.
     */
    public function create(array $data): bool
    {
        return $this->song->create([
            'artist_id'      => !empty($data['artist_id'])
                ? (int) $data['artist_id']
                : null,

            'album_id'       => !empty($data['album_id'])
                ? (int) $data['album_id']
                : null,

            'title'          => trim((string) ($data['title'] ?? '')),

            'slug'           => $this->generateSlug(
                (string) ($data['title'] ?? '')
            ),

            'language'       => $this->normalizeLanguage(
                (string) ($data['language'] ?? 'English')
            ),

            'duration'       => trim((string) ($data['duration'] ?? '')),

            'audio_media_id' => !empty($data['audio_media_id'])
                ? (int) $data['audio_media_id']
                : null,

            'cover_media_id' => !empty($data['cover_media_id'])
                ? (int) $data['cover_media_id']
                : null,

            'youtube_url'    => trim((string) ($data['youtube_url'] ?? '')),

            'release_date'   => !empty($data['release_date'])
                ? $data['release_date']
                : null,

            'status'         => $this->normalizeStatus(
                (string) ($data['status'] ?? 'draft')
            ),
        ]);
    }

    /**
     * Update a song.
     */
    public function update(int $id, array $data): bool
    {
        return $this->song->update($id, [
            'artist_id'      => !empty($data['artist_id'])
                ? (int) $data['artist_id']
                : null,

            'album_id'       => !empty($data['album_id'])
                ? (int) $data['album_id']
                : null,

            'title'          => trim((string) ($data['title'] ?? '')),

            'slug'           => $this->generateSlug(
                (string) ($data['title'] ?? '')
            ),

            'language'       => $this->normalizeLanguage(
                (string) ($data['language'] ?? 'English')
            ),

            'duration'       => trim((string) ($data['duration'] ?? '')),

            'audio_media_id' => !empty($data['audio_media_id'])
                ? (int) $data['audio_media_id']
                : null,

            'cover_media_id' => !empty($data['cover_media_id'])
                ? (int) $data['cover_media_id']
                : null,

            'youtube_url'    => trim((string) ($data['youtube_url'] ?? '')),

            'release_date'   => !empty($data['release_date'])
                ? $data['release_date']
                : null,

            'status'         => $this->normalizeStatus(
                (string) ($data['status'] ?? 'draft')
            ),
        ]);
    }

    /**
     * Delete a song.
     */
    public function delete(int $id): bool
    {
        return $this->song->delete($id);
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