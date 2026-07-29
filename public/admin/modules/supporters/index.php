<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\SupporterController;
use App\Core\Flash;

$controller = new SupporterController();

$supporters = $controller->index();

require_once ADMIN_INCLUDES . '/header.php';
require_once ADMIN_INCLUDES . '/sidebar.php';

?>

<div class="main-wrapper">

<?php require_once __DIR__ . '/../../includes/navbar.php'; ?>

<div class="dashboard">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0">

            <i class="fa-solid fa-hand-holding-heart"></i>

            Supporter Manager

        </h2>

        <a href="/admin/dashboard.php?module=supporters&action=create" class="btn btn-primary">

            <i class="fa-solid fa-plus"></i>

            Add Supporter

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

            <?php if (empty($supporters)): ?>

                <div class="text-center py-5">

                    <i class="fa-solid fa-hand-holding-heart fa-3x text-secondary mb-3"></i>

                    <h4>No Supporters Yet</h4>

                    <p class="text-muted">

                        Add your first supporter for SingThyGlory.

                    </p>

                </div>

            <?php else: ?>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th>Photo</th>

                                <th>Name</th>

                                <th>Support Type</th>

                                <th>Country</th>

                                <th>Featured</th>

                                <th>Status</th>

                                <th class="text-end">

                                    Actions

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php foreach ($supporters as $supporter): ?>

                            <tr>

                                <td width="90">

                                    <?php if (!empty($supporter['photo_media_id'])): ?>

                                        <span class="badge bg-success">

                                            Photo

                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-secondary">

                                            No Photo

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <strong>

                                        <?= htmlspecialchars($supporter['name']) ?>

                                    </strong>

                                    <br>

                                    <small class="text-muted">

                                        <?= htmlspecialchars($supporter['email'] ?? '') ?>

                                    </small>

                                </td>

                                <td>

                                    <?= htmlspecialchars($supporter['support_type']) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars($supporter['country'] ?: '-') ?>

                                </td>

                                <td>

                                    <?php if (!empty($supporter['is_featured'])): ?>

                                        <span class="badge bg-warning text-dark">

                                            Featured

                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-secondary">

                                            No

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?php if ($supporter['status'] === 'active'): ?>

                                        <span class="badge bg-success">

                                            Active

                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-secondary">

                                            Inactive

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td class="text-end">

                                    <a
                                        href="/admin/dashboard.php?module=supporters&action=edit&id=<?= (int)$supporter['id'] ?>"
                                        class="btn btn-sm btn-outline-primary">

                                        <i class="fa-solid fa-pen"></i>

                                        Edit

                                    </a>

                                    <form
                                        method="POST"
                                        action="/admin/dashboard.php?module=supporters&action=delete"
                                        class="d-inline"
                                        onsubmit="return confirm('Delete this supporter?');">

                                        <input
                                            type="hidden"
                                            name="id"
                                            value="<?= (int)$supporter['id'] ?>">

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