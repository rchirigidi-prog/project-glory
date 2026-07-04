<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\BibleController;
use App\Core\Flash;

$controller = new BibleController();

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id) {
    Flash::set(
        'error',
        'Invalid Bible reading ID.'
    );

    header('Location: index.php');
    exit;
}

$reading = $controller->show($id);

if (!$reading) {
    Flash::set(
        'error',
        'Bible reading was not found.'
    );

    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($controller->update($id, $_POST)) {
        header('Location: index.php');
        exit;
    }

    $reading = array_merge(
        $reading,
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
            Edit Bible Reading
        </h2>

        <a
            href="index.php"
            class="btn btn-outline-secondary">

            <i class="fa-solid fa-arrow-left"></i>
            Back to Bible Manager

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

    <form method="POST">

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="mb-4">

                    <label class="form-label">
                        Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        required
                        value="<?= htmlspecialchars($reading['title'] ?? '') ?>">

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Bible Reference
                    </label>

                    <input
                        type="text"
                        name="bible_reference"
                        class="form-control"
                        required
                        value="<?= htmlspecialchars($reading['bible_reference'] ?? '') ?>">

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Language
                    </label>

                    <?php
                    $selectedLanguage =
                        $reading['language'] ?? 'English';
                    ?>

                    <select
                        name="language"
                        class="form-select">

                        <option
                            value="English"
                            <?= $selectedLanguage === 'English' ? 'selected' : '' ?>>
                            English
                        </option>

                        <option
                            value="Hindi"
                            <?= $selectedLanguage === 'Hindi' ? 'selected' : '' ?>>
                            Hindi
                        </option>

                        <option
                            value="Telugu"
                            <?= $selectedLanguage === 'Telugu' ? 'selected' : '' ?>>
                            Telugu
                        </option>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Bible Reading Content
                    </label>

                    <textarea
                        name="content"
                        class="form-control"
                        rows="12"
                        required><?= htmlspecialchars($reading['content'] ?? '') ?></textarea>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Status
                    </label>

                    <?php
                    $selectedStatus =
                        $reading['status'] ?? 'draft';
                    ?>

                    <select
                        name="status"
                        class="form-select">

                        <option
                            value="draft"
                            <?= $selectedStatus === 'draft' ? 'selected' : '' ?>>
                            Draft
                        </option>

                        <option
                            value="published"
                            <?= $selectedStatus === 'published' ? 'selected' : '' ?>>
                            Published
                        </option>

                    </select>

                </div>

                <hr>

                <div class="text-end">

                    <a
                        href="index.php"
                        class="btn btn-outline-secondary btn-lg">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary btn-lg">

                        <i class="fa-solid fa-floppy-disk"></i>
                        Update Bible Reading

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
