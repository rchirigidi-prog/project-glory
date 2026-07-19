<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\SocialMediaController;

$controller = new SocialMediaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $controller->update();

}

$data = $controller->index();

ob_start();
?>

<h2 class="mb-4">

    <i class="fa-solid fa-share-nodes"></i>

    Social Media Manager

</h2>

<?php if (!empty($_SESSION['success'])): ?>

<div class="alert alert-success alert-dismissible fade show">

    <?= htmlspecialchars($_SESSION['success']) ?>

    <?php unset($_SESSION['success']); ?>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

<?php endif; ?>

<form method="POST">

<div class="card shadow mb-4">

<div class="card-header bg-primary text-white">

    <i class="fa-solid fa-share-nodes"></i>

    Social Media Platforms

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

<i class="fa-brands fa-youtube text-danger"></i>

YouTube

</label>

<input
    type="url"
    name="youtube_url"
    class="form-control"
    value="<?= htmlspecialchars($data['youtube_url']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

<i class="fa-brands fa-facebook text-primary"></i>

Facebook

</label>

<input
    type="url"
    name="facebook_url"
    class="form-control"
    value="<?= htmlspecialchars($data['facebook_url']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

<i class="fa-brands fa-instagram"></i>

Instagram

</label>

<input
    type="url"
    name="instagram_url"
    class="form-control"
    value="<?= htmlspecialchars($data['instagram_url']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

<i class="fa-brands fa-x-twitter"></i>

X (Twitter)

</label>

<input
    type="url"
    name="twitter_url"
    class="form-control"
    value="<?= htmlspecialchars($data['twitter_url']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Threads

</label>

<input
    type="url"
    name="threads_url"
    class="form-control"
    value="<?= htmlspecialchars($data['threads_url']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Telegram

</label>

<input
    type="url"
    name="telegram_url"
    class="form-control"
    value="<?= htmlspecialchars($data['telegram_url']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

WhatsApp Channel

</label>

<input
    type="url"
    name="whatsapp_channel_url"
    class="form-control"
    value="<?= htmlspecialchars($data['whatsapp_channel_url']) ?>">

</div>

</div>

</div>

</div>
<div class="card shadow mb-4">

<div class="card-header bg-success text-white">

    <i class="fa-solid fa-music"></i>

    Music Streaming Platforms

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">
Spotify
</label>

<input
    type="url"
    name="spotify_url"
    class="form-control"
    value="<?= htmlspecialchars($data['spotify_url']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
Apple Music
</label>

<input
    type="url"
    name="apple_music_url"
    class="form-control"
    value="<?= htmlspecialchars($data['apple_music_url']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
Amazon Music
</label>

<input
    type="url"
    name="amazon_music_url"
    class="form-control"
    value="<?= htmlspecialchars($data['amazon_music_url']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
YouTube Music
</label>

<input
    type="url"
    name="youtube_music_url"
    class="form-control"
    value="<?= htmlspecialchars($data['youtube_music_url']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
Audiomack
</label>

<input
    type="url"
    name="audiomack_url"
    class="form-control"
    value="<?= htmlspecialchars($data['audiomack_url']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
JioSaavn
</label>

<input
    type="url"
    name="jiosaavn_url"
    class="form-control"
    value="<?= htmlspecialchars($data['jiosaavn_url']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
Gaana
</label>

<input
    type="url"
    name="gaana_url"
    class="form-control"
    value="<?= htmlspecialchars($data['gaana_url']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
Wynk Music
</label>

<input
    type="url"
    name="wynk_url"
    class="form-control"
    value="<?= htmlspecialchars($data['wynk_url']) ?>">

</div>

</div>

</div>

</div>
<div class="card shadow mb-4">

    <div class="card-header bg-info text-white">

        <i class="fa-solid fa-globe"></i>

        Ministry & Contact

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Website URL
                </label>

                <input
                    type="url"
                    name="website_url"
                    class="form-control"
                    value="<?= htmlspecialchars($data['website_url']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Radio URL
                </label>

                <input
                    type="url"
                    name="radio_url"
                    class="form-control"
                    value="<?= htmlspecialchars($data['radio_url']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Listen Live URL
                </label>

                <input
                    type="url"
                    name="listen_live_url"
                    class="form-control"
                    value="<?= htmlspecialchars($data['listen_live_url']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Podcast RSS
                </label>

                <input
                    type="url"
                    name="podcast_rss"
                    class="form-control"
                    value="<?= htmlspecialchars($data['podcast_rss']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email_address"
                    class="form-control"
                    value="<?= htmlspecialchars($data['email_address']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Donate URL
                </label>

                <input
                    type="url"
                    name="donate_url"
                    class="form-control"
                    value="<?= htmlspecialchars($data['donate_url']) ?>">

            </div>

        </div>

    </div>

</div>
    <div class="d-flex justify-content-end mb-4">

        <button
            type="submit"
            class="btn btn-primary btn-lg">

            <i class="fa-solid fa-floppy-disk"></i>

            Save Social Media Settings

        </button>

    </div>

</form>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';