<?php

/**
 * ------------------------------------------------------------------
 * Card Component
 * ------------------------------------------------------------------
 *
 * Variables:
 *
 * $cardTitle      string
 * $cardIcon       string|null
 * $cardFooter     string|null
 *
 */

$cardTitle = $cardTitle ?? '';

$cardIcon = $cardIcon ?? '';

$cardFooter = $cardFooter ?? null;

?>

<div class="card shadow-sm border-0 mb-4">

    <?php if ($cardTitle !== ''): ?>

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <?php if ($cardIcon): ?>

                    <i class="<?= htmlspecialchars($cardIcon) ?> me-2"></i>

                <?php endif; ?>

                <?= htmlspecialchars($cardTitle) ?>

            </h5>

        </div>

    <?php endif; ?>

    <div class="card-body">