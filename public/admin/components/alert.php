<?php

/**
 * ---------------------------------------------------------
 * Alert Component
 * ---------------------------------------------------------
 *
 * Variables:
 *
 * $alertType
 * $alertMessage
 * $dismissible
 *
 * Types:
 * success
 * danger
 * warning
 * info
 */

$alertType = $alertType ?? 'info';
$alertMessage = $alertMessage ?? '';
$dismissible = $dismissible ?? true;

if (trim($alertMessage) === '') {
    return;
}
?>

<div class="alert alert-<?= htmlspecialchars($alertType) ?> <?= $dismissible ? 'alert-dismissible fade show' : '' ?>"
     role="alert">

    <?= nl2br(htmlspecialchars($alertMessage)) ?>

    <?php if ($dismissible): ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>

    <?php endif; ?>

</div>