<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use App\Services\MediaService;
use App\Services\UploadService;

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
        $result = $this->uploadService->upload(
            $file,
            'media'
        );

        if (!$result['success']) {

            Flash::set(
                'error',
                $result['message']
            );

            return false;
        }

        $result['data']['uploaded_by'] =
            $_SESSION['user_id'] ?? null;

        try {

            $saved = $this->mediaService->create(
                $result['data']
            );

        } catch (\Throwable $e) {

            $this->uploadService->delete(
                $result['data']['path']
            );

            Flash::set(
                'error',
                'Media record could not be saved. Uploaded file was removed safely.'
            );

            return false;
        }

        if (!$saved) {

            $this->uploadService->delete(
                $result['data']['path']
            );

            Flash::set(
                'error',
                'Media record could not be saved. Uploaded file was removed safely.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Media uploaded successfully.'
        );

        return true;
    }

    /**
     * Delete media file and database record.
     */
    public function destroy(int $id): bool
    {
        $media = $this->mediaService->find($id);

        if (!$media) {

            Flash::set(
                'error',
                'Media item was not found.'
            );

            return false;
        }

        $fileDeleted = $this->uploadService->delete(
            $media['path']
        );

        if (!$fileDeleted) {

            Flash::set(
                'error',
                'Media file could not be deleted from storage.'
            );

            return false;
        }

        try {

            $recordDeleted =
                $this->mediaService->delete($id);

        } catch (\Throwable $e) {

            Flash::set(
                'error',
                'Media file was removed, but the database record could not be deleted.'
            );

            return false;
        }

        if (!$recordDeleted) {

            Flash::set(
                'error',
                'Media file was removed, but the database record could not be deleted.'
            );

            return false;
        }

        Flash::set(
            'success',
            'Media deleted successfully.'
        );

        return true;
    }
}