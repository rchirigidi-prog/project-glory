<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;
use PDO;

class SupportRequest extends Model
{
    protected string $table = 'support_requests';

    /**
     * Create a new support request.
     */
    public function create(array $data): bool
    {
        return parent::create($data);
    }

    /**
     * Find request by ID.
     */
    public function find(int $id): ?array
    {
        return parent::find($id);
    }

    /**
     * Delete request.
     */
    public function delete(int $id): bool
    {
        return parent::delete($id);
    }

    /**
     * Update request status.
     */
    public function updateStatus(int $id, string $status): bool
    {
        return parent::update($id, [
            'status' => $status
        ]);
    }

    /**
     * Update admin notes.
     */
    public function updateNotes(int $id, string $notes): bool
    {
        return parent::update($id, [
            'admin_notes' => trim($notes)
        ]);
    }

    /**
     * Update status and admin notes together.
     */
    public function updateRequest(
        int $id,
        string $status,
        string $notes
    ): bool {
        return parent::update($id, [
            'status'      => $status,
            'admin_notes' => trim($notes)
        ]);
    }

    /**
     * Get all requests ordered by newest first.
     */
    public function allLatest(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM {$this->table}
            ORDER BY created_at DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Count all requests.
     */
    public function countAll(): int
    {
        $stmt = $this->db->query("
            SELECT COUNT(*) AS total
            FROM {$this->table}
        ");

        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    /**
     * Count new requests.
     */
    public function countNew(): int
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM {$this->table}
            WHERE status = :status
        ");

        $stmt->execute([
            'status' => 'new'
        ]);

        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    /**
     * Count contacted requests.
     */
    public function countContacted(): int
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM {$this->table}
            WHERE status = :status
        ");

        $stmt->execute([
            'status' => 'contacted'
        ]);

        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    /**
     * Count in-progress requests.
     */
    public function countInProgress(): int
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM {$this->table}
            WHERE status = :status
        ");

        $stmt->execute([
            'status' => 'in_progress'
        ]);

        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    /**
     * Count completed requests.
     */
    public function countCompleted(): int
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM {$this->table}
            WHERE status = :status
        ");

        $stmt->execute([
            'status' => 'completed'
        ]);

        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    /**
     * Get requests by status.
     */
    public function getByStatus(string $status): array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM {$this->table}
            WHERE status = :status
            ORDER BY created_at DESC
        ");

        $stmt->execute([
            'status' => $status
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}