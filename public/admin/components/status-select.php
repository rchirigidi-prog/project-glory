<?php

$fieldName = $fieldName ?? 'status';

$fieldLabel = $fieldLabel ?? 'Status';

$selectedStatus = $selectedStatus ?? 'draft';

$options = [
    'draft' => 'Draft',
    'published' => 'Published',
];

?>

<div class="mb-4">

    <label class="form-label">

        <?= htmlspecialchars($fieldLabel) ?>

    </label>

    <select
        name="<?= htmlspecialchars($fieldName) ?>"
        class="form-select">

        <?php foreach ($options as $value => $label): ?>

            <option
                value="<?= htmlspecialchars($value) ?>"
                <?= $selectedStatus === $value ? 'selected' : '' ?>>

                <?= htmlspecialchars($label) ?>

            </option>

        <?php endforeach; ?>

    </select>

</div>