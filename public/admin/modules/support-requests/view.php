<?php

declare(strict_types=1);

use App\Models\SupportRequest;

$id = (int) ($_GET['id'] ?? 0);

$model = new SupportRequest();

$request = $model->find($id);

if (!$request) {
?>

<div class="alert alert-danger">

    Support request not found.

</div>

<?php
    return;
}
?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>

                Support Request #<?= (int)$request['id'] ?>

            </h2>

            <p class="text-muted">

                Submitted on
                <?= htmlspecialchars($request['created_at']) ?>

            </p>

        </div>

        <a
            href="?module=support-requests"
            class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left me-2"></i>

            Back

        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="220">Request Type</th>
                    <td><?= htmlspecialchars($request['request_type']) ?></td>
                </tr>

                <tr>
                    <th>Full Name</th>
                    <td><?= htmlspecialchars($request['full_name']) ?></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($request['email']) ?></td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td><?= htmlspecialchars($request['phone']) ?></td>
                </tr>

                <tr>
                    <th>Country</th>
                    <td><?= htmlspecialchars($request['country']) ?></td>
                </tr>

                <tr>
                    <th>Subject</th>
                    <td><?= htmlspecialchars($request['subject']) ?></td>
                </tr>

                <tr>
                    <th>Ministry Area</th>
                    <td><?= htmlspecialchars($request['ministry_area']) ?></td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>

                        <span class="badge bg-primary">

                            <?= htmlspecialchars($request['status']) ?>

                        </span>

                    </td>
                </tr>

                <tr>
                    <th>Message</th>

                    <td>

                        <?= nl2br(htmlspecialchars($request['message'])) ?>

                    </td>

                </tr>

            </table>

        </div>

    </div>

    <div class="mt-4">

        <a
            href="?module=support-requests&action=status&id=<?= (int)$request['id'] ?>&status=contacted"
            class="btn btn-warning">

            Mark Contacted

        </a>

        <a
            href="?module=support-requests&action=status&id=<?= (int)$request['id'] ?>&status=in_progress"
            class="btn btn-primary">

            Mark In Progress

        </a>

        <a
            href="?module=support-requests&action=status&id=<?= (int)$request['id'] ?>&status=completed"
            class="btn btn-success">

            Mark Completed

        </a>

    </div>

</div>