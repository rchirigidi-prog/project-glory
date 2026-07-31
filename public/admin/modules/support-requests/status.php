<?php

declare(strict_types=1);

use App\Services\SupportRequestService;

$id = (int) ($_GET['id'] ?? 0);

$status = trim($_GET['status'] ?? '');

$allowedStatuses = [
    'new',
    'contacted',
    'in_progress',
    'completed'
];

if ($id <= 0 || !in_array($status, $allowedStatuses, true)) {

    header('Location: ?module=support-requests');

    exit;

}

$service = new SupportRequestService();

$service->updateStatus($id, $status);

header(
    'Location: ?module=support-requests&action=view&id='
    . $id
);

exit;