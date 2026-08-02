<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\DonationManagerService;

class DonationManagerController
{
    private DonationManagerService $service;

    public function __construct()
    {
        $this->service = new DonationManagerService();
    }

    /**
     * Dashboard
     */
    public function index(): array
    {
        return [
            'stats' => $this->service->stats(),
        ];
    }

    /**
     * Donation Settings
     */
    public function settings(): array
    {
        return $this->service->settings();
    }

    /**
     * Save Donation Settings
     */
    public function saveSettings(array $data): bool
    {
        return $this->service->saveSettings($data);
    }

    /**
     * List Transactions
     */
    public function transactions(): array
    {
        return $this->service->transactions();
    }

    /**
     * View Transaction
     */
    public function transaction(int $id): ?array
    {
        return $this->service->findTransaction($id);
    }

    /**
     * Verify Donation
     */
    public function verify(
        int $id,
        int $verifiedBy,
        string $remarks = ''
    ): bool {
        return $this->service->verify(
            $id,
            $verifiedBy,
            $remarks
        );
    }

    /**
     * Reject Donation
     */
    public function reject(
        int $id,
        int $verifiedBy,
        string $remarks = ''
    ): bool {
        return $this->service->reject(
            $id,
            $verifiedBy,
            $remarks
        );
    }

    /**
     * Delete Transaction
     */
    public function delete(int $id): bool
    {
        return $this->service->deleteTransaction($id);
    }
}