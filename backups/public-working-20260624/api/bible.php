<?php

header('Content-Type: application/json');

$verses = [

[
"text"=>"For God so loved the world that He gave His one and only Son.",
"reference"=>"John 3:16"
],

[
"text"=>"The Lord is my Shepherd; I shall not want.",
"reference"=>"Psalm 23:1"
],

[
"text"=>"I can do all things through Christ who strengthens me.",
"reference"=>"Philippians 4:13"
],

[
"text"=>"Trust in the Lord with all your heart.",
"reference"=>"Proverbs 3:5"
],

[
"text"=>"The joy of the Lord is your strength.",
"reference"=>"Nehemiah 8:10"
]

];

echo json_encode(

$verses[array_rand($verses)]

);