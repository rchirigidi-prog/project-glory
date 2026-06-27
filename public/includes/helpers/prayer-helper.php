<?php

function loadPrayers($file)
{
    if (!file_exists($file)) {
        return [];
    }

    $prayers = json_decode(file_get_contents($file), true);

    if (!is_array($prayers)) {
        return [];
    }

    foreach ($prayers as &$prayer) {

        if (empty($prayer['id'])) {

            $prayer['id'] = uniqid();

        }

        if (empty($prayer['status'])) {

            $prayer['status'] = 'New';

        }
    }

    return $prayers;
}

function savePrayers($file, $prayers)
{
    file_put_contents(
        $file,
        json_encode($prayers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
}
