<?php

use App\Services\SupportMinistryService;

$service = new SupportMinistryService();
$data = $service->index();

if (empty($data)) {
    return;
}

$cards = [];

if (!empty($data['prayer_enabled'])) {
    $cards[] = [
        'icon' => 'fa-solid fa-hands-praying',
        'title' => $data['prayer_title'],
        'description' => $data['prayer_description'],
        'button' => $data['prayer_button_text'],
        'url' => $data['prayer_button_url'],
        'color' => 'primary',
    ];
}

if (!empty($data['donate_enabled'])) {
    $cards[] = [
        'icon' => 'fa-solid fa-hand-holding-heart',
        'title' => $data['donate_title'],
        'description' => $data['donate_description'],
        'button' => $data['donate_button_text'],
        'url' => $data['donate_button_url'],
        'color' => 'success',
    ];
}

if (!empty($data['volunteer_enabled'])) {
    $cards[] = [
        'icon' => 'fa-solid fa-people-group',
        'title' => $data['volunteer_title'],
        'description' => $data['volunteer_description'],
        'button' => $data['volunteer_button_text'],
        'url' => $data['volunteer_button_url'],
        'color' => 'warning',
    ];
}

if (!empty($data['sponsor_enabled'])) {
    $cards[] = [
        'icon' => 'fa-solid fa-seedling',
        'title' => $data['sponsor_title'],
        'description' => $data['sponsor_description'],
        'button' => $data['sponsor_button_text'],
        'url' => $data['sponsor_button_url'],
        'color' => 'danger',
    ];
}

if (empty($cards)) {
    return;
}
?>

<section id="support-ministry" class="support-ministry-section">

    <div class="container">

        <div class="text-center mb-5">

            <span class="section-subtitle">
                SUPPORT THE MINISTRY
            </span>

            <h2 class="section-title">
                <?= htmlspecialchars($data['section_title']) ?>
            </h2>

            <?php if (!empty($data['section_subtitle'])): ?>

                <p class="section-subtitle-text">
                    <?= htmlspecialchars($data['section_subtitle']) ?>
                </p>

            <?php endif; ?>

            <?php if (!empty($data['section_description'])): ?>

                <p class="section-description">
                    <?= nl2br(htmlspecialchars($data['section_description'])) ?>
                </p>

            <?php endif; ?>

        </div>

        <div class="row g-4">

            <?php foreach ($cards as $card): ?>

                <div class="col-lg-3 col-md-6">

                    <div class="support-card card-custom h-100">

                        <div class="support-icon">

                            <i class="<?= $card['icon'] ?>"></i>

                        </div>

                        <h4>

                            <?= htmlspecialchars($card['title']) ?>

                        </h4>

                        <p>

                            <?= nl2br(htmlspecialchars($card['description'])) ?>

                        </p>

                        <?php if (!empty($card['button']) && !empty($card['url'])): ?>

                            <a
                                href="<?= htmlspecialchars($card['url']) ?>"
                                class="btn btn-warning mt-auto">

                                <?= htmlspecialchars($card['button']) ?>

                            </a>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>