<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\SongController;
use App\Core\Flash;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Media;

$controller = new SongController();

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {

    Flash::set(
        'error',
        'Invalid song selected.'
    );

    header('Location: index.php');
    exit;
}

$song = $controller->show($id);

if (!$song) {

    Flash::set(
        'error',
        'Song not found.'
    );

    header('Location: index.php');
    exit;
}

$artistModel = new Artist();
$albumModel  = new Album();
$mediaModel  = new Media();

$artists = $artistModel->allLatest();
$albums  = $albumModel->allLatest();

$audioFiles = method_exists($mediaModel, 'getAudioFiles')
    ? $mediaModel->getAudioFiles()
    : [];

$imageFiles = method_exists($mediaModel, 'getImageFiles')
    ? $mediaModel->getImageFiles()
    : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($controller->update($id, $_POST)) {

        header('Location: index.php');
        exit;
    }

    $song = array_merge($song, $_POST);
}

function oldValue(array $song, string $key, string $default = ''): string
{
    return htmlspecialchars(
        (string)($song[$key] ?? $default)
    );
}

ob_start();
?>

<h2 class="mb-4">
    <i class="fa-solid fa-pen"></i>
    Edit Song
</h2>

<?php if (Flash::has('success')): ?>

<div class="alert alert-success alert-dismissible fade show">

    <?= htmlspecialchars(Flash::get('success')) ?>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

<?php endif; ?>

<?php if (Flash::has('error')): ?>

<div class="alert alert-danger alert-dismissible fade show">

    <?= htmlspecialchars(Flash::get('error')) ?>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

<?php endif; ?>

<div class="card shadow">

    <div class="card-body">

        <form method="POST">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Artist
                    </label>

                    <select
                        name="artist_id"
                        class="form-select">

                        <option value="">
                            Select Artist
                        </option>

                        <?php foreach ($artists as $artist): ?>

                        <option
                            value="<?= $artist['id'] ?>"
                            <?= oldValue($song, 'artist_id') == $artist['id'] ? 'selected' : '' ?>>

                            <?= htmlspecialchars($artist['name']) ?>

                        </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Album
                    </label>

                    <select
                        name="album_id"
                        class="form-select">

                        <option value="">
                            Select Album
                        </option>

                        <?php foreach ($albums as $album): ?>

                        <option
                            value="<?= $album['id'] ?>"
                            <?= oldValue($song, 'album_id') == $album['id'] ? 'selected' : '' ?>>

                            <?= htmlspecialchars($album['title']) ?>

                        </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>
            <div class="row">

                <div class="col-md-8 mb-3">

                    <label class="form-label">
                        Song Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="<?= oldValue($song, 'title') ?>"
                        placeholder="Enter Song Title"
                        required>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Language
                    </label>

                    <select
                        name="language"
                        class="form-select">

                        <option
                            value="English"
                            <?= oldValue($song, 'language', 'English') === 'English' ? 'selected' : '' ?>>
                            English
                        </option>

                        <option
                            value="Hindi"
                            <?= oldValue($song, 'language') === 'Hindi' ? 'selected' : '' ?>>
                            Hindi
                        </option>

                        <option
                            value="Telugu"
                            <?= oldValue($song, 'language') === 'Telugu' ? 'selected' : '' ?>>
                            Telugu
                        </option>

                        <option
                            value="Instrumental"
                            <?= oldValue($song, 'language') === 'Instrumental' ? 'selected' : '' ?>>
                            Instrumental
                        </option>

                        <option
                            value="Multi-language"
                            <?= oldValue($song, 'language') === 'Multi-language' ? 'selected' : '' ?>>
                            Multi-language
                        </option>

                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Duration
                    </label>

                    <input
                        type="text"
                        name="duration"
                        class="form-control"
                        value="<?= oldValue($song, 'duration') ?>"
                        placeholder="00:03:45">

                    <small class="text-muted">
                        Format: HH:MM:SS or MM:SS
                    </small>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Release Date
                    </label>

                    <input
                        type="date"
                        name="release_date"
                        class="form-control"
                        value="<?= oldValue($song, 'release_date') ?>">

                </div>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Audio File
                </label>

                <select
                    name="audio_media_id"
                    class="form-select">

                    <option value="">
                        Select Audio File
                    </option>

                    <?php foreach ($audioFiles as $audio): ?>

                    <option
                        value="<?= $audio['id'] ?>"
                        <?= oldValue($song, 'audio_media_id') == $audio['id'] ? 'selected' : '' ?>>

                        <?= htmlspecialchars($audio['original_name']) ?>

                    </option>

                    <?php endforeach; ?>

                </select>

            </div>
             <div class="mb-3">

                <label class="form-label">
                    Cover Image
                </label>

                <select
                    name="cover_media_id"
                    class="form-select">

                    <option value="">
                        Select Cover Image
                    </option>

                    <?php foreach ($imageFiles as $image): ?>

                    <option
                        value="<?= $image['id'] ?>"
                        <?= oldValue($song, 'cover_media_id') == $image['id'] ? 'selected' : '' ?>>

                        <?= htmlspecialchars($image['original_name']) ?>

                    </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    YouTube URL
                </label>

                <input
                    type="url"
                    name="youtube_url"
                    class="form-control"
                    value="<?= oldValue($song, 'youtube_url') ?>"
                    placeholder="https://youtube.com/watch?v=...">

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Status
                </label>

                <select
                    name="status"
                    class="form-select">

                    <option
                        value="draft"
                        <?= oldValue($song, 'status') === 'draft' ? 'selected' : '' ?>>
                        Draft
                    </option>

                    <option
                        value="published"
                        <?= oldValue($song, 'status') === 'published' ? 'selected' : '' ?>>
                        Published
                    </option>

                </select>

            </div>
             <div class="d-flex justify-content-between">

                <a
                    href="index.php"
                    class="btn btn-secondary">

                    <i class="fa-solid fa-arrow-left"></i>

                    Cancel

                </a>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Save Changes

                </button>

            </div>

        </form>

    </div>

</div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';
                                  