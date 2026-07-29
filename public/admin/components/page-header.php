<?php

$pageTitle = $pageTitle ?? 'Dashboard';
$pageIcon = $pageIcon ?? 'fa-solid fa-table-columns';

$backUrl = $backUrl ?? null;
$backLabel = $backLabel ?? 'Back';

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">

            <i class="<?= htmlspecialchars($pageIcon) ?> me-2"></i>

            <?= htmlspecialchars($pageTitle) ?>

        </h2>

    </div>

    <?php if ($backUrl): ?>

        <a
            href="<?= htmlspecialchars($backUrl) ?>"
            class="btn btn-outline-secondary">

            <i class="fa-solid fa-arrow-left me-2"></i>

            <?= htmlspecialchars($backLabel) ?>

        </a>

    <?php endif; ?>

</div>