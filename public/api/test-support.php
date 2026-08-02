<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Services\SupportRequestService;

try {

    $service = new SupportRequestService();

    echo "Service Loaded Successfully";

} catch (Throwable $e) {

    echo "<pre>";
    echo "ERROR\n\n";
    echo $e->getMessage() . "\n\n";
    echo $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n\n";
    echo $e->getTraceAsString();
    echo "</pre>";

}