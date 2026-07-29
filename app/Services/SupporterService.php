<?php

namespace App\Services;

use App\Models\Supporter;
use App\Models\Media;

class SupporterService
{
    private Supporter $supporter;
    private Media $media;

    public function __construct()
    {
        $this->supporter = new Supporter();
        $this->media = new Media();
    }

    /**
     * Get all supporters.
     */
    public function all(): array
    {
        return $this->supporter->allLatest();
    }

    /**
     * Get featured supporters for the website.
     */
    public function featured(int $limit = 6): array
    {
        $supporters = $this->supporter->featured($limit);

        foreach ($supporters as &$supporter) {

            $supporter['photo'] = null;

            if (!empty($supporter['photo_media_id'])) {
                $supporter['photo'] = $this->media->findById(
                    (int) $supporter['photo_media_id']
                );
            }
        }

        return $supporters;
    }

    /**
     * Find one supporter.
     */
    public function find(int $id): ?array
    {
        return $this->supporter->find($id);
    }

    /**
     * Create a supporter.
     */
    public function create(array $data): bool
    {
        return $this->supporter->create([
            'name'           => trim((string) ($data['name'] ?? '')),
            'email'          => trim((string) ($data['email'] ?? '')),
            'phone'          => trim((string) ($data['phone'] ?? '')),
            'country'        => trim((string) ($data['country'] ?? '')),
            'city'           => trim((string) ($data['city'] ?? '')),
            'photo_media_id' => !empty($data['photo_media_id']) ? (int) $data['photo_media_id'] : null,
            'message'        => trim((string) ($data['message'] ?? '')),
            'support_type'   => $this->normalizeSupportType(
                (string) ($data['support_type'] ?? 'Prayer')
            ),
            'amount'         => !empty($data['amount']) ? (float) $data['amount'] : null,
            'currency'       => strtoupper(trim((string) ($data['currency'] ?? 'INR'))),
            'is_featured'    => !empty($data['is_featured']) ? 1 : 0,
            'status'         => $this->normalizeStatus(
                (string) ($data['status'] ?? 'active')
            ),
            'display_order'  => (int) ($data['display_order'] ?? 0),
        ]);
    }

    /**
     * Update a supporter.
     */
    public function update(int $id, array $data): bool
    {
        return $this->supporter->update($id, [
            'name'           => trim((string) ($data['name'] ?? '')),
            'email'          => trim((string) ($data['email'] ?? '')),
            'phone'          => trim((string) ($data['phone'] ?? '')),
            'country'        => trim((string) ($data['country'] ?? '')),
            'city'           => trim((string) ($data['city'] ?? '')),
            'photo_media_id' => !empty($data['photo_media_id']) ? (int) $data['photo_media_id'] : null,
            'message'        => trim((string) ($data['message'] ?? '')),
            'support_type'   => $this->normalizeSupportType(
                (string) ($data['support_type'] ?? 'Prayer')
            ),
            'amount'         => !empty($data['amount']) ? (float) $data['amount'] : null,
            'currency'       => strtoupper(trim((string) ($data['currency'] ?? 'INR'))),
            'is_featured'    => !empty($data['is_featured']) ? 1 : 0,
            'status'         => $this->normalizeStatus(
                (string) ($data['status'] ?? 'active')
            ),
            'display_order'  => (int) ($data['display_order'] ?? 0),
        ]);
    }

    /**
     * Delete a supporter.
     */
    public function delete(int $id): bool
    {
        return $this->supporter->delete($id);
    }

    private function normalizeSupportType(string $type): string
    {
        return match ($type) {
            'Volunteer'         => 'Volunteer',
            'One Time Donation' => 'One Time Donation',
            'Monthly Partner'   => 'Monthly Partner',
            'Sponsor'           => 'Sponsor',
            default             => 'Prayer',
        };
    }

    private function normalizeStatus(string $status): string
    {
        return match ($status) {
            'inactive' => 'inactive',
            default    => 'active',
        };
    }
}