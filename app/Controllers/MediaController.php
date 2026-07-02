<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\MediaService;
use App\Services\UploadService;
use App\Core\Flash;

class MediaController extends Controller
{
    private MediaService $mediaService;

    private UploadService $uploadService;

    public function __construct()
    {
        $this->mediaService = new MediaService();
        $this->uploadService = new UploadService();
    }

    /**
     * Display all media.
     */
    public function index(): array
    {
        return $this->mediaService->all();
    }

    /**
     * Display a single media item.
     */
    public function show(int $id): ?array
    {
        return $this->mediaService->find($id);
    }

    /**
     * Handle media upload.
     */
    public function upload(array $file): bool
    {
        $result = $this->uploadService->upload($file, 'media');

        if (!$result['success']) {
            Flash::set('error', $result['message']);
            return false;
        }

        $this->mediaService->create($result['data']);

        Flash::set('success', 'Media uploaded successfully.');

        return true;
    }

    /**
     * Delete a media item.
     */
    public function destroy(int $id): bool
    {
        return $this->mediaService->delete($id);
    }
}