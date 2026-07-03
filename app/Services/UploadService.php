<?php

namespace App\Services;

class UploadService extends BaseService
{
    /**
     * Maximum upload size: 100 MB.
     */
    private const MAX_FILE_SIZE = 100 * 1024 * 1024;

    /**
     * Allowed extensions and MIME types.
     */
    private array $allowedTypes = [

        'jpg' => [
            'image/jpeg',
        ],

        'jpeg' => [
            'image/jpeg',
        ],

        'png' => [
            'image/png',
        ],

        'gif' => [
            'image/gif',
        ],

        'webp' => [
            'image/webp',
        ],

        'mp3' => [
            'audio/mpeg',
            'audio/mp3',
        ],

        'wav' => [
            'audio/wav',
            'audio/x-wav',
            'audio/wave',
        ],

        'flac' => [
            'audio/flac',
            'audio/x-flac',
        ],

        'ogg' => [
            'audio/ogg',
            'application/ogg',
        ],

        'mp4' => [
            'video/mp4',
        ],

        'pdf' => [
            'application/pdf',
        ],
    ];

    /**
     * Upload a file.
     */
    public function upload(
        array $file,
        string $directory = 'media'
    ): array {

        /*
        |--------------------------------------------------------------------------
        | Validate Upload Error
        |--------------------------------------------------------------------------
        */

        $error = $file['error'] ?? UPLOAD_ERR_NO_FILE;

        if ($error !== UPLOAD_ERR_OK) {

            return $this->error(
                $this->uploadErrorMessage($error)
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Validate Temporary File
        |--------------------------------------------------------------------------
        */

        $temporaryFile = $file['tmp_name'] ?? '';

        if (
            $temporaryFile === '' ||
            !is_uploaded_file($temporaryFile)
        ) {
            return $this->error(
                'Invalid uploaded file.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Validate File Size
        |--------------------------------------------------------------------------
        */

        $fileSize = (int) ($file['size'] ?? 0);

        if ($fileSize <= 0) {
            return $this->error(
                'The uploaded file is empty.'
            );
        }

        if ($fileSize > self::MAX_FILE_SIZE) {
            return $this->error(
                'File size exceeds the 100 MB limit.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Validate Extension
        |--------------------------------------------------------------------------
        */

        $originalName = basename(
            (string) ($file['name'] ?? '')
        );

        $extension = strtolower(
            pathinfo(
                $originalName,
                PATHINFO_EXTENSION
            )
        );

        if (!array_key_exists($extension, $this->allowedTypes)) {
            return $this->error(
                'Unsupported file extension.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Detect and Validate MIME Type
        |--------------------------------------------------------------------------
        */

        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        if ($finfo === false) {
            return $this->error(
                'Unable to inspect uploaded file.'
            );
        }

        $mimeType = finfo_file(
            $finfo,
            $temporaryFile
        );

        finfo_close($finfo);

        if (
            $mimeType === false ||
            !in_array(
                $mimeType,
                $this->allowedTypes[$extension],
                true
            )
        ) {
            return $this->error(
                'File content does not match its extension.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Prepare Upload Directory
        |--------------------------------------------------------------------------
        */

        $safeDirectory = trim(
            str_replace(['..', '\\'], '', $directory),
            '/'
        );

        if ($safeDirectory === '') {
            $safeDirectory = 'media';
        }

        $relativeDirectory =
            'storage/uploads/' . $safeDirectory;

        $basePath =
            ROOT_PATH . '/public/' . $relativeDirectory;

        if (
            !is_dir($basePath) &&
            !mkdir($basePath, 0755, true) &&
            !is_dir($basePath)
        ) {
            return $this->error(
                'Unable to create upload directory.'
            );
        }

        if (!is_writable($basePath)) {
            return $this->error(
                'Upload directory is not writable.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Generate Secure Filename
        |--------------------------------------------------------------------------
        */

        try {

            $filename =
                'media_' .
                bin2hex(random_bytes(16)) .
                '.' .
                $extension;

        } catch (\Throwable $e) {

            return $this->error(
                'Unable to generate a secure filename.'
            );
        }

        $destination =
            $basePath . '/' . $filename;

        /*
        |--------------------------------------------------------------------------
        | Move Uploaded File
        |--------------------------------------------------------------------------
        */

        if (
            !move_uploaded_file(
                $temporaryFile,
                $destination
            )
        ) {
            return $this->error(
                'Failed to move uploaded file.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Return Metadata
        |--------------------------------------------------------------------------
        */

        return $this->success(
            'File uploaded successfully.',
            [
                'filename'      => $filename,
                'original_name' => $originalName,
                'extension'     => $extension,
                'mime_type'     => $mimeType,
                'size'          => filesize($destination),
                'path'          =>
                    $relativeDirectory . '/' . $filename,
            ]
        );
    }

    /**
     * Delete a previously uploaded file.
     */
    public function delete(string $relativePath): bool
    {
        $relativePath = ltrim(
            str_replace('\\', '/', $relativePath),
            '/'
        );

        if (
            str_contains($relativePath, '..') ||
            !str_starts_with(
                $relativePath,
                'storage/uploads/'
            )
        ) {
            return false;
        }

        $fullPath =
            ROOT_PATH . '/public/' . $relativePath;

        if (!is_file($fullPath)) {
            return true;
        }

        return unlink($fullPath);
    }

    /**
     * Convert PHP upload errors to readable messages.
     */
    private function uploadErrorMessage(int $error): string
    {
        return match ($error) {

            UPLOAD_ERR_INI_SIZE =>
                'The file exceeds the server upload limit.',

            UPLOAD_ERR_FORM_SIZE =>
                'The file exceeds the form upload limit.',

            UPLOAD_ERR_PARTIAL =>
                'The file was only partially uploaded.',

            UPLOAD_ERR_NO_FILE =>
                'No file was selected.',

            UPLOAD_ERR_NO_TMP_DIR =>
                'The server temporary directory is missing.',

            UPLOAD_ERR_CANT_WRITE =>
                'The server could not write the uploaded file.',

            UPLOAD_ERR_EXTENSION =>
                'A server extension stopped the upload.',

            default =>
                'An unknown upload error occurred.',
        };
    }
}