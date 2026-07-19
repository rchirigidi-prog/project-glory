<?php

namespace App\Services;

use App\Models\PrayerRequest;

class PrayerService
{
    private PrayerRequest $prayerRequest;

    public function __construct()
    {
        $this->prayerRequest = new PrayerRequest();
    }

    /**
     * Get all prayer requests.
     */
    public function all(): array
    {
        return $this->prayerRequest->allLatest();
    }

    /**
     * Find one prayer request.
     */
    public function find(int $id): ?array
    {
        return $this->prayerRequest->find($id);
    }

    /**
     * Create a prayer request.
     */
    public function create(array $data): bool
    {
        return $this->prayerRequest->create([
            'name'     => trim((string) ($data['name'] ?? '')),
            'email'    => trim((string) ($data['email'] ?? '')),
            'title'    => trim((string) ($data['title'] ?? '')),
            'request'  => trim((string) ($data['request'] ?? '')),
            'category' => trim((string) ($data['category'] ?? 'General')),
            'status'   => $this->normalizeStatus(
                (string) ($data['status'] ?? 'pending')
            ),
        ]);
    }

    /**
     * Update a prayer request.
     */
    public function update(int $id, array $data): bool
    {
        return $this->prayerRequest->update($id, [
            'name'     => trim((string) ($data['name'] ?? '')),
            'email'    => trim((string) ($data['email'] ?? '')),
            'title'    => trim((string) ($data['title'] ?? '')),
            'request'  => trim((string) ($data['request'] ?? '')),
            'category' => trim((string) ($data['category'] ?? 'General')),
            'status'   => $this->normalizeStatus(
                (string) ($data['status'] ?? 'pending')
            ),
        ]);
    }

    /**
     * Delete a prayer request.
     */
    public function delete(int $id): bool
    {
        return $this->prayerRequest->delete($id);
    }

    /**
     * Allow only valid status values.
     */
    private function normalizeStatus(string $status): string
    {
        return match ($status) {
            'approved' => 'approved',
            'answered' => 'answered',
            default => 'pending',
        };
    }
}