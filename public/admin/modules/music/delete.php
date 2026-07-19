<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\SongController;
use App\Core\Flash;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    Flash::set(
        'error',
        'Invalid request.'
    );

    header('Location: index.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {

    Flash::set(
        'error',
        'Invalid song selected.'
    );

    header('Location: index.php');
    exit;
}

$controller = new SongController();

$controller->destroy($id);

header('Location: index.php');
exit;