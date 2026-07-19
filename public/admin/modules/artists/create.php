<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\ArtistController;
use App\Core\Flash;

$controller = new ArtistController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($controller->store($_POST)) {

        header('Location: index.php');
        exit;
    }
}

require_once ADMIN_INCLUDES . '/header.php';
require_once ADMIN_INCLUDES . '/sidebar.php';

?>

<div class="main-wrapper">

<?php require_once __DIR__ . '/../../includes/navbar.php'; ?>

<div class="dashboard">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0">

            <i class="fa-solid fa-microphone"></i>

            Create Artist

        </h2>

        <a
            href="index.php"
            class="btn btn-outline-secondary">

            <i class="fa-solid fa-arrow-left"></i>

            Back to Artist Manager

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

                        Artist Name
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        required
                        value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">

                </div>

                <div class="mb-4">

                    <label class="form-label">

                        Biography

                    </label>

                    <textarea
                        name="biography"
                        class="form-control"
                        rows="6"><?= htmlspecialchars($_POST['biography'] ?? '') ?></textarea>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="form-label">

                            Language

                        </label>

                        <?php
                        $selectedLanguage =
                            $_POST['language'] ?? 'English';
                        ?>

                        <select
                            name="language"
                            class="form-select">

                            <option value="English"
                                <?= $selectedLanguage === 'English' ? 'selected' : '' ?>>
                                English
                            </option>

                            <option value="Hindi"
                                <?= $selectedLanguage === 'Hindi' ? 'selected' : '' ?>>
                                Hindi
                            </option>

                            <option value="Telugu"
                                <?= $selectedLanguage === 'Telugu' ? 'selected' : '' ?>>
                                Telugu
                            </option>

                            <option value="Instrumental"
                                <?= $selectedLanguage === 'Instrumental' ? 'selected' : '' ?>>
                                Instrumental
                            </option>

                            <option value="Multi-language"
                                <?= $selectedLanguage === 'Multi-language' ? 'selected' : '' ?>>
                                Multi-language
                            </option>

                        </select>

                    </div>
                                        <div class="col-md-6 mb-4">

                        <label class="form-label">

                            Status

                        </label>

                        <?php
                        $selectedStatus =
                            $_POST['status'] ?? 'draft';
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

                        Save Artist

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>