<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\PrayerController;
use App\Core\Flash;

$controller = new PrayerController();

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id) {

    Flash::set(
        'error',
        'Invalid prayer request ID.'
    );

    header('Location: index.php');
    exit;
}

$prayer = $controller->show($id);

if (!$prayer) {

    Flash::set(
        'error',
        'Prayer request was not found.'
    );

    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($controller->update($id, $_POST)) {

        header('Location: index.php');
        exit;
    }

    $prayer = array_merge(
        $prayer,
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
            Edit Prayer Request
        </h2>

        <a
            href="index.php"
            class="btn btn-outline-secondary">

            <i class="fa-solid fa-arrow-left"></i>
            Back to Prayer Manager

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

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Name <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            required
                            value="<?= htmlspecialchars($prayer['name'] ?? '') ?>">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="<?= htmlspecialchars($prayer['email'] ?? '') ?>">

                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Prayer Title <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        required
                        value="<?= htmlspecialchars($prayer['title'] ?? '') ?>">
                                        <div class="mb-4">

                    <label class="form-label">
                        Prayer Request <span class="text-danger">*</span>
                    </label>

                    <textarea
                        name="request"
                        class="form-control"
                        rows="8"
                        required><?= htmlspecialchars($prayer['request'] ?? '') ?></textarea>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Category
                        </label>

                        <?php $selectedCategory = $prayer['category'] ?? 'General'; ?>

                        <select
                            name="category"
                            class="form-select">

                            <?php
                            $categories = [
                                'General',
                                'Healing',
                                'Family',
                                'Financial',
                                'Job',
                                'Thanksgiving',
                                'Other'
                            ];

                            foreach ($categories as $category):
                            ?>

                                <option
                                    value="<?= $category ?>"
                                    <?= $selectedCategory === $category ? 'selected' : '' ?>>
                                    <?= $category ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Status
                        </label>

                        <?php $selectedStatus = $prayer['status'] ?? 'pending'; ?>

                        <select
                            name="status"
                            class="form-select">

                            <option
                                value="pending"
                                <?= $selectedStatus === 'pending' ? 'selected' : '' ?>>
                                Pending
                            </option>

                            <option
                                value="approved"
                                <?= $selectedStatus === 'approved' ? 'selected' : '' ?>>
                                Approved
                            </option>

                            <option
                                value="answered"
                                <?= $selectedStatus === 'answered' ? 'selected' : '' ?>>
                                Answered
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
                        Update Prayer Request

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>