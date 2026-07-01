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

<?php require_once __DIR__ . '/../../includes/navbar.php'; ?>

<div class="dashboard">

    <h2 class="mb-4">
        <i class="fa-solid fa-globe"></i>
        General Settings
    </h2>

    <?php if (!empty($_SESSION['success'])): ?>

    <div class="alert alert-success alert-dismissible fade show">

        <?= $_SESSION['success']; ?>

        <?php unset($_SESSION['success']); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

    </div>

    <?php endif; ?>

    <form method="POST">

        <div class="card shadow-sm">

            <div class="card-body">

               <h4 class="mb-4">
                    🌐 Website Information
                </h4>

        <div class="row">

        <div class="col-md-6 mb-3">

            <label class="form-label">
                Site Name
            </label>

            <input
            type="text"
            name="site_name"
            class="form-control"
            value="<?= htmlspecialchars($data['site_name'] ?? '') ?>">

        </div>

        <div class="col-md-6 mb-3">

            <label class="form-label">
                Tagline
            </label>

            <input
            type="text"
            name="site_tagline"
            class="form-control"
            value="<?= htmlspecialchars($data['site_tagline'] ?? '') ?>">

        </div>

        <div class="col-md-6 mb-3">

            <label class="form-label">
                Contact Email
            </label>

            <input
            type="email"
            name="contact_email"
            class="form-control"
            value="<?= htmlspecialchars($data['contact_email'] ?? '') ?>">

        </div>

         <div class="col-md-6 mb-3">

            <label class="form-label">
            Phone
            </label>

            <input
            type="text"
            name="contact_phone"
            class="form-control"
            value="<?= htmlspecialchars($data['contact_phone'] ?? '') ?>">

            </div>

            <div class="col-md-12 mb-3">

            <label class="form-label">
            Address
            </label>

            <textarea
            name="contact_address"
            rows="4"
            class="form-control"><?= htmlspecialchars($data['contact_address'] ?? '') ?></textarea>

            </div>

            <div class="col-md-12 mb-4">

            <label class="form-label">
            Footer Text
            </label>

            <input
            type="text"
            name="footer_text"
            class="form-control"
            value="<?= htmlspecialchars($data['footer_text'] ?? '') ?>">

            </div>

            </div>

            <hr>

            <div class="text-end">

            <button
            type="submit"
            class="btn btn-primary btn-lg">

            <i class="fa-solid fa-floppy-disk"></i>

            Save Website Settings

            </button>

            </div>

            </div>

            </div>

            </form>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>