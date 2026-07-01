<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../includes/helpers/prayer-helper.php';

$file = __DIR__ . '/../../storage/prayers.json';

$prayers = loadPrayers($file);

$id = $_POST['id'] ?? '';

foreach ($prayers as &$prayer) {

    if ($prayer['id'] === $id) {

        $prayer['name'] = trim($_POST['name'] ?? '');
        $prayer['email'] = trim($_POST['email'] ?? '');
        $prayer['request'] = trim($_POST['request'] ?? '');
        $prayer['status'] = trim($_POST['status'] ?? 'New');

        savePrayers($file, $prayers);

        echo json_encode([
            'success' => true,
            'message' => 'Prayer updated successfully.'
        ]);

        exit;
    }
}

echo json_encode([
    'success' => false,
    'message' => 'Prayer not found.'
]);
