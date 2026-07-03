<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\FooterController;

$controller = new FooterController();

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
        <i class="fa-solid fa-shoe-prints"></i>
        Footer Manager
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
                    <i class="fa-solid fa-copyright"></i>
                    Footer Information
                </h4>

                <div class="mb-4">

                    <label class="form-label">
                        Footer Copyright Text
                    </label>

                    <input
                        type="text"
                        name="footer_text"
                        class="form-control"
                        value="<?= htmlspecialchars($data['footer_text'] ?? '') ?>">

                    <div class="form-text">
                        This text will be displayed at the bottom of the public website.
                    </div>

                </div>

                <div class="alert alert-info">

                    <strong>Note:</strong>
                    Website name and tagline are managed from Website Manager.
                    Social media links are managed from Social Media Manager.

                </div>

                <hr>

                <div class="text-end">

                    <button
                        type="submit"
                        class="btn btn-primary btn-lg">

                        <i class="fa-solid fa-floppy-disk"></i>
                        Save Footer Settings

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
