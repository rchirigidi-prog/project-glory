<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use App\Services\PrayerService;

class PrayerController extends Controller
{
    private PrayerService $prayerService;

    public function __construct()
    {
        $this->prayerService = new PrayerService();
    }

    /**
     * Display all prayer requests.
     */
    public function index(): array
    {
        return $this->prayerService->all();
    }

    /**
     * Display one prayer request.
     */
    public function show(int $id): ?array
    {
        return $this->prayerService->find($id);
    }

    /**
     * Create a prayer request.
     */
    public function store(array $data): bool
    {
        if (!$this->validate($data)) {
            return false;
        }

        try {
            $saved = $this->prayerService->create($data);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Prayer request could not be created.'
            );

            return false;
        }

        if (!$saved) {
            Flash::set(
                'error',
                'Prayer request could not be created.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Prayer request created successfully.'
        );

        return true;
    }

    /**
     * Update a prayer request.
     */
    public function update(int $id, array $data): bool
    {
        if (!$this->validate($data)) {
            return false;
        }

        if (!$this->prayerService->find($id)) {
            Flash::set(
                'error',
                'Prayer request was not found.'
            );

            return false;
        }

        try {
            $updated = $this->prayerService->update($id, $data);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Prayer request could not be updated.'
            );

            return false;
        }

        if (!$updated) {
            Flash::set(
                'error',
                'Prayer request could not be updated.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Prayer request updated successfully.'
        );

        return true;
    }

    /**
     * Delete a prayer request.
     */
    public function destroy(int $id): bool
    {
        if (!$this->prayerService->find($id)) {
            Flash::set(
                'error',
                'Prayer request was not found.'
            );

            return false;
        }

        try {
            $deleted = $this->prayerService->delete($id);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Prayer request could not be deleted.'
            );

            return false;
        }

        if (!$deleted) {
            Flash::set(
                'error',
                'Prayer request could not be deleted.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Prayer request deleted successfully.'
        );

        return true;
    }

    /**
     * Validate required fields.
     */
    private function validate(array $data): bool
    {
        $name = trim((string)($data['name'] ?? ''));
        $title = trim((string)($data['title'] ?? ''));
        $request = trim((string)($data['request'] ?? ''));

        if (
            $name === '' ||
            $title === '' ||
            $request === ''
        ) {
            Flash::set(
                'error',
                'Name, title and prayer request are required.'
            );

            return false;
        }

        return true;
    }
}