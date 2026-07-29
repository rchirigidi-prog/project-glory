<?php

use App\Config\Languages;

$fieldName = $fieldName ?? 'language';
$fieldLabel = $fieldLabel ?? 'Language';
$selectedLanguage = $selectedLanguage ?? '';

$languages = Languages::all();
?>

<div class="mb-4">

    <label class="form-label">

        <?= htmlspecialchars($fieldLabel) ?>

    </label>

    <select
        name="<?= htmlspecialchars($fieldName) ?>"
        class="form-select">

        <?php foreach ($languages as $value => $label): ?>

            <option
                value="<?= htmlspecialchars($value) ?>"
                <?= $selectedLanguage === $value ? 'selected' : '' ?>>

                <?= htmlspecialchars($label) ?>

            </option>

        <?php endforeach; ?>

    </select>

</div>