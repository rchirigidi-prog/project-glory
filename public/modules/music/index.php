<?php

require_once 'helper.php';

$album = new AlbumHelper();

$albums = $album->getAlbums();

?>

<div class="card shadow border-0">

    <div class="card-header bg-primary text-white">

        <h3 class="mb-0">

            🎵 Content Studio

        </h3>

    </div>

    <div class="card-body">

        <h4>Albums</h4>

        <hr>

        <pre>

<?php print_r($albums); ?>

        </pre>

    </div>

</div>