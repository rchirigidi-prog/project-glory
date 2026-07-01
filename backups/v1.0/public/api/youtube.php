<?php

header('Content-Type: application/json');

$url = "https://www.youtube.com/feeds/videos.xml?channel_id=UCaMGzh4aj3R60VRG3ZE5vXQ";

$rss = @simplexml_load_file($url);

if ($rss === false) {

    echo json_encode([
        "error" => "Unable to load YouTube RSS feed."
    ]);

    exit;

}

$videos = [];

foreach ($rss->entry as $entry) {

    $yt = $entry->children('yt', true);

    $videoId = (string)$yt->videoId;

    $videos[] = [

        "title" => (string)$entry->title,

        "published" => (string)$entry->published,

        "thumbnail" => "https://i.ytimg.com/vi/".$videoId."/hqdefault.jpg",

        "url" => "https://www.youtube.com/watch?v=".$videoId

    ];

}

echo json_encode($videos);