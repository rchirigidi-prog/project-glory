<?php

use App\Services\MediaService;

$mediaService = new MediaService();

$images = $mediaService->getImageFiles();

$fieldName = $fieldName ?? 'cover_media_id';

$fieldLabel = $fieldLabel ?? 'Cover Image';

$selectedImage = (string)($selectedImage ?? '');

?>

<div class="mb-4">

    <label class="form-label">

        <?= htmlspecialchars($fieldLabel) ?>

    </label>

    <select
        id="media-picker"
        name="<?= htmlspecialchars($fieldName) ?>"
        class="form-select">

        <option value="">-- Select Image --</option>

        <?php foreach ($images as $image): ?>

            <option
                value="<?= (int)$image['id'] ?>"
                data-image="/<?= htmlspecialchars($image['path']) ?>"
                <?= $selectedImage == $image['id'] ? 'selected' : '' ?>>

                <?= htmlspecialchars($image['original_name']) ?>

            </option>

        <?php endforeach; ?>

    </select>

</div>

<div
    id="media-preview-wrapper"
    class="mb-4"
    style="display:none;">

    <label class="form-label">

        Preview

    </label>

    <div class="card">

        <div class="card-body text-center">

            <img
                id="media-preview"
                src=""
                alt="Cover Preview"
                class="img-fluid rounded"
                style="max-height:250px;">

        </div>

    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const picker = document.getElementById('media-picker');

    const preview = document.getElementById('media-preview');

    const wrapper = document.getElementById('media-preview-wrapper');

    function updatePreview() {

        const option = picker.options[picker.selectedIndex];

        const image = option.dataset.image;

        if (!image) {

            wrapper.style.display = 'none';

            preview.src = '';

            return;

        }

        preview.src = image;

        wrapper.style.display = 'block';

    }

    picker.addEventListener('change', updatePreview);

    updatePreview();

});

</script>