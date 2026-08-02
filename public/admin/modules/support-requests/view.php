<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

ob_start();

use App\Services\SupportRequestService;

$id = (int) ($_GET['id'] ?? 0);

$service = new SupportRequestService();

$request = $service->find($id);

if (!$request) {
?>

<div class="container-fluid">

    <div class="alert alert-danger mt-4">

        <i class="fa-solid fa-circle-exclamation me-2"></i>

        Support request not found.

    </div>

</div>

<?php

    $content = ob_get_clean();

    require ADMIN_LAYOUTS . '/app.php';

    return;
}

$statusClass = match ($request['status']) {

    'new'         => 'warning',

    'contacted'   => 'info',

    'in_progress' => 'primary',

    'completed'   => 'success',

    default       => 'secondary',

};

$typeClass = match ($request['request_type']) {

    'prayer'     => 'primary',

    'financial'  => 'success',

    'volunteer'  => 'warning',

    'sponsor'    => 'info',

    default      => 'secondary',

};

$typeIcon = match ($request['request_type']) {

    'prayer'     => '🙏 Prayer',

    'financial'  => '❤️ Financial',

    'volunteer'  => '🤝 Volunteer',

    'sponsor'    => '🌱 Sponsor',

    default      => ucfirst($request['request_type']),

};

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="fa-solid fa-hand-holding-heart text-primary me-2"></i>

                Support Request #<?= (int)$request['id']; ?>

            </h2>

            <p class="text-muted mb-0">

                Submitted on
                <?= date('d M Y h:i A', strtotime($request['created_at'])); ?>

            </p>

        </div>

        <div>

            <span class="badge bg-<?= $statusClass ?> fs-6 me-2">

                <?= ucwords(str_replace('_', ' ', $request['status'])) ?>

            </span>

            <a
                href="?module=support-requests"
                class="btn btn-secondary">

                <i class="fa-solid fa-arrow-left me-2"></i>

                Back

            </a>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-4 mb-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-header bg-light">

                    <h5 class="mb-0">

                        <i class="fa-solid fa-address-card me-2"></i>

                        Contact Information

                    </h5>

                </div>

                <div class="card-body">

                    <p>

                        <strong>Name</strong><br>

                        <?= htmlspecialchars($request['full_name']) ?>

                    </p>

                    <p>

                        <strong>Email</strong><br>

                        <a href="mailto:<?= htmlspecialchars($request['email']) ?>">

                            <?= htmlspecialchars($request['email']) ?>

                        </a>

                    </p>

                    <p>

                        <strong>Phone</strong><br>

                        <?php if (!empty($request['phone'])): ?>

                            <a href="tel:<?= htmlspecialchars($request['phone']) ?>">

                                <?= htmlspecialchars($request['phone']) ?>

                            </a>

                        <?php else: ?>

                            <span class="text-muted">Not provided</span>

                        <?php endif; ?>

                    </p>

                    <p class="mb-0">

                        <strong>Country</strong><br>

                        <?= !empty($request['country'])
                            ? htmlspecialchars($request['country'])
                            : '<span class="text-muted">Not provided</span>' ?>

                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-8 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-light">

                    <h5 class="mb-0">

                        <i class="fa-solid fa-file-lines me-2"></i>

                        Request Details

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-borderless align-middle mb-0">

                        <tr>

                            <th width="180">

                                Request Type

                            </th>

                            <td>

                                <span class="badge bg-<?= $typeClass ?>">

                                    <?= $typeIcon ?>

                                </span>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Subject

                            </th>

                            <td>

                                <?= htmlspecialchars($request['subject']) ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Ministry Area

                            </th>

                            <td>

                                <?= htmlspecialchars($request['ministry_area']) ?>

                            </td>

                        </tr>

                        <tr>

                            <th class="align-top">

                                Message

                            </th>

                            <td>

                                <?= nl2br(htmlspecialchars($request['message'])) ?>

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>
         <div class="col-lg-4 mb-4">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-light">

                    <h5 class="mb-0">

                        <i class="fa-solid fa-list-check me-2"></i>

                        Status Management

                    </h5>

                </div>

                <div class="card-body">

                    <p class="mb-3">

                        <strong>Current Status</strong>

                    </p>

                    <span class="badge bg-<?= $statusClass ?> fs-6 mb-4">

                        <?= ucwords(str_replace('_', ' ', $request['status'])) ?>

                    </span>

                    <div class="d-grid gap-2 mt-3">

                        <a
                            href="?module=support-requests&action=status&id=<?= (int)$request['id'] ?>&status=contacted"
                            class="btn btn-info">

                            <i class="fa-solid fa-phone me-2"></i>

                            Mark Contacted

                        </a>

                        <a
                            href="?module=support-requests&action=status&id=<?= (int)$request['id'] ?>&status=in_progress"
                            class="btn btn-primary">

                            <i class="fa-solid fa-spinner me-2"></i>

                            Mark In Progress

                        </a>

                        <a
                            href="?module=support-requests&action=status&id=<?= (int)$request['id'] ?>&status=completed"
                            class="btn btn-success">

                            <i class="fa-solid fa-circle-check me-2"></i>

                            Mark Completed

                        </a>

                    </div>

                </div>

            </div>

            <div class="card shadow-sm border-0">

                <div class="card-header bg-light">

                    <h5 class="mb-0">

                        <i class="fa-solid fa-note-sticky me-2"></i>

                        Admin Notes

                    </h5>

                </div>

                <div class="card-body">

                    <?php if (!empty($request['admin_notes'])): ?>

                        <?= nl2br(htmlspecialchars($request['admin_notes'])) ?>

                    <?php else: ?>

                        <span class="text-muted">

                            No notes available.

                        </span>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

    <div class="d-flex justify-content-between mt-4">

        <div>

            <a
                href="?module=support-requests&action=edit&id=<?= (int)$request['id'] ?>"
                class="btn btn-warning">

                <i class="fa-solid fa-pen me-2"></i>

                Edit Request

            </a>

        </div>

        <div>

            <a
                href="?module=support-requests&action=delete&id=<?= (int)$request['id'] ?>"
                class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete this request?');">

                <i class="fa-solid fa-trash me-2"></i>

                Delete

            </a>

        </div>

    </div>

</div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';
       