<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\SupporterController;
use App\Core\Flash;
use App\Core\ModuleLoader;

$loader = new ModuleLoader();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    Flash::set(
        'error',
        'Invalid request method.'
    );

    header('Location: ' . $loader->url('supporters'));
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
        'Invalid supporter ID.'
    );

    header('Location: ' . $loader->url('supporters'));
    exit;
}

$controller = new SupporterController();

if ($controller->destroy($id)) {

    header('Location: ' . $loader->url('supporters'));
    exit;
}

header('Location: ' . $loader->url('supporters'));
exit;