<?php

namespace App\Services;

use App\Models\DonationSetting;
use App\Models\DonationTransaction;

class DonationManagerService
{
    private DonationSetting $settings;
    private DonationTransaction $transactions;

    public function __construct()
    {
        $this->settings = new DonationSetting();
        $this->transactions = new DonationTransaction();
    }

    /**
     * Get donation settings.
     */
    public function settings(): array
    {
        $settings = $this->settings->get();

        if (empty($settings)) {

            $this->settings->create();

            $settings = $this->settings->get();
        }

        return $settings;
    }

    /**
     * Save donation settings.
     */
    public function saveSettings(array $data): bool
    {
        return $this->settings->update($data);
    }

    /**
     * Get all donation transactions.
     */
    public function transactions(): array
    {
        return $this->transactions->all();
    }

    /**
     * Get donation statistics.
     */
    public function stats(): array
    {
        return $this->transactions->stats();
    }

    /**
     * Find one transaction.
     */
    public function findTransaction(int $id): ?array
    {
        return $this->transactions->find($id);
    }

    /**
     * Create transaction.
     */
    public function createTransaction(array $data): bool
    {
        $data['status'] = 'pending';

        $data['currency'] = $data['currency'] ?? 'INR';

        return $this->transactions->create($data);
    }

    /**
     * Verify transaction.
     */
    public function verify(
        int $id,
        int $verifiedBy,
        string $remarks = ''
    ): bool {

        return $this->transactions->updateStatus(
            $id,
            'verified',
            $verifiedBy,
            $remarks
        );
    }

    /**
     * Reject transaction.
     */
    public function reject(
        int $id,
        int $verifiedBy,
        string $remarks = ''
    ): bool {

        return $this->transactions->updateStatus(
            $id,
            'rejected',
            $verifiedBy,
            $remarks
        );
    }

    /**
     * Delete transaction.
     */
    public function deleteTransaction(int $id): bool
    {
        return $this->transactions->delete($id);
    }
}