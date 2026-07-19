<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use App\Services\ArtistService;

class ArtistController extends Controller
{
    private ArtistService $artistService;

    public function __construct()
    {
        $this->artistService = new ArtistService();
    }

    /**
     * Display all artists.
     */
    public function index(): array
    {
        return $this->artistService->all();
    }

    /**
     * Display one artist.
     */
    public function show(int $id): ?array
    {
        return $this->artistService->find($id);
    }

    /**
     * Create an artist.
     */
    public function store(array $data): bool
    {
        if (!$this->validate($data)) {
            return false;
        }

        try {
            $saved = $this->artistService->create($data);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Artist could not be created.'
            );

            return false;
        }

        if (!$saved) {
            Flash::set(
                'error',
                'Artist could not be created.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Artist created successfully.'
        );

        return true;
    }

    /**
     * Update an artist.
     */
    public function update(int $id, array $data): bool
    {
        if (!$this->validate($data)) {
            return false;
        }

        if (!$this->artistService->find($id)) {
            Flash::set(
                'error',
                'Artist was not found.'
            );

            return false;
        }

        try {
            $updated = $this->artistService->update($id, $data);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Artist could not be updated.'
            );

            return false;
        }

        if (!$updated) {
            Flash::set(
                'error',
                'Artist could not be updated.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Artist updated successfully.'
        );

        return true;
    }

    /**
     * Delete an artist.
     */
    public function destroy(int $id): bool
    {
        if (!$this->artistService->find($id)) {
            Flash::set(
                'error',
                'Artist was not found.'
            );

            return false;
        }

        try {
            $deleted = $this->artistService->delete($id);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Artist could not be deleted.'
            );

            return false;
        }

        if (!$deleted) {
            Flash::set(
                'error',
                'Artist could not be deleted.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Artist deleted successfully.'
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
                'Artist name is required.'
            );

            return false;
        }

        return true;
    }
}