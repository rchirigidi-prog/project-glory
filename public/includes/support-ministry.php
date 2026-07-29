<?php

use App\Services\SupportMinistryService;

$service = new SupportMinistryService();
$data = $service->index();

if (empty($data) || empty($data['is_enabled'])) {
    return;
}

$cards = [
    [
        'icon' => 'fa-solid fa-hands-praying',
        'title' => $data['prayer_title'],
        'description' => $data['prayer_description'],
        'button' => $data['prayer_button_text'],
        'link' => $data['prayer_button_link'],
        'color' => 'primary',
    ],
    [
        'icon' => 'fa-solid fa-hand-holding-heart',
        'title' => $data['donate_title'],
        'description' => $data['donate_description'],
        'button' => $data['donate_button_text'],
        'link' => $data['donate_button_link'],
        'color' => 'success',
    ],
    [
        'icon' => 'fa-solid fa-people-group',
        'title' => $data['volunteer_title'],
        'description' => $data['volunteer_description'],
        'button' => $data['volunteer_button_text'],
        'link' => $data['volunteer_button_link'],
        'color' => 'warning',
    ],
    [
        'icon' => 'fa-solid fa-seedling',
        'title' => $data['sponsor_title'],
        'description' => $data['sponsor_description'],
        'button' => $data['sponsor_button_text'],
        'link' => $data['sponsor_button_link'],
        'color' => 'danger',
    ],
];
?>

<section id="support-ministry" class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <h2>
                <?= htmlspecialchars($data['section_title']) ?>
            </h2>

            <?php if (!empty($data['section_subtitle'])): ?>

                <p class="lead text-muted">
                    <?= htmlspecialchars($data['section_subtitle']) ?>
                </p>

            <?php endif; ?>

        </div>

        <div class="row g-4">

            <?php foreach ($cards as $card): ?>

                <div class="col-lg-3 col-md-6">

                    <div class="card shadow-sm border-0 h-100">

                        <div class="card-body text-center p-4">

                            <div class="mb-4">

                                <i class="<?= $card['icon'] ?> fa-3x text-<?= $card['color'] ?>"></i>

                            </div>

                            <h4 class="mb-3">

                                <?= htmlspecialchars($card['title']) ?>

                            </h4>

                            <p class="text-muted">

                                <?= nl2br(htmlspecialchars($card['description'])) ?>

                            </p>

                        </div>

                        <div class="card-footer bg-white border-0 text-center pb-4">

                            <a
                                href="<?= htmlspecialchars($card['link']) ?>"
                                class="btn btn-<?= $card['color'] ?>">

                                <?= htmlspecialchars($card['button']) ?>

                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>