<?php

namespace App\Services;

use App\Models\Media;

class MediaService
{
    private Media $media;

    public function __construct()
    {
        $this->media = new Media();
    }

    /**
     * Get all media with uploader information.
     */
    public function all(): array
    {
        return $this->media->allWithUploader();
    }

    /**
     * Find media by ID.
     */
    public function find(int $id): ?array
    {
        return $this->media->find($id);
    }

    /**
     * Save uploaded media metadata.
     */
    public function create(array $data): bool
    {
        return $this->media->create([
            'filename'      => $data['filename'],
            'original_name' => $data['original_name'],
            'mime_type'     => $data['mime_type'],
            'extension'     => $data['extension'],
            'size'          => $data['size'],
            'path'          => $data['path'],
            'uploaded_by'   => $data['uploaded_by'] ?? null,
        ]);
    }

    /**
     * Update media metadata.
     */
    public function update(int $id, array $data): bool
    {
        return $this->media->update($id, $data);
    }

    /**
     * Delete media.
     */
    public function delete(int $id): bool
    {
        return $this->media->delete($id);
    }
}