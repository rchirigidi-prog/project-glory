<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

ob_start();

use App\Models\SupportRequest;

$model = new SupportRequest();

$requests = $model->allLatest();

$total = count($requests);

$new = 0;
$contacted = 0;
$inProgress = 0;
$completed = 0;

foreach ($requests as $request) {

    switch ($request['status']) {

        case 'new':
            $new++;
            break;

        case 'contacted':
            $contacted++;
            break;

        case 'in_progress':
            $inProgress++;
            break;

        case 'completed':
            $completed++;
            break;
    }
}

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="fa-solid fa-hand-holding-heart me-2 text-primary"></i>

                Support Requests

            </h2>

            <p class="text-muted mb-0">

                Manage Prayer, Financial, Volunteer and Sponsorship requests.

            </p>

        </div>

    </div>

    <div class="row g-3 mb-4">

        <div class="col-lg">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <i class="fa-solid fa-inbox fa-2x text-primary mb-2"></i>

                    <h6>Total Requests</h6>

                    <h2><?= $total ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <i class="fa-solid fa-circle-plus fa-2x text-warning mb-2"></i>

                    <h6>New</h6>

                    <h2><?= $new ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <i class="fa-solid fa-phone fa-2x text-info mb-2"></i>

                    <h6>Contacted</h6>

                    <h2><?= $contacted ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <i class="fa-solid fa-spinner fa-2x text-primary mb-2"></i>

                    <h6>In Progress</h6>

                    <h2><?= $inProgress ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <i class="fa-solid fa-circle-check fa-2x text-success mb-2"></i>

                    <h6>Completed</h6>

                    <h2><?= $completed ?></h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-6">

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search by Name, Email or Subject (Coming Soon)"
                        disabled>

                </div>

                <div class="col-md-3">

                    <select class="form-select" disabled>

                        <option>All Types</option>
                        <option>Prayer</option>
                        <option>Financial</option>
                        <option>Volunteer</option>
                        <option>Sponsor</option>

                    </select>

                </div>

                <div class="col-md-3">

                    <select class="form-select" disabled>

                        <option>All Status</option>
                        <option>New</option>
                        <option>Contacted</option>
                        <option>In Progress</option>
                        <option>Completed</option>

                    </select>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="70">ID</th>

                        <th>Type</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Status</th>

                        <th>Date</th>

                        <th width="180">

                            Actions

                        </th>

                    </tr>

                </thead>

                <tbody>

                <?php if (empty($requests)): ?>

                    <tr>

                        <td colspan="7" class="text-center py-5">

                            <i class="fa-solid fa-inbox fa-3x text-muted mb-3"></i>

                            <br>

                            No support requests found.

                        </td>

                    </tr>

                <?php else: ?>

                    <?php foreach ($requests as $request): ?>
                            <?php

                        $type = strtolower($request['request_type']);

                        $typeClass = match ($type) {
                            'prayer'    => 'primary',
                            'financial' => 'success',
                            'volunteer' => 'warning',
                            'sponsor'   => 'info',
                            default     => 'secondary',
                        };

                        $typeIcon = match ($type) {
                            'prayer'    => '🙏',
                            'financial' => '❤️',
                            'volunteer' => '🤝',
                            'sponsor'   => '🌱',
                            default     => '📄',
                        };

                        $status = strtolower($request['status']);

                        $statusClass = match ($status) {
                            'new'         => 'warning text-dark',
                            'contacted'   => 'info',
                            'in_progress' => 'primary',
                            'completed'   => 'success',
                            default       => 'secondary',
                        };

                        ?>

                        <tr>

                            <td>

                                #<?= (int)$request['id'] ?>

                            </td>

                            <td>

                                <span class="badge bg-<?= $typeClass ?>">

                                    <?= $typeIcon ?>

                                    <?= ucfirst($type) ?>

                                </span>

                            </td>

                            <td>

                                <?= htmlspecialchars($request['full_name']) ?>

                            </td>

                            <td>

                                <a href="mailto:<?= htmlspecialchars($request['email']) ?>">

                                    <?= htmlspecialchars($request['email']) ?>

                                </a>

                            </td>

                            <td>

                                <span class="badge bg-<?= $statusClass ?>">

                                    <?= ucwords(str_replace('_', ' ', $status)) ?>

                                </span>

                            </td>

                            <td>

                                <?= date('d M Y', strtotime($request['created_at'])) ?>

                                <br>

                                <small class="text-muted">

                                    <?= date('h:i A', strtotime($request['created_at'])) ?>

                                </small>

                            </td>

                            <td>

                                <div class="btn-group btn-group-sm">

                                    <a
                                        href="?module=support-requests&action=view&id=<?= (int)$request['id'] ?>"
                                        class="btn btn-primary"
                                        title="View">

                                        <i class="fa-solid fa-eye"></i>

                                    </a>

                                    <a
                                        href="?module=support-requests&action=edit&id=<?= (int)$request['id'] ?>"
                                        class="btn btn-warning"
                                        title="Edit">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>

                                    <a
                                        href="?module=support-requests&action=delete&id=<?= (int)$request['id'] ?>"
                                        class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this request?');"
                                        title="Delete">

                                        <i class="fa-solid fa-trash"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';
                    