<?php

header('Content-Type: application/json');

try {

    $data = [

        "name" => $_POST['name'] ?? '',
        "email" => $_POST['email'] ?? '',
        "request" => $_POST['request'] ?? '',
        "date" => date("Y-m-d H:i:s")

    ];

    $file = __DIR__ . '/../storage/prayers.json';

    $existing = [];

    if(file_exists($file)) {

        $existing = json_decode(
            file_get_contents($file),
            true
        ) ?: [];

    }

    $existing[] = $data;

    file_put_contents(
        $file,
        json_encode($existing, JSON_PRETTY_PRINT)
    );

    echo json_encode([
        "success" => true
    ]);

} catch(Exception $e) {

    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);

}
?>
