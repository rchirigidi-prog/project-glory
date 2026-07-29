<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Controllers\SupportMinistryController;

$controller = new SupportMinistryController();

$data = $controller->index();

require __DIR__ . '/support-ministry.php';