<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../includes/helpers/prayer-helper.php';

$file = __DIR__ . '/../../storage/prayers.json';

$prayers = loadPrayers($file);

$id = $_POST['id'] ?? '';

$found = false;

foreach ($prayers as $key => $prayer) {

    if (($prayer['id'] ?? '') === $id) {

        unset($prayers[$key]);

        $found = true;

        break;
    }
}

if ($found) {

    $prayers = array_values($prayers);

    savePrayers($file, $prayers);

    echo json_encode([
        'success' => true,
        'message' => 'Prayer deleted successfully.'
    ]);

} else {

    echo json_encode([
        'success' => false,
        'message' => 'Prayer not found.'
    ]);
}
