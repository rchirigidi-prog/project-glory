<?php

declare(strict_types=1);

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

                Support Requests

            </h2>

            <p class="text-muted mb-0">

                Manage prayer, financial, volunteer and sponsorship requests.

            </p>

        </div>

    </div>

    <div class="row g-3 mb-4">

        <div class="col-lg-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6>Total Requests</h6>

                    <h2><?= $total ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6>New</h6>

                    <h2><?= $new ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6>In Progress</h6>

                    <h2><?= $inProgress ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6>Completed</h6>

                    <h2><?= $completed ?></h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>ID</th>

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

                            No support requests found.

                        </td>

                    </tr>

                <?php else: ?>

                    <?php foreach ($requests as $request): ?>

                        <tr>

                            <td>

                                #<?= (int) $request['id'] ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($request['request_type']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($request['full_name']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($request['email']) ?>

                            </td>

                            <td>

                                <span class="badge bg-primary">

                                    <?= htmlspecialchars($request['status']) ?>

                                </span>

                            </td>

                            <td>

                                <?= htmlspecialchars($request['created_at']) ?>

                            </td>

                            <td>

                                <a
                                    href="?module=support-requests&action=view&id=<?= (int) $request['id'] ?>"
                                    class="btn btn-sm btn-primary">

                                    View

                                </a>

                                <a
                                    href="?module=support-requests&action=delete&id=<?= (int) $request['id'] ?>"
                                    class="btn btn-sm btn-danger">

                                    Delete

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>