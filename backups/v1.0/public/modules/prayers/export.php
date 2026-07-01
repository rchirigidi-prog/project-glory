<?php

require_once __DIR__ . '/../../includes/helpers/prayer-helper.php';

$file = __DIR__ . '/../../storage/prayers.json';

$prayers = loadPrayers($file);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="PrayerRequests_' . date('Y-m-d') . '.csv"');

$output = fopen('php://output', 'w');

fputcsv($output, [
    'Name',
    'Email',
    'Prayer Request',
    'Status',
    'Date'
]);

foreach ($prayers as $prayer) {

    fputcsv($output, [

        $prayer['name'] ?? '',

        $prayer['email'] ?? '',

        $prayer['request'] ?? '',

        $prayer['status'] ?? 'New',

        $prayer['date'] ?? ''

    ]);

}

fclose($output);

exit;
