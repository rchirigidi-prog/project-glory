<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\SupportRequest;

class SupportRequestService
{
    private SupportRequest $supportRequest;

    public function __construct()
    {
        $this->supportRequest = new SupportRequest();
    }

    /**
     * Get all support requests.
     */
    public function all(): array
    {
        return $this->supportRequest->allLatest();
    }

    /**
     * Find request by ID.
     */
    public function find(int $id): ?array
    {
        return $this->supportRequest->find($id);
    }

    /**
     * Create a new support request.
     */
    public function create(array $data): bool
    {
        $allowedTypes = [
            'prayer',
            'financial',
            'volunteer',
            'sponsor',
        ];

        $requestType = strtolower(trim($data['request_type'] ?? ''));

        if (!in_array($requestType, $allowedTypes, true)) {
            return false;
        }

        $fullName = trim(strip_tags($data['full_name'] ?? ''));
        $email = trim($data['email'] ?? '');
        $message = trim(strip_tags($data['message'] ?? ''));

        if ($fullName === '' || $message === '') {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return $this->supportRequest->create([
            'request_type'  => $requestType,
            'full_name'     => $fullName,
            'email'         => $email,
            'phone'         => trim($data['phone'] ?? ''),
            'country'       => trim($data['country'] ?? ''),
            'subject'       => trim(strip_tags($data['subject'] ?? '')),
            'message'       => $message,
            'ministry_area' => trim(strip_tags($data['ministry_area'] ?? '')),
        ]);
    }

    /**
     * Update request status.
     */
    public function updateStatus(int $id, string $status): bool
    {
        $allowedStatuses = [
            'new',
            'contacted',
            'in_progress',
            'completed',
        ];

        if (!in_array($status, $allowedStatuses, true)) {
            return false;
        }

        return $this->supportRequest->updateStatus($id, $status);
    }

    /**
     * Update admin notes.
     */
    public function updateNotes(int $id, string $notes): bool
    {
        return $this->supportRequest->updateNotes($id, $notes);
    }

    /**
     * Update status and admin notes.
     */
    public function updateRequest(
        int $id,
        string $status,
        string $notes
    ): bool {

        $allowedStatuses = [
            'new',
            'contacted',
            'in_progress',
            'completed',
        ];

        if (!in_array($status, $allowedStatuses, true)) {
            return false;
        }

        return $this->supportRequest->updateRequest(
            $id,
            $status,
            $notes
        );
    }

    /**
     * Delete request.
     */
    public function delete(int $id): bool
    {
        return $this->supportRequest->delete($id);
    }

    /**
     * Dashboard statistics.
     */
    public function dashboardStats(): array
    {
        return [
            'total_requests'     => $this->supportRequest->countAll(),
            'new_requests'       => $this->supportRequest->countNew(),
            'contacted_requests' => $this->supportRequest->countContacted(),
            'progress_requests'  => $this->supportRequest->countInProgress(),
            'completed_requests' => $this->supportRequest->countCompleted(),
        ];
    }
}