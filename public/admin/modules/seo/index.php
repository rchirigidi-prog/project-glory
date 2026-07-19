<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\SeoController;

$controller = new SeoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update();
}

$data = $controller->index();

ob_start();
?>

<h2 class="mb-4">

    <i class="fa-solid fa-magnifying-glass-chart"></i>

    SEO Manager

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

        <i class="fa-solid fa-globe"></i>

        Global SEO Settings

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    SEO Title
                </label>

                <input
                    type="text"
                    name="seo_title"
                    class="form-control"
                    value="<?= htmlspecialchars($data['seo_title']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Canonical URL
                </label>

                <input
                    type="url"
                    name="canonical_url"
                    class="form-control"
                    value="<?= htmlspecialchars($data['canonical_url']) ?>">

            </div>

            <div class="col-12 mb-3">

                <label class="form-label">
                    Meta Description
                </label>

                <textarea
                    name="meta_description"
                    rows="4"
                    class="form-control"><?= htmlspecialchars($data['meta_description']) ?></textarea>

            </div>

            <div class="col-12 mb-3">

                <label class="form-label">
                    Meta Keywords
                </label>

                <textarea
                    name="meta_keywords"
                    rows="3"
                    class="form-control"><?= htmlspecialchars($data['meta_keywords']) ?></textarea>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Meta Robots
                </label>

                <input
                    type="text"
                    name="meta_robots"
                    class="form-control"
                    placeholder="index, follow"
                    value="<?= htmlspecialchars($data['meta_robots']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    SEO Author
                </label>

                <input
                    type="text"
                    name="seo_author"
                    class="form-control"
                    value="<?= htmlspecialchars($data['seo_author']) ?>">

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Language
                </label>

                <input
                    type="text"
                    name="seo_language"
                    class="form-control"
                    placeholder="en-IN"
                    value="<?= htmlspecialchars($data['seo_language']) ?>">

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Theme Color
                </label>

                <input
                    type="text"
                    name="theme_color"
                    class="form-control"
                    placeholder="#0d6efd"
                    value="<?= htmlspecialchars($data['theme_color']) ?>">

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Favicon URL
                </label>

                <input
                    type="url"
                    name="favicon_url"
                    class="form-control"
                    value="<?= htmlspecialchars($data['favicon_url']) ?>">

            </div>

        </div>

    </div>

</div>
<div class="card shadow mb-4">

    <div class="card-header bg-success text-white">

        <i class="fa-brands fa-facebook"></i>

        Open Graph (Facebook, WhatsApp & LinkedIn)

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Open Graph Title
                </label>

                <input
                    type="text"
                    name="og_title"
                    class="form-control"
                    value="<?= htmlspecialchars($data['og_title']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Open Graph URL
                </label>

                <input
                    type="url"
                    name="og_url"
                    class="form-control"
                    value="<?= htmlspecialchars($data['og_url']) ?>">

            </div>

            <div class="col-12 mb-3">

                <label class="form-label">
                    Open Graph Description
                </label>

                <textarea
                    name="og_description"
                    rows="4"
                    class="form-control"><?= htmlspecialchars($data['og_description']) ?></textarea>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Open Graph Image
                </label>

                <input
                    type="url"
                    name="og_image"
                    class="form-control"
                    value="<?= htmlspecialchars($data['og_image']) ?>">

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label">
                    OG Type
                </label>

                <select
                    name="og_type"
                    class="form-select">

                    <option value="website" <?= ($data['og_type'] === 'website') ? 'selected' : '' ?>>
                        Website
                    </option>

                    <option value="music.album" <?= ($data['og_type'] === 'music.album') ? 'selected' : '' ?>>
                        Music Album
                    </option>

                    <option value="music.song" <?= ($data['og_type'] === 'music.song') ? 'selected' : '' ?>>
                        Music Song
                    </option>

                    <option value="article" <?= ($data['og_type'] === 'article') ? 'selected' : '' ?>>
                        Article
                    </option>

                </select>

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label">
                    OG Locale
                </label>

                <input
                    type="text"
                    name="og_locale"
                    class="form-control"
                    placeholder="en_US"
                    value="<?= htmlspecialchars($data['og_locale']) ?>">

            </div>

            <div class="col-12 mb-3">

                <label class="form-label">
                    Site Name
                </label>

                <input
                    type="text"
                    name="og_site_name"
                    class="form-control"
                    value="<?= htmlspecialchars($data['og_site_name']) ?>">

            </div>

        </div>

    </div>

</div>

