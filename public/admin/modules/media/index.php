<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\MediaController;
use App\Core\Flash;

$controller = new MediaController();

/*
|--------------------------------------------------------------------------
| Handle Delete Request
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? '';

    if ($action === 'delete') {

        $mediaId = filter_input(
            INPUT_POST,
            'media_id',
            FILTER_VALIDATE_INT
        );

        if ($mediaId && $mediaId > 0) {

            $controller->destroy($mediaId);

        } else {

            Flash::set(
                'error',
                'Invalid media item.'
            );
        }

        header('Location: index.php');
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| Load Media Library
|--------------------------------------------------------------------------
*/

$media = $controller->index();

$totalMedia = count($media);

/*
|--------------------------------------------------------------------------
| Request Filters
|--------------------------------------------------------------------------
*/

$search = trim(
    (string) ($_GET['search'] ?? '')
);

$type = strtolower(
    trim((string) ($_GET['type'] ?? 'all'))
);

$sort = strtolower(
    trim((string) ($_GET['sort'] ?? 'newest'))
);

$allowedTypes = [
    'all',
    'image',
    'audio',
    'video',
    'pdf',
];

$allowedSorts = [
    'newest',
    'oldest',
    'name_asc',
    'name_desc',
    'size_asc',
    'size_desc',
];

if (!in_array($type, $allowedTypes, true)) {
    $type = 'all';
}

if (!in_array($sort, $allowedSorts, true)) {
    $sort = 'newest';
}

/*
|--------------------------------------------------------------------------
| Helper: Human Readable File Size
|--------------------------------------------------------------------------
*/

function formatFileSize(int $bytes): string
{
    if ($bytes >= 1073741824) {
        return number_format(
            $bytes / 1073741824,
            2
        ) . ' GB';
    }

    if ($bytes >= 1048576) {
        return number_format(
            $bytes / 1048576,
            2
        ) . ' MB';
    }

    if ($bytes >= 1024) {
        return number_format(
            $bytes / 1024,
            2
        ) . ' KB';
    }

    return $bytes . ' bytes';
}

/*
|--------------------------------------------------------------------------
| Helper: Detect Media Type
|--------------------------------------------------------------------------
*/

function getMediaType(string $mimeType): string
{
    if (str_starts_with($mimeType, 'image/')) {
        return 'image';
    }

    if (str_starts_with($mimeType, 'audio/')) {
        return 'audio';
    }

    if (str_starts_with($mimeType, 'video/')) {
        return 'video';
    }

    if ($mimeType === 'application/pdf') {
        return 'pdf';
    }

    return 'file';
}

/*
|--------------------------------------------------------------------------
| Search and Type Filtering
|--------------------------------------------------------------------------
*/

$media = array_values(
    array_filter(
        $media,
        function (array $item) use ($search, $type): bool {

            $itemType = getMediaType(
                $item['mime_type']
            );

            if (
                $type !== 'all' &&
                $itemType !== $type
            ) {
                return false;
            }

            if ($search !== '') {

                $haystack = strtolower(
                    implode(
                        ' ',
                        [
                            $item['original_name'] ?? '',
                            $item['filename'] ?? '',
                            $item['mime_type'] ?? '',
                            $item['extension'] ?? '',
                            $item['uploader_name'] ?? '',
                        ]
                    )
                );

                if (
                    !str_contains(
                        $haystack,
                        strtolower($search)
                    )
                ) {
                    return false;
                }
            }

            return true;
        }
    )
);

/*
|--------------------------------------------------------------------------
| Sorting
|--------------------------------------------------------------------------
*/

usort(
    $media,
    function (array $a, array $b) use ($sort): int {

        return match ($sort) {

            'oldest' =>
                strtotime($a['created_at']) <=>
                strtotime($b['created_at']),

            'name_asc' =>
                strcasecmp(
                    $a['original_name'],
                    $b['original_name']
                ),

            'name_desc' =>
                strcasecmp(
                    $b['original_name'],
                    $a['original_name']
                ),

            'size_asc' =>
                (int) $a['size'] <=>
                (int) $b['size'],

            'size_desc' =>
                (int) $b['size'] <=>
                (int) $a['size'],

            default =>
                strtotime($b['created_at']) <=>
                strtotime($a['created_at']),
        };
    }
);

$filteredMediaCount = count($media);

ob_start();

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">

            <i class="fa-solid fa-photo-film me-2"></i>

            Media Library

        </h2>

        <p class="text-muted mb-0">

            Manage images, audio, video and documents.

        </p>

    </div>

    <a
        href="upload.php"
        class="btn btn-primary"
    >

        <i class="fa-solid fa-cloud-arrow-up me-2"></i>

        Upload Media

    </a>

</div>


<?php if (Flash::has('success')): ?>

<div class="alert alert-success alert-dismissible fade show">

    <i class="fa-solid fa-circle-check me-2"></i>

    <?= htmlspecialchars(
        Flash::get('success'),
        ENT_QUOTES,
        'UTF-8'
    ) ?>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
    ></button>

