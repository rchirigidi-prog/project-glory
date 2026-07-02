<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\MediaController;

$controller = new MediaController();

$media = $controller->index();

ob_start();
?>

<h2 class="mb-4">
    <i class="fa-solid fa-photo-film"></i>
    Media Library
</h2>

<div class="mb-4">

    <a href="upload.php" class="btn btn-primary">

        <i class="fa-solid fa-upload"></i>

        Upload Media

    </a>

</div>

<?php if (empty($media)): ?>

<div class="card shadow">

    <div class="card-body text-center py-5">

        <i class="fa-regular fa-folder-open fa-4x text-muted mb-3"></i>

        <h4>No Media Found</h4>

        <p class="text-muted">

            Upload your first image, audio, PDF or video.

        </p>

    </div>

</div>

<?php else: ?>

<div class="row g-4">

<?php foreach ($media as $item): ?>

<div class="col-lg-3 col-md-4 col-sm-6">

<div class="card shadow-sm h-100">

<div class="card-body">

<strong>

<?= htmlspecialchars($item['original_name']) ?>

</strong>

<hr>

<p class="small text-muted">

<?= htmlspecialchars($item['mime_type']) ?>

</p>

<p class="small">

<?= number_format($item['size'] / 1024, 2) ?> KB

</p>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

<?php endif; ?>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';