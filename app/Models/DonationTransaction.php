<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class DonationTransaction
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Get all donation transactions.
     */
    public function all(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM donation_transactions
            ORDER BY created_at DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find transaction by ID.
     */
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM donation_transactions
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id
        ]);

        $transaction = $stmt->fetch(PDO::FETCH_ASSOC);

        return $transaction ?: null;
    }

    /**
     * Create a donation transaction.
     */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO donation_transactions (

                support_request_id,
                full_name,
                email,
                phone,
                country,

                payment_method,
                amount,
                currency,

                transaction_reference,
                payment_screenshot,
                donor_message,

                status

            ) VALUES (

                :support_request_id,
                :full_name,
                :email,
                :phone,
                :country,

                :payment_method,
                :amount,
                :currency,

                :transaction_reference,
                :payment_screenshot,
                :donor_message,

                :status

            )
        ");

        return $stmt->execute($data);
    }

    /**
     * Update verification status.
     */
    public function updateStatus(
        int $id,
        string $status,
        ?int $verifiedBy = null,
        ?string $remarks = null
    ): bool {

        $stmt = $this->db->prepare("
            UPDATE donation_transactions
            SET

                status = :status,
                verified_by = :verified_by,
                remarks = :remarks,
                verified_at = NOW()

            WHERE id = :id
        ");

        return $stmt->execute([

            'id' => $id,

            'status' => $status,

            'verified_by' => $verifiedBy,

            'remarks' => $remarks

        ]);
    }

    /**
     * Delete transaction.
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM donation_transactions
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id
        ]);
    }

    /**
     * Donation statistics.
     */
    public function stats(): array
    {
        $stmt = $this->db->query("
            SELECT

                COUNT(*) AS total,

                SUM(amount) AS total_amount,

                SUM(status='pending') AS pending,

                SUM(status='verified') AS verified,

                SUM(status='rejected') AS rejected

            FROM donation_transactions
        ");

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }
}