<div class="card shadow mb-4">

    <div class="card-header bg-info text-white">

        <i class="fa-brands fa-x-twitter"></i>

        Twitter Cards

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Twitter Title
                </label>

                <input
                    type="text"
                    name="twitter_title"
                    class="form-control"
                    value="<?= htmlspecialchars($data['twitter_title']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Twitter Username
                </label>

                <input
                    type="text"
                    name="twitter_site"
                    class="form-control"
                    placeholder="@SingThyGlory"
                    value="<?= htmlspecialchars($data['twitter_site']) ?>">

            </div>

            <div class="col-12 mb-3">

                <label class="form-label">
                    Twitter Description
                </label>

                <textarea
                    name="twitter_description"
                    rows="4"
                    class="form-control"><?= htmlspecialchars($data['twitter_description']) ?></textarea>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Twitter Image
                </label>

                <input
                    type="url"
                    name="twitter_image"
                    class="form-control"
                    value="<?= htmlspecialchars($data['twitter_image']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Twitter Card Type
                </label>

                <select
                    name="twitter_card"
                    class="form-select">

                    <option value="summary" <?= ($data['twitter_card'] === 'summary') ? 'selected' : '' ?>>
                        Summary
                    </option>

                    <option value="summary_large_image" <?= ($data['twitter_card'] === 'summary_large_image') ? 'selected' : '' ?>>
                        Summary Large Image
                    </option>

                </select>

            </div>

        </div>

    </div>

</div>
<div class="card shadow mb-4">

    <div class="card-header bg-warning text-dark">

        <i class="fa-solid fa-shield-halved"></i>

        Search Engine Verification

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Google Search Console Verification
                </label>

                <input
                    type="text"
                    name="google_verification"
                    class="form-control"
                    value="<?= htmlspecialchars($data['google_verification']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Bing Webmaster Verification
                </label>

                <input
                    type="text"
                    name="bing_verification"
                    class="form-control"
                    value="<?= htmlspecialchars($data['bing_verification']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Yandex Verification
                </label>

                <input
                    type="text"
                    name="yandex_verification"
                    class="form-control"
                    value="<?= htmlspecialchars($data['yandex_verification']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Pinterest Verification
                </label>

                <input
                    type="text"
                    name="pinterest_verification"
                    class="form-control"
                    value="<?= htmlspecialchars($data['pinterest_verification']) ?>">

            </div>

        </div>

    </div>

</div>

<div class="card shadow mb-4">

    <div class="card-header bg-secondary text-white">

        <i class="fa-solid fa-chart-line"></i>

        Analytics & Tracking

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Google Analytics (GA4 ID)
                </label>

                <input
                    type="text"
                    name="google_analytics"
                    class="form-control"
                    placeholder="G-XXXXXXXXXX"
                    value="<?= htmlspecialchars($data['google_analytics']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Google Tag Manager
                </label>

                <input
                    type="text"
                    name="google_tag_manager"
                    class="form-control"
                    placeholder="GTM-XXXXXXX"
                    value="<?= htmlspecialchars($data['google_tag_manager']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Microsoft Clarity
                </label>

                <input
                    type="text"
                    name="microsoft_clarity"
                    class="form-control"
                    value="<?= htmlspecialchars($data['microsoft_clarity']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Facebook Pixel
                </label>

                <input
                    type="text"
                    name="facebook_pixel"
                    class="form-control"
                    value="<?= htmlspecialchars($data['facebook_pixel']) ?>">

            </div>

        </div>

    </div>

</div>

<div class="card shadow mb-4">

    <div class="card-header bg-dark text-white">

        <i class="fa-solid fa-gears"></i>

        Technical SEO

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Sitemap URL
                </label>

                <input
                    type="url"
                    name="sitemap_url"
                    class="form-control"
                    value="<?= htmlspecialchars($data['sitemap_url']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Robots.txt URL
                </label>

                <input
                    type="url"
                    name="robots_txt_url"
                    class="form-control"
                    value="<?= htmlspecialchars($data['robots_txt_url']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Apple Touch Icon
                </label>

                <input
                    type="url"
                    name="apple_touch_icon"
                    class="form-control"
                    value="<?= htmlspecialchars($data['apple_touch_icon']) ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Web Manifest URL
                </label>

                <input
                    type="url"
                    name="manifest_url"
                    class="form-control"
                    value="<?= htmlspecialchars($data['manifest_url']) ?>">

            </div>

        </div>

    </div>

</div>
<div class="d-flex justify-content-end mb-4">

    <button
        type="submit"
        class="btn btn-primary btn-lg">

        <i class="fa-solid fa-floppy-disk"></i>

        Save SEO Settings

    </button>

</div>

</form>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';
