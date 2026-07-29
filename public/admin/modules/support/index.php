<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\SupportMinistryController;

$controller = new SupportMinistryController();

$data = $controller->index();

require_once ADMIN_INCLUDES . '/header.php';
require_once ADMIN_INCLUDES . '/sidebar.php';

?>

<div class="main-wrapper">

<?php require_once __DIR__ . '/../../includes/navbar.php'; ?>

<div class="dashboard">

    <h2 class="mb-4">
        <i class="fa-solid fa-hand-holding-heart"></i>
        Support Ministry
    </h2>

    <?php if (!empty($_SESSION['success'])): ?>

    <div class="alert alert-success alert-dismissible fade show">

        <?= $_SESSION['success']; ?>

        <?php unset($_SESSION['success']); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

    </div>

    <?php endif; ?>

    <form method="POST">

        <!-- Section Settings -->

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h4 class="mb-4">
                    Section Settings
                </h4>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Section Title
                        </label>

                        <input
                            type="text"
                            name="section_title"
                            class="form-control"
                            value="<?= htmlspecialchars($data['section_title'] ?? '') ?>">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Section Subtitle
                        </label>

                        <input
                            type="text"
                            name="section_subtitle"
                            class="form-control"
                            value="<?= htmlspecialchars($data['section_subtitle'] ?? '') ?>">

                    </div>

                    <div class="col-md-12">

                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_enabled"
                                value="1"
                                <?= !empty($data['is_enabled']) ? 'checked' : '' ?>>

                            <label class="form-check-label">
                                Enable Support Ministry Section
                            </label>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Prayer Partner -->

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h4 class="mb-4">
                    Prayer Partner
                </h4>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Title
                        </label>

                        <input
                            type="text"
                            name="prayer_title"
                            class="form-control"
                            value="<?= htmlspecialchars($data['prayer_title'] ?? '') ?>">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Button Text
                        </label>

                        <input
                            type="text"
                            name="prayer_button_text"
                            class="form-control"
                            value="<?= htmlspecialchars($data['prayer_button_text'] ?? '') ?>">

                    </div>

                    <div class="col-md-12 mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            class="form-control"
                            rows="4"
                            name="prayer_description"><?= htmlspecialchars($data['prayer_description'] ?? '') ?></textarea>

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Button Link
                        </label>

                        <input
                            type="text"
                            name="prayer_button_link"
                            class="form-control"
                            value="<?= htmlspecialchars($data['prayer_button_link'] ?? '') ?>">

                    </div>

                </div>

            </div>

        </div>

        <!-- Donate -->

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h4 class="mb-4">
                    Donate
                </h4>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Title
                        </label>

                        <input
                            type="text"
                            name="donate_title"
                            class="form-control"
                            value="<?= htmlspecialchars($data['donate_title'] ?? '') ?>">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Button Text
                        </label>

                        <input
                            type="text"
                            name="donate_button_text"
                            class="form-control"
                            value="<?= htmlspecialchars($data['donate_button_text'] ?? '') ?>">

                    </div>

                    <div class="col-md-12 mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            class="form-control"
                            rows="4"
                            name="donate_description"><?= htmlspecialchars($data['donate_description'] ?? '') ?></textarea>

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Button Link
                        </label>

                        <input
                            type="text"
                            name="donate_button_link"
                            class="form-control"
                            value="<?= htmlspecialchars($data['donate_button_link'] ?? '') ?>">
                    </div>

                </div>

            </div>

        </div>
         <!-- Volunteer -->

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h4 class="mb-4">
                    Volunteer
                </h4>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Title
                        </label>

                        <input
                            type="text"
                            name="volunteer_title"
                            class="form-control"
                            value="<?= htmlspecialchars($data['volunteer_title'] ?? '') ?>">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Button Text
                        </label>

                        <input
                            type="text"
                            name="volunteer_button_text"
                            class="form-control"
                            value="<?= htmlspecialchars($data['volunteer_button_text'] ?? '') ?>">

                    </div>

                    <div class="col-md-12 mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            class="form-control"
                            rows="4"
                            name="volunteer_description"><?= htmlspecialchars($data['volunteer_description'] ?? '') ?></textarea>

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Button Link
                        </label>

                        <input
                            type="text"
                            name="volunteer_button_link"
                            class="form-control"
                            value="<?= htmlspecialchars($data['volunteer_button_link'] ?? '') ?>">

                    </div>

                </div>

            </div>

        </div>

        <!-- Sponsor a Project -->

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h4 class="mb-4">
                    Sponsor a Project
                </h4>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Title
                        </label>

                        <input
                            type="text"
                            name="sponsor_title"
                            class="form-control"
                            value="<?= htmlspecialchars($data['sponsor_title'] ?? '') ?>">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Button Text
                        </label>

                        <input
                            type="text"
                            name="sponsor_button_text"
                            class="form-control"
                            value="<?= htmlspecialchars($data['sponsor_button_text'] ?? '') ?>">

                    </div>

                    <div class="col-md-12 mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            class="form-control"
                            rows="4"
                            name="sponsor_description"><?= htmlspecialchars($data['sponsor_description'] ?? '') ?></textarea>

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Button Link
                        </label>

                        <input
                            type="text"
                            name="sponsor_button_link"
                            class="form-control"
                            value="<?= htmlspecialchars($data['sponsor_button_link'] ?? '') ?>">

                    </div>

                </div>

            </div>

        </div>

        <div class="text-end mb-5">

            <button
                type="submit"
                class="btn btn-primary btn-lg">

                <i class="fa-solid fa-floppy-disk"></i>

                Save Support Ministry

            </button>

        </div>

    </form>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
       