</div>

<?php endif; ?>


<?php if (Flash::has('error')): ?>

<div class="alert alert-danger alert-dismissible fade show">

    <i class="fa-solid fa-circle-exclamation me-2"></i>

    <?= htmlspecialchars(
        Flash::get('error'),
        ENT_QUOTES,
        'UTF-8'
    ) ?>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
    ></button>

</div>

<?php endif; ?>


<!-- Search, Filter and Sort -->

<div class="card shadow-sm mb-4">

    <div class="card-body">

        <form method="GET">

            <div class="row g-3 align-items-end">


                <div class="col-lg-5 col-md-12">

                    <label class="form-label">

                        <i class="fa-solid fa-magnifying-glass me-1"></i>

                        Search Media

                    </label>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $search,
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                        placeholder="Search by filename, type or uploader"
                    >

                </div>


                <div class="col-lg-2 col-md-4">

                    <label class="form-label">

                        <i class="fa-solid fa-filter me-1"></i>

                        Media Type

                    </label>

                    <select
                        name="type"
                        class="form-select"
                    >

                        <option
                            value="all"
                            <?= $type === 'all' ? 'selected' : '' ?>
                        >
                            All Media
                        </option>

                        <option
                            value="image"
                            <?= $type === 'image' ? 'selected' : '' ?>
                        >
                            Images
                        </option>

                        <option
                            value="audio"
                            <?= $type === 'audio' ? 'selected' : '' ?>
                        >
                            Audio
                        </option>

                        <option
                            value="video"
                            <?= $type === 'video' ? 'selected' : '' ?>
                        >
                            Video
                        </option>

                        <option
                            value="pdf"
                            <?= $type === 'pdf' ? 'selected' : '' ?>
                        >
                            PDF
                        </option>

                    </select>

                </div>


                <div class="col-lg-3 col-md-4">

                    <label class="form-label">

                        <i class="fa-solid fa-arrow-down-wide-short me-1"></i>

                        Sort By

                    </label>

                    <select
                        name="sort"
                        class="form-select"
                    >

                        <option
                            value="newest"
                            <?= $sort === 'newest' ? 'selected' : '' ?>
                        >
                            Newest First
                        </option>

                        <option
                            value="oldest"
                            <?= $sort === 'oldest' ? 'selected' : '' ?>
                        >
                            Oldest First
                        </option>

                        <option
                            value="name_asc"
                            <?= $sort === 'name_asc' ? 'selected' : '' ?>
                        >
                            Name A-Z
                        </option>

                        <option
                            value="name_desc"
                            <?= $sort === 'name_desc' ? 'selected' : '' ?>
                        >
                            Name Z-A
                        </option>

                        <option
                            value="size_asc"
                            <?= $sort === 'size_asc' ? 'selected' : '' ?>
                        >
                            Smallest First
                        </option>

                        <option
                            value="size_desc"
                            <?= $sort === 'size_desc' ? 'selected' : '' ?>
                        >
                            Largest First
                        </option>

                    </select>

                </div>


                <div class="col-lg-2 col-md-4">

                    <div class="d-grid gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="fa-solid fa-search me-1"></i>

                            Apply

                        </button>

                        <a
                            href="index.php"
                            class="btn btn-outline-secondary btn-sm"
                        >
                            Reset
                        </a>

                    </div>

                </div>


            </div>

        </form>

    </div>

</div>


<!-- Media Statistics -->

<div class="card shadow-sm mb-4">

    <div class="card-body">

        <div class="row align-items-center">

            <div class="col-md-6">

                <strong>

                    <i class="fa-solid fa-database me-2"></i>

                    Total Media:

                </strong>

                <?= $totalMedia ?>

            </div>

            <div class="col-md-6 text-md-end">

                <span class="text-muted">
                    Showing:
                </span>

                <strong>
                    <?= $filteredMediaCount ?>
                </strong>

                <span class="text-muted">
                    result<?= $filteredMediaCount === 1 ? '' : 's' ?>
                </span>

            </div>

        </div>

    </div>

</div>


<?php if (empty($media)): ?>

<div class="card shadow-sm">

    <div class="card-body text-center py-5">

        <i
            class="fa-solid fa-magnifying-glass fa-4x text-muted mb-3"
        ></i>

        <h4>
            No Media Found
        </h4>

        <p class="text-muted mb-4">

            No media items match the current search or filter.

        </p>

        <a
            href="index.php"
            class="btn btn-outline-primary"
        >

            <i class="fa-solid fa-rotate-left me-2"></i>

            Clear Search and Filters

        </a>

    </div>

</div>

<?php else: ?>

<div class="row g-4">

<?php foreach ($media as $item): ?>

<?php

$mediaType = getMediaType(
    $item['mime_type']
);

$mediaUrl = '/' . ltrim(
    $item['path'],
    '/'
);

$uploaderName = !empty($item['uploader_name'])
    ? $item['uploader_name']
    : 'Legacy Upload';

?>

