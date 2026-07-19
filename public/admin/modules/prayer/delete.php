<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\PrayerController;
use App\Core\Flash;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    Flash::set(
        'error',
        'Invalid request method.'
    );

    header('Location: index.php');
    exit;
}

$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id) {

    Flash::set(
        'error',
        'Invalid prayer request ID.'
    );

    header('Location: index.php');
    exit;
}

$controller = new PrayerController();

if ($controller->destroy($id)) {

    header('Location: index.php');
    exit;
}

header('Location: index.php');
exit;