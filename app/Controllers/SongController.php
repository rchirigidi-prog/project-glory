<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use App\Services\SongService;

class SongController extends Controller
{
    private SongService $songService;

    public function __construct()
    {
        $this->songService = new SongService();
    }

    /**
     * Display all songs.
     */
    public function index(): array
    {
        return $this->songService->all();
    }

    /**
     * Display one song.
     */
    public function show(int $id): ?array
    {
        return $this->songService->find($id);
    }

    /**
     * Create a song.
     */
    public function store(array $data): bool
    {
        if (!$this->validate($data)) {
            return false;
        }

        try {
            $saved = $this->songService->create($data);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Song could not be created.'
            );

            return false;
        }

        if (!$saved) {
            Flash::set(
                'error',
                'Song could not be created.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Song created successfully.'
        );

        return true;
    }

    /**
     * Update a song.
     */
    public function update(int $id, array $data): bool
    {
        if (!$this->validate($data)) {
            return false;
        }

        if (!$this->songService->find($id)) {
            Flash::set(
                'error',
                'Song was not found.'
            );

            return false;
        }

        try {
            $updated = $this->songService->update($id, $data);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Song could not be updated.'
            );

            return false;
        }

        if (!$updated) {
            Flash::set(
                'error',
                'Song could not be updated.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Song updated successfully.'
        );

        return true;
    }

    /**
     * Delete a song.
     */
    public function destroy(int $id): bool
    {
        if (!$this->songService->find($id)) {
            Flash::set(
                'error',
                'Song was not found.'
            );

            return false;
        }

        try {
            $deleted = $this->songService->delete($id);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Song could not be deleted.'
            );

            return false;
        }

        if (!$deleted) {
            Flash::set(
                'error',
                'Song could not be deleted.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Song deleted successfully.'
        );

        return true;
    }

    /**
     * Validate required fields.
     */
    private function validate(array $data): bool
    {
        $title = trim((string) ($data['title'] ?? ''));

        if ($title === '') {
            Flash::set(
                'error',
                'Song title is required.'
            );

            return false;
        }

        return true;
    }
}