<div class="col-xl-3 col-lg-4 col-md-6">

    <div class="card shadow-sm h-100 overflow-hidden">


        <!-- Media Preview -->

        <div
            class="bg-light d-flex align-items-center justify-content-center"
            style="height: 220px; overflow: hidden;"
        >


            <?php if ($mediaType === 'image'): ?>

                <img
                    src="<?= htmlspecialchars(
                        $mediaUrl,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    alt="<?= htmlspecialchars(
                        $item['original_name'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    loading="lazy"
                    style="
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    "
                >


            <?php elseif ($mediaType === 'audio'): ?>

                <div class="text-center w-100 px-3">

                    <i
                        class="fa-solid fa-music fa-4x text-primary mb-4"
                    ></i>

                    <audio
                        controls
                        preload="metadata"
                        class="w-100"
                    >

                        <source
                            src="<?= htmlspecialchars(
                                $mediaUrl,
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>"
                            type="<?= htmlspecialchars(
                                $item['mime_type'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>"
                        >

                    </audio>

                </div>


            <?php elseif ($mediaType === 'video'): ?>

                <video
                    controls
                    preload="metadata"
                    style="
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    "
                >

                    <source
                        src="<?= htmlspecialchars(
                            $mediaUrl,
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                        type="<?= htmlspecialchars(
                            $item['mime_type'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                    >

                </video>


            <?php elseif ($mediaType === 'pdf'): ?>

                <div class="text-center">

                    <i
                        class="fa-solid fa-file-pdf fa-5x text-danger mb-3"
                    ></i>

                    <div>

                        <a
                            href="<?= htmlspecialchars(
                                $mediaUrl,
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>"
                            target="_blank"
                            rel="noopener"
                            class="btn btn-outline-danger btn-sm"
                        >

                            <i class="fa-solid fa-eye me-1"></i>

                            View PDF

                        </a>

                    </div>

                </div>


            <?php else: ?>

                <div class="text-center">

                    <i
                        class="fa-solid fa-file fa-5x text-secondary"
                    ></i>

                </div>

            <?php endif; ?>


        </div>


        <!-- Media Information -->

        <div class="card-body">

            <div class="mb-2">

                <?php if ($mediaType === 'image'): ?>

                    <span class="badge text-bg-success">
                        IMAGE
                    </span>

                <?php elseif ($mediaType === 'audio'): ?>

                    <span class="badge text-bg-primary">
                        AUDIO
                    </span>

                <?php elseif ($mediaType === 'video'): ?>

                    <span class="badge text-bg-warning">
                        VIDEO
                    </span>

                <?php elseif ($mediaType === 'pdf'): ?>

                    <span class="badge text-bg-danger">
                        PDF
                    </span>

                <?php else: ?>

                    <span class="badge text-bg-secondary">
                        FILE
                    </span>

                <?php endif; ?>

            </div>


            <h6
                class="card-title"
                title="<?= htmlspecialchars(
                    $item['original_name'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>"
            >

                <?= htmlspecialchars(
                    mb_strimwidth(
                        $item['original_name'],
                        0,
                        40,
                        '...'
                    ),
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>

            </h6>


            <div class="small text-muted">


                <div class="mb-1">

                    <i class="fa-solid fa-hard-drive me-1"></i>

                    <?= formatFileSize(
                        (int) $item['size']
                    ) ?>

                </div>


                <div class="mb-1">

                    <i class="fa-solid fa-file-code me-1"></i>

                    <?= htmlspecialchars(
                        strtoupper(
                            $item['extension']
                        ),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>

                </div>


                <?php if (!empty($item['created_at'])): ?>

                <div class="mb-1">

                    <i class="fa-regular fa-calendar me-1"></i>

                    <?= date(
                        'd M Y, h:i A',
                        strtotime($item['created_at'])
                    ) ?>

                </div>

                <?php endif; ?>


                <div class="mt-1">

                    <i class="fa-solid fa-user me-1"></i>

                    Uploaded by:

                    <?= htmlspecialchars(
                        $uploaderName,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>

                </div>


            </div>

        </div>


        <!-- Card Actions -->

        <div class="card-footer bg-white">

            <div class="d-grid gap-2">


                <a
                    href="<?= htmlspecialchars(
                        $mediaUrl,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    target="_blank"
                    rel="noopener"
                    class="btn btn-outline-primary btn-sm"
                >

                    <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>

                    Open File

                </a>


                <form
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this media item? This action cannot be undone.');"
                >

                    <input
                        type="hidden"
                        name="action"
                        value="delete"
                    >

                    <input
                        type="hidden"
                        name="media_id"
                        value="<?= (int) $item['id'] ?>"
                    >

                    <button
                        type="submit"
                        class="btn btn-outline-danger btn-sm w-100"
                    >

                        <i class="fa-solid fa-trash me-1"></i>

                        Delete

                    </button>

                </form>


            </div>

        </div>

    </div>

</div>

<?php endforeach; ?>

</div>

<?php endif; ?>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';