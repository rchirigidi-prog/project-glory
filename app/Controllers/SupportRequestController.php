<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use App\Services\SupportRequestService;

class SupportRequestController extends Controller
{
    private SupportRequestService $service;

    public function __construct()
    {
        $this->service = new SupportRequestService();
    }

    /**
     * Display all support requests.
     */
    public function index(): array
    {
        return $this->service->all();
    }

    /**
     * Display a single request.
     */
    public function show(int $id): ?array
    {
        return $this->service->find($id);
    }

    /**
     * Store a new support request.
     */
    public function store(array $data): bool
    {
        $saved = $this->service->create($data);

        if (!$saved) {

            Flash::set(
                'error',
                'Unable to submit your request. Please check the required fields.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Thank you! Your request has been received. We will contact you soon.'
        );

        return true;
    }

    /**
     * Update request status.
     */
    public function updateStatus(int $id, string $status): bool
    {
        $updated = $this->service->updateStatus($id, $status);

        if (!$updated) {

            Flash::set(
                'error',
                'Unable to update request status.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Request status updated successfully.'
        );

        return true;
    }

    /**
     * Delete a support request.
     */
    public function destroy(int $id): bool
    {
        $deleted = $this->service->delete($id);

        if (!$deleted) {

            Flash::set(
                'error',
                'Support request could not be deleted.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Support request deleted successfully.'
        );

        return true;
    }

    /**
     * Dashboard statistics.
     */
    public function dashboardStats(): array
    {
        return $this->service->dashboardStats();
    }
}