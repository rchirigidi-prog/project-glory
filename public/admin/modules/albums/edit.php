<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AlbumController;
use App\Core\Flash;
use App\Core\ModuleLoader;

$controller = new AlbumController();
$loader = new ModuleLoader();

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id) {
    Flash::set(
        'error',
        'Invalid album ID.'
    );

    header('Location: ' . $loader->url('albums'));
    exit;
}

$album = $controller->show($id);

if (!$album) {
    Flash::set(
        'error',
        'Album was not found.'
    );

    header('Location: ' . $loader->url('albums'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($controller->update($id, $_POST)) {

        header('Location: ' . $loader->url('albums'));
        exit;
    }

    $album = array_merge(
        $album,
        $_POST
    );
}

require_once ADMIN_INCLUDES . '/header.php';
require_once ADMIN_INCLUDES . '/sidebar.php';

?>

<div class="main-wrapper">

<?php require_once __DIR__ . '/../../includes/navbar.php'; ?>

<div class="dashboard">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0">
            <i class="fa-solid fa-pen-to-square"></i>
            Edit Album
        </h2>

        <a
            href="<?= $loader->url('albums') ?>"
            class="btn btn-outline-secondary">

            <i class="fa-solid fa-arrow-left"></i>
            Back to Album Manager

        </a>

    </div>

    <?php if ($message = Flash::get('error')): ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <?= htmlspecialchars($message) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>

    <form method="POST" action="">

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="mb-4">

                    <label class="form-label">
                        Album Title
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        required
                        value="<?= htmlspecialchars($album['title'] ?? '') ?>">

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="6"><?= htmlspecialchars($album['description'] ?? '') ?></textarea>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Language
                        </label>

                        <?php
                        $selectedLanguage = $album['language'] ?? 'English';
                        ?>

                        <select
                            name="language"
                            class="form-select">

                            <option value="English" <?= $selectedLanguage === 'English' ? 'selected' : '' ?>>English</option>
                            <option value="Hindi" <?= $selectedLanguage === 'Hindi' ? 'selected' : '' ?>>Hindi</option>
                            <option value="Telugu" <?= $selectedLanguage === 'Telugu' ? 'selected' : '' ?>>Telugu</option>
                            <option value="Instrumental" <?= $selectedLanguage === 'Instrumental' ? 'selected' : '' ?>>Instrumental</option>
                            <option value="Multi-language" <?= $selectedLanguage === 'Multi-language' ? 'selected' : '' ?>>Multi-language</option>

                        </select>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Release Date
                        </label>

                        <input
                            type="date"
                            name="release_date"
                            class="form-control"
                            value="<?= htmlspecialchars($album['release_date'] ?? '') ?>">

                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Status
                    </label>

                    <?php
                    $selectedStatus = $album['status'] ?? 'draft';
                    ?>

                    <select
                        name="status"
                        class="form-select">

                        <option value="draft" <?= $selectedStatus === 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value="published" <?= $selectedStatus === 'published' ? 'selected' : '' ?>>Published</option>

                    </select>

                </div>

                <hr>

                <div class="text-end">

                    <a
                        href="<?= $loader->url('albums') ?>"
                        class="btn btn-outline-secondary btn-lg">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary btn-lg">

                        <i class="fa-solid fa-floppy-disk"></i>
                        Update Album

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>