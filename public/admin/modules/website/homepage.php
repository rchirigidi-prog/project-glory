<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\WebsiteController;

$controller = new WebsiteController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update();
}

$data = $controller->index();

require_once ADMIN_INCLUDES . '/header.php';
require_once ADMIN_INCLUDES . '/sidebar.php';

?>

<div class="main-wrapper">

    <?php require_once ADMIN_INCLUDES . '/navbar.php'; ?>

    <div class="dashboard">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">
                    <i class="fa-solid fa-house"></i>
                    Homepage Manager
                </h2>
                <p class="text-muted mb-0">
                    Manage the content displayed on the website homepage.
                </p>
            </div>

            <a href="/" target="_blank" class="btn btn-outline-primary">
                <i class="fa-solid fa-arrow-up-right-from-square me-2"></i>
                Preview Website
            </a>
        </div>

        <?php if (!empty($_SESSION['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>
                <?= htmlspecialchars($_SESSION['success']) ?>
                <?php unset($_SESSION['success']); ?>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
                </button>
            </div>
        <?php endif; ?>

        <form method="POST" autocomplete="off">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        🏠 Hero Section
                    </h4>
                </div>

                <div class="card-body">

                    <div class="mb-4">

                        <label for="hero_title" class="form-label fw-semibold">
                            Hero Title
                        </label>

                        <input
                            id="hero_title"
                            type="text"
                            name="hero_title"
                            class="form-control"
                            placeholder="Enter homepage title"
                            value="<?= htmlspecialchars($data['hero_title'] ?? '') ?>">

                    </div>

                    <div class="mb-4">

                        <label for="hero_subtitle" class="form-label fw-semibold">
                            Hero Subtitle
                        </label>

                        <textarea
                            id="hero_subtitle"
                            name="hero_subtitle"
                            rows="4"
                            class="form-control"
                            placeholder="Enter homepage subtitle"><?= htmlspecialchars($data['hero_subtitle'] ?? '') ?></textarea>

                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">
                        🔘 Hero Buttons
                    </h5>

                    <div class="row">

                        <div class="col-lg-6 mb-3">

                            <label for="hero_button_text" class="form-label fw-semibold">
                                Listen Button Text
                            </label>

                            <input
                                id="hero_button_text"
                                type="text"
                                name="hero_button_text"
                                class="form-control"
                                value="<?= htmlspecialchars($data['hero_button_text'] ?? '') ?>">

                        </div>

                        <div class="col-lg-6 mb-3">

                            <label for="hero_button_url" class="form-label fw-semibold">
                                Listen Button URL
                            </label>

                            <input
                                id="hero_button_url"
                                type="text"
                                name="hero_button_url"
                                class="form-control"
                                placeholder="/radio"
                                value="<?= htmlspecialchars($data['hero_button_url'] ?? '') ?>">

                        </div>

                        <div class="col-lg-6 mb-3">

                            <label for="youtube_button_text" class="form-label fw-semibold">
                                Watch Button Text
                            </label>

                            <input
                                id="youtube_button_text"
                                type="text"
                                name="youtube_button_text"
                                class="form-control"
                                value="<?= htmlspecialchars($data['youtube_button_text'] ?? '') ?>">

                        </div>

                        <div class="col-lg-6 mb-3">

                            <label for="youtube_button_url" class="form-label fw-semibold">
                                Watch Button URL
                            </label>

                            <input
                                id="youtube_button_url"
                                type="text"
                                name="youtube_button_url"
                                class="form-control"
                                placeholder="https://youtube.com/..."
                                value="<?= htmlspecialchars($data['youtube_button_url'] ?? '') ?>">

                        </div>

                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">
                        🖼 Hero Image
                    </h5>

                    <div class="mb-3">

                        <label for="hero_image" class="form-label fw-semibold">
                            Hero Image Path
                        </label>

                        <input
                            id="hero_image"
                            type="text"
                            name="hero_image"
                            class="form-control"
                            placeholder="assets/images/hero/hero-image.png"
                            value="<?= htmlspecialchars($data['hero_image'] ?? '') ?>">

                        <div class="form-text">
                            Example:
                            <code>assets/images/hero/hero-image.png</code>
                        </div>

                    </div>

                </div>

                <div class="card-footer bg-white text-end">

                    <button
                        type="submit"
                        class="btn btn-primary btn-lg">

                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Save Homepage

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<?php require_once ADMIN_INCLUDES . '/footer.php'; ?>