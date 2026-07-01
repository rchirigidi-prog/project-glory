<section class="page-banner">

    <div class="container text-center">

        <h1><?= $pageTitle ?? 'SingThyGlory'; ?></h1>

        <?php if (!empty($pageSubtitle)): ?>

            <p class="lead">
                <?= htmlspecialchars($pageSubtitle) ?>
            </p>

        <?php endif; ?>

    </div>

</section>
