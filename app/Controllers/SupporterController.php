<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use App\Services\SupporterService;

class SupporterController extends Controller
{
    private SupporterService $supporterService;

    public function __construct()
    {
        $this->supporterService = new SupporterService();
    }

    /**
     * Display all supporters.
     */
    public function index(): array
    {
        return $this->supporterService->all();
    }

    /**
     * Display one supporter.
     */
    public function show(int $id): ?array
    {
        return $this->supporterService->find($id);
    }

    /**
     * Create a supporter.
     */
    public function store(array $data): bool
    {
        if (!$this->validate($data)) {
            return false;
        }

        try {
            $saved = $this->supporterService->create($data);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Supporter could not be created.'
            );

            return false;
        }

        if (!$saved) {
            Flash::set(
                'error',
                'Supporter could not be created.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Supporter created successfully.'
        );

        return true;
    }

    /**
     * Update a supporter.
     */
    public function update(int $id, array $data): bool
    {
        if (!$this->validate($data)) {
            return false;
        }

        if (!$this->supporterService->find($id)) {
            Flash::set(
                'error',
                'Supporter was not found.'
            );

            return false;
        }

        try {
            $updated = $this->supporterService->update($id, $data);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Supporter could not be updated.'
            );

            return false;
        }

        if (!$updated) {
            Flash::set(
                'error',
                'Supporter could not be updated.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Supporter updated successfully.'
        );

        return true;
    }

    /**
     * Delete a supporter.
     */
    public function destroy(int $id): bool
    {
        if (!$this->supporterService->find($id)) {
            Flash::set(
                'error',
                'Supporter was not found.'
            );

            return false;
        }

        try {
            $deleted = $this->supporterService->delete($id);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Supporter could not be deleted.'
            );

            return false;
        }

        if (!$deleted) {
            Flash::set(
                'error',
                'Supporter could not be deleted.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Supporter deleted successfully.'
        );

        return true;
    }

    /**
     * Validate required fields.
     */
    private function validate(array $data): bool
    {
        $name = trim((string) ($data['name'] ?? ''));

        if ($name === '') {
            Flash::set(
                'error',
                'Supporter name is required.'
            );

            return false;
        }

        return true;
    }
}