<?php

namespace App\Services;

class UploadService extends BaseService
{
    /**
     * Allowed file extensions.
     */
    private array $allowedExtensions = [
        'jpg',
        'jpeg',
        'png',
        'gif',
        'webp',
        'svg',
        'mp3',
        'wav',
        'flac',
        'ogg',
        'mp4',
        'pdf',
    ];

    /**
     * Upload a file.
     *
     * @param array  $file      $_FILES['...']
     * @param string $directory Relative directory inside public/storage/uploads
     *
     * @return array
     */
    public function upload(array $file, string $directory = 'media'): array
    {
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            return $this->error('No file was uploaded.');
        }

        $extension = strtolower(
            pathinfo($file['name'], PATHINFO_EXTENSION)
        );

        if (!in_array($extension, $this->allowedExtensions, true)) {
            return $this->error('Unsupported file type.');
        }

        $basePath = ROOT_PATH . '/public/storage/uploads/' . $directory;

        if (!is_dir($basePath)) {
            mkdir($basePath, 0755, true);
        }

        $filename = uniqid('media_', true) . '.' . $extension;

        $destination = $basePath . '/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return $this->error('Failed to upload file.');
        }

        return $this->success('File uploaded successfully.', [
            'filename'      => $filename,
            'original_name' => $file['name'],
            'extension'     => $extension,
            'mime_type'     => mime_content_type($destination),
            'size'          => filesize($destination),
            'path'          => 'storage/uploads/' . $directory . '/' . $filename,
        ]);
    }
}