<?php

use App\Services\WebsiteService;

$websiteService = new WebsiteService();
$supporters = $websiteService->getFeaturedSupporters(6);

if (empty($supporters)) {
    return;
}
?>

<section id="supporters" class="py-5 bg-light">

    <div class="container">

        <div class="section-heading text-center mb-5">

            <h2>🤝 Ministry Partners</h2>

            <p>
                We thank God for every prayer partner, volunteer and supporter
                helping spread the Gospel through SingThyGlory Ministry.
            </p>

        </div>

        <div class="row">

            <?php foreach ($supporters as $supporter): ?>

                <?php
                $image = null;

                if (!empty($supporter['photo']['path'])) {
                    $image = '/' . ltrim($supporter['photo']['path'], '/');
                }
                ?>

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="card h-100 shadow-sm border-0">

                        <div class="card-body text-center">

                            <?php if ($image): ?>

                                <img
                                    src="<?= htmlspecialchars($image) ?>"
                                    alt="<?= htmlspecialchars($supporter['name']) ?>"
                                    class="rounded-circle mb-3"
                                    style="width:120px;height:120px;object-fit:cover;">

                            <?php else: ?>

                                <div class="mb-3">
                                    <i class="fa-solid fa-user-circle fa-5x text-secondary"></i>
                                </div>

                            <?php endif; ?>

                            <h5><?= htmlspecialchars($supporter['name']) ?></h5>

                            <?php if (!empty($supporter['country'])): ?>

                                <div class="text-muted mb-2">
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

                                <p class="mb-0">
                                    <?= nl2br(htmlspecialchars($supporter['message'])) ?>
                                </p>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>