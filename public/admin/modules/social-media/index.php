<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\SocialMediaController;

$controller = new SocialMediaController();

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
        <i class="fa-solid fa-share-nodes"></i>
        Social Media Manager
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

        <div class="card shadow-sm">

            <div class="card-body">

                <h4 class="mb-4">
                    <i class="fa-solid fa-link"></i>
                    Social Media Profile Links
                </h4>

                <p class="text-muted mb-4">
                    Manage the official social media profile links used by SingThyGlory.
                </p>

                <div class="row">

                    <div class="col-md-12 mb-4">

                        <label class="form-label">
                            <i class="fa-brands fa-youtube text-danger"></i>
                            YouTube URL
                        </label>

                        <input
                            type="url"
                            name="youtube_url"
                            class="form-control"
                            placeholder="https://www.youtube.com/@SingThyGlory"
                            value="<?= htmlspecialchars($data['youtube_url'] ?? '') ?>">

                    </div>

                    <div class="col-md-12 mb-4">

                        <label class="form-label">
                            <i class="fa-brands fa-facebook text-primary"></i>
                            Facebook URL
                        </label>

                        <input
                            type="url"
                            name="facebook_url"
                            class="form-control"
                            placeholder="https://www.facebook.com/your-page"
                            value="<?= htmlspecialchars($data['facebook_url'] ?? '') ?>">

                    </div>

                    <div class="col-md-12 mb-4">

                        <label class="form-label">
                            <i class="fa-brands fa-instagram"></i>
                            Instagram URL
                        </label>

                        <input
                            type="url"
                            name="instagram_url"
                            class="form-control"
                            placeholder="https://www.instagram.com/your-profile"
                            value="<?= htmlspecialchars($data['instagram_url'] ?? '') ?>">

                    </div>

                </div>

                <hr>

                <div class="text-end">

                    <button
                        type="submit"
                        class="btn btn-primary btn-lg">

                        <i class="fa-solid fa-floppy-disk"></i>
                        Save Social Media Settings

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
