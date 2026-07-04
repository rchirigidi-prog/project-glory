<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use App\Services\BibleService;

class BibleController extends Controller
{
    private BibleService $bibleService;

    public function __construct()
    {
        $this->bibleService = new BibleService();
    }

    /**
     * Display all Bible readings.
     */
    public function index(): array
    {
        return $this->bibleService->all();
    }

    /**
     * Display one Bible reading.
     */
    public function show(int $id): ?array
    {
        return $this->bibleService->find($id);
    }

    /**
     * Create a Bible reading.
     */
    public function store(array $data): bool
    {
        if (!$this->validate($data)) {
            return false;
        }

        try {
            $saved = $this->bibleService->create($data);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Bible reading could not be created.'
            );

            return false;
        }

        if (!$saved) {
            Flash::set(
                'error',
                'Bible reading could not be created.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Bible reading created successfully.'
        );

        return true;
    }

    /**
     * Update a Bible reading.
     */
    public function update(int $id, array $data): bool
    {
        if (!$this->validate($data)) {
            return false;
        }

        if (!$this->bibleService->find($id)) {
            Flash::set(
                'error',
                'Bible reading was not found.'
            );

            return false;
        }

        try {
            $updated = $this->bibleService->update(
                $id,
                $data
            );
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Bible reading could not be updated.'
            );

            return false;
        }

        if (!$updated) {
            Flash::set(
                'error',
                'Bible reading could not be updated.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Bible reading updated successfully.'
        );

        return true;
    }

    /**
     * Delete a Bible reading.
     */
    public function destroy(int $id): bool
    {
        if (!$this->bibleService->find($id)) {
            Flash::set(
                'error',
                'Bible reading was not found.'
            );

            return false;
        }

        try {
            $deleted = $this->bibleService->delete($id);
        } catch (\Throwable $e) {
            Flash::set(
                'error',
                'Bible reading could not be deleted.'
            );

            return false;
        }

        if (!$deleted) {
            Flash::set(
                'error',
                'Bible reading could not be deleted.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Bible reading deleted successfully.'
        );

        return true;
    }

    /**
     * Validate required Bible reading fields.
     */
    private function validate(array $data): bool
    {
        $title = trim((string) ($data['title'] ?? ''));
        $reference = trim(
            (string) ($data['bible_reference'] ?? '')
        );
        $content = trim((string) ($data['content'] ?? ''));

        if (
            $title === '' ||
            $reference === '' ||
            $content === ''
        ) {
            Flash::set(
                'error',
                'Title, Bible reference and content are required.'
            );

            return false;
        }

        return true;
    }
}
