<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\SeoController;

$controller = new SeoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update();
}

$data = $controller->index();

require_once ADMIN_INCLUDES . '/header.php';
require_once ADMIN_INCLUDES . '/sidebar.php';

?>

<div class="main-wrapper">

<?php require_once __DIR__ . '/../../includes/navbar.php'; ?>

<div class="dashboard">

    <h2 class="mb-4">
        <i class="fa-solid fa-magnifying-glass-chart"></i>
        SEO Manager
    </h2>

    <?php if (!empty($_SESSION['success'])): ?>

        <div class="alert alert-success alert-dismissible fade show">

            <?= htmlspecialchars($_SESSION['success']) ?>

            <?php unset($_SESSION['success']); ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h4 class="mb-4">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Search Engine Settings
                </h4>

                <div class="mb-4">

                    <label class="form-label">
                        SEO Title
                    </label>

                    <input
                        type="text"
                        name="seo_title"
                        class="form-control"
                        value="<?= htmlspecialchars($data['seo_title'] ?? '') ?>">

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Meta Description
                    </label>

                    <textarea
                        name="meta_description"
                        rows="4"
                        class="form-control"><?= htmlspecialchars($data['meta_description'] ?? '') ?></textarea>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Meta Keywords
                    </label>

                    <textarea
                        name="meta_keywords"
                        rows="4"
                        class="form-control"><?= htmlspecialchars($data['meta_keywords'] ?? '') ?></textarea>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Canonical URL
                    </label>

                    <input
                        type="url"
                        name="canonical_url"
                        class="form-control"
                        placeholder="https://singthyglory.com/"
                        value="<?= htmlspecialchars($data['canonical_url'] ?? '') ?>">

                </div>

            </div>

        </div>

        <div class="card shadow-sm">

            <div class="card-body">

                <h4 class="mb-4">
                    <i class="fa-solid fa-share-nodes"></i>
                    Social Sharing Settings
                </h4>

                <div class="mb-4">

                    <label class="form-label">
                        Open Graph Title
                    </label>

                    <input
                        type="text"
                        name="og_title"
                        class="form-control"
                        value="<?= htmlspecialchars($data['og_title'] ?? '') ?>">

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Open Graph Description
                    </label>

                    <textarea
                        name="og_description"
                        rows="4"
                        class="form-control"><?= htmlspecialchars($data['og_description'] ?? '') ?></textarea>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Open Graph Image URL
                    </label>

                    <input
                        type="url"
                        name="og_image"
                        class="form-control"
                        placeholder="https://singthyglory.com/assets/images/banners/banner.jpg"
                        value="<?= htmlspecialchars($data['og_image'] ?? '') ?>">

                </div>

                <hr>

                <div class="text-end">

                    <button
                        type="submit"
                        class="btn btn-primary btn-lg">

                        <i class="fa-solid fa-floppy-disk"></i>
                        Save SEO Settings

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
