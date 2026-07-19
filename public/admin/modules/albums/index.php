<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\AlbumController;
use App\Core\Flash;

$controller = new AlbumController();

$albums = $controller->index();

require_once ADMIN_INCLUDES . '/header.php';
require_once ADMIN_INCLUDES . '/sidebar.php';

?>

<div class="main-wrapper">

<?php require_once __DIR__ . '/../../includes/navbar.php'; ?>

<div class="dashboard">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0">

            <i class="fa-solid fa-compact-disc"></i>

            Album Manager

        </h2>

        <a
            href="create.php"
            class="btn btn-primary">

            <i class="fa-solid fa-plus"></i>

            Add Album

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

            <?php if (empty($albums)): ?>

                <div class="text-center py-5">

                    <i class="fa-solid fa-compact-disc fa-3x text-secondary mb-3"></i>

                    <h4>No Albums Yet</h4>

                    <p class="text-muted">

                        Create your first album for SingThyGlory.

                    </p>

                </div>

            <?php else: ?>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th>Cover</th>

                                <th>Album</th>

                                <th>Language</th>

                                <th>Release Date</th>

                                <th>Status</th>

                                <th>Created</th>

                                <th class="text-end">

                                    Actions

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php foreach ($albums as $album): ?>

                            <tr>

                                <td width="90">

                                    <?php if (!empty($album['cover_media_id'])): ?>

                                        <span class="badge bg-success">

                                            Cover

                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-secondary">

                                            No Cover

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <strong>

                                        <?= htmlspecialchars($album['title']) ?>

                                    </strong>

                                </td>

                                <td>

                                    <?= htmlspecialchars($album['language']) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $album['release_date'] ?? '-'
                                    ) ?>
                                                                    </td>

                                <td>

                                    <?php if ($album['status'] === 'published'): ?>

                                        <span class="badge bg-success">

                                            Published

                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-secondary">

                                            Draft

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars($album['created_at']) ?>

                                </td>

                                <td class="text-end">

                                    <a
                                        href="edit.php?id=<?= (int) $album['id'] ?>"
                                        class="btn btn-sm btn-outline-primary">

                                        <i class="fa-solid fa-pen"></i>

                                        Edit

                                    </a>

                                    <form
                                        method="POST"
                                        action="delete.php"
                                        class="d-inline"
                                        onsubmit="return confirm('Delete this album?');">

                                        <input
                                            type="hidden"
                                            name="id"
                                            value="<?= (int) $album['id'] ?>">

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