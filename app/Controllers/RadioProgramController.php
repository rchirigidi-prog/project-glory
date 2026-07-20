<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use App\Services\RadioProgramService;

class RadioProgramController extends Controller
{
    private RadioProgramService $programService;

    public function __construct()
    {
        $this->programService = new RadioProgramService();
    }

    /**
     * Display all radio programs.
     */
    public function index(): array
    {
        return $this->programService->all();
    }

    /**
     * Display a single radio program.
     */
    public function show(int $id): ?array
    {
        return $this->programService->find($id);
    }

    /**
     * Create a new radio program.
     */
    public function store(array $data): bool
    {
        if ($this->programService->slugExists($data['slug'])) {

            Flash::set(
                'error',
                'A program with this slug already exists.'
            );

            return false;
        }

        $data['created_by'] = $_SESSION['user_id'] ?? null;

        if (!$this->programService->create($data)) {

            Flash::set(
                'error',
                'Unable to create radio program.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Radio program created successfully.'
        );

        return true;
    }

    /**
     * Update an existing radio program.
     */
    public function update(int $id, array $data): bool
    {
        if (!$this->programService->update($id, $data)) {

            Flash::set(
                'error',
                'Unable to update radio program.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Radio program updated successfully.'
        );

        return true;
    }

    /**
     * Delete a radio program.
     */
    public function destroy(int $id): bool
    {
        if (!$this->programService->delete($id)) {

            Flash::set(
                'error',
                'Unable to delete radio program.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Radio program deleted successfully.'
        );

        return true;
    }
 
      /**
     * Get all active programs.
     */
    public function active(): array
    {
        return $this->programService->active();
    }

    /**
     * Find program by slug.
     */
    public function findBySlug(string $slug): ?array
    {
        return $this->programService->findBySlug($slug);
    }  

}