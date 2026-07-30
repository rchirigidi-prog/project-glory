<?php

use App\Services\WebsiteService;

$websiteService = new WebsiteService();
$supporters = $websiteService->getFeaturedSupporters(6);

if (empty($supporters)) {
    return;
}
?>

<section id="supporters" class="supporters-section">

    <div class="container">

        <div class="text-center mb-5">

            <span class="section-subtitle">

                OUR SUPPORTERS

            </span>

            <h2>

                Ministry Partners

            </h2>

            <p class="section-description">

                We thank God for every prayer partner, volunteer and supporter
                helping spread the Gospel through SingThyGlory Ministry around
                the world.

            </p>

        </div>

        <div class="row g-4">

            <?php foreach ($supporters as $supporter): ?>

                <?php
                $image = null;

                if (!empty($supporter['photo']['path'])) {
                    $image = '/' . ltrim($supporter['photo']['path'], '/');
                }
                ?>

                <div class="col-lg-4 col-md-6">

                    <div class="supporter-card card-custom h-100">

                        <?php if ($image): ?>

                            <img
                                src="<?= htmlspecialchars($image) ?>"
                                alt="<?= htmlspecialchars($supporter['name']) ?>"
                                class="supporter-photo"
                                loading="lazy">

                        <?php else: ?>

                            <div class="supporter-placeholder">

                                <i class="fa-solid fa-user"></i>

                            </div>

                        <?php endif; ?>

                        <h4>

                            <?= htmlspecialchars($supporter['name']) ?>

                        </h4>

                        <?php if (!empty($supporter['country'])): ?>

                            <div class="supporter-country">

                                <i class="fa-solid fa-location-dot"></i>

                                <?= htmlspecialchars($supporter['country']) ?>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($supporter['support_type'])): ?>

                            <span class="badge bg-primary mb-3">

                                <?= htmlspecialchars($supporter['support_type']) ?>

                            </span>

                        <?php endif; ?>

                        <?php if (!empty($supporter['message'])): ?>

                            <p>

                                <?= nl2br(htmlspecialchars($supporter['message'])) ?>

                            </p>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>