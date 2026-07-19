<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\PrayerController;
use App\Core\Flash;

$controller = new PrayerController();

$requests = $controller->index();

require_once ADMIN_INCLUDES . '/header.php';
require_once ADMIN_INCLUDES . '/sidebar.php';

?>

<div class="main-wrapper">

<?php require_once __DIR__ . '/../../includes/navbar.php'; ?>

<div class="dashboard">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0">
            <i class="fa-solid fa-hands-praying"></i>
            Prayer Manager
        </h2>

        <a
            href="create.php"
            class="btn btn-primary">

            <i class="fa-solid fa-plus"></i>
            Add Prayer Request

        </a>

    </div>

    <?php if ($message = Flash::get('success')): ?>

        <div class="alert alert-success alert-dismissible fade show">

            <?= htmlspecialchars($message) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>

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

    <div class="card shadow-sm">

        <div class="card-body">

            <?php if (empty($requests)): ?>

                <div class="text-center py-5">

                    <i class="fa-solid fa-book-open fa-3x text-secondary mb-3"></i>

                    <h4>No Prayer Requests Yet</h4>

                    <p class="text-muted">
                        Create the first prayer request for SingThyGlory.
                    </p>

                </div>

            <?php else: ?>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th class="text-end">Actions</th>
                            </tr>

                        </thead>

                        <tbody>

                        <?php foreach ($requests as $request): ?>

                            <tr>

                                <td>
                                   <?= htmlspecialchars($request['name']) ?>
                                </td>

                                <td>
                                  <?= htmlspecialchars($request['title']) ?>
                                </td>

                                <td>
                                   <?= htmlspecialchars($request['category']) ?>
                                </td>

                                 <td>
                                   <?= htmlspecialchars($request['status']) ?>
                                </td>
                                
                                <td>
                                   <?= htmlspecialchars($request['created_at']) ?>
                                </td>


                                <td>

    <?php
    $badge = match ($request['status']) {
        'approved' => 'success',
        'answered' => 'primary',
        default => 'warning',
    };
    ?>

    <span class="badge bg-<?= $badge ?>">
        <?= ucfirst(htmlspecialchars($request['status'])) ?>
    </span>

</td>

                                <td class="text-end">

                                    <a
                                        href="edit.php?id=<?= (int) $request['id'] ?>"
                                        class="btn btn-sm btn-outline-primary">

                                        <i class="fa-solid fa-pen"></i>
                                        Edit

                                    </a>

                                    <form
                                        method="POST"
                                        action="delete.php"
                                        class="d-inline"
                                        onsubmit="return confirm('Delete this prayer request?');"

                                        <input
                                            type="hidden"
                                            name="id"
                                            value="<?= (int) $request['id'] ?>">

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger">

                                            <i class="fa-solid fa-trash"></i>
                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
