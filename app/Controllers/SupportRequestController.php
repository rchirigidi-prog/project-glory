<?php

declare(strict_types=1);

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
     * Display a single support request.
     */
    public function show(int $id): ?array
    {
        return $this->service->find($id);
    }
/**
 * Store a new support request.
 */
public function store(?array $data = null): array
{
    $data ??= $_POST;

    $saved = $this->service->create($data);

    if (!$saved) {
        return [
            'success' => false,
            'message' => 'Unable to submit your request. Please check all required fields.'
        ];
    }

    return [
        'success' => true,
        'message' => 'Thank you! Your request has been received successfully.'
    ];
}
    /**
     * Delete support request.
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