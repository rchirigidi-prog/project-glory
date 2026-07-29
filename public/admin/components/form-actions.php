<?php

/**
 * ------------------------------------------------------------------
 * Form Actions Component
 * ------------------------------------------------------------------
 *
 * Variables:
 *
 * $cancelUrl         string
 * $cancelLabel       string
 * $submitLabel       string
 * $submitIcon        string
 * $submitClass       string
 *
 */

$cancelUrl = $cancelUrl ?? 'index.php';

$cancelLabel = $cancelLabel ?? 'Cancel';

$submitLabel = $submitLabel ?? 'Save';

$submitIcon = $submitIcon ?? 'fa-solid fa-floppy-disk';

$submitClass = $submitClass ?? 'btn-primary';

?>

<hr class="my-4">

<div class="d-flex justify-content-end gap-2">

    <a
        href="<?= htmlspecialchars($cancelUrl) ?>"
        class="btn btn-outline-secondary btn-lg">

        <i class="fa-solid fa-xmark me-2"></i>

        <?= htmlspecialchars($cancelLabel) ?>

    </a>

    <button
        type="submit"
        class="btn <?= htmlspecialchars($submitClass) ?> btn-lg">

        <i class="<?= htmlspecialchars($submitIcon) ?> me-2"></i>

        <?= htmlspecialchars($submitLabel) ?>

    </button>

</div>