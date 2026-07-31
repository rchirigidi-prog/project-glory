<?php

declare(strict_types=1);

use App\Services\SupportRequestService;

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {

    header('Location: ?module=support-requests');

    exit;

}

$service = new SupportRequestService();

$service->delete($id);

header('Location: ?module=support-requests');

exit;