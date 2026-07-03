<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\MediaController;
use App\Core\Flash;

$controller = new MediaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['media_file'])) {



    if ($controller->upload($_FILES['media_file'])) {
        header('Location: upload.php');
        exit;
    }
}

ob_start();
?>

<h2 class="mb-4">
    <i class="fa-solid fa-cloud-arrow-up"></i>
    Upload Media
</h2>

<?php if (Flash::has('success')): ?>

<div class="alert alert-success alert-dismissible fade show">

    <?= htmlspecialchars(Flash::get('success')) ?>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

<?php endif; ?>

<?php if (Flash::has('error')): ?>

<div class="alert alert-danger alert-dismissible fade show">

    <?= htmlspecialchars(Flash::get('error')) ?>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

<?php endif; ?>

<div class="card shadow">

    <div class="card-body">

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-4">

                <label class="form-label">
                    Select File
                </label>

                <input
                    type="file"
                    name="media_file"
                    class="form-control"
                    required>

                <small class="text-muted">
                    Supported:
                    JPG, PNG, GIF, WEBP, SVG,
                    MP3, WAV, FLAC,
                    MP4, PDF
                </small>

            </div>

            <button
                type="submit"
                class="btn btn-primary">

                <i class="fa-solid fa-upload me-2"></i>

                Upload Media

            </button>

            <a
                href="index.php"
                class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';