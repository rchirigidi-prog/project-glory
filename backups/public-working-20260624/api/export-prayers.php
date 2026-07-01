<?php

$file = __DIR__ . '/../storage/prayers.json';

$prayers = [];

if(file_exists($file)) {

    $prayers = json_decode(
        file_get_contents($file),
        true
    ) ?: [];

}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="prayer_requests.csv"');

$output = fopen('php://output', 'w');

fputcsv($output, [
    'Date',
    'Name',
    'Email',
    'Prayer Request'
]);

foreach($prayers as $prayer) {

    fputcsv($output, [

        $prayer['date'] ?? '',

        $prayer['name'] ?? '',

        $prayer['email'] ?? '',

        $prayer['request'] ?? ''

    ]);

}

fclose($output);

exit;
?>
