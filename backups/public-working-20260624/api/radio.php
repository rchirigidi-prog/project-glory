<?php

header('Content-Type: application/json');

$url = 'https://radio.singthyglory.com/api/nowplaying';

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    http_response_code(500);

    echo json_encode([
        'success' => false,
        'error' => curl_error($ch)
    ]);

    exit;
}

curl_close($ch);

echo $response;