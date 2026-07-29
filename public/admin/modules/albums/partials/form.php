<?php

/*
|--------------------------------------------------------------------------
| Albums Shared Form
|--------------------------------------------------------------------------
|
| Required variables:
|
| $album          array
| $submitLabel    string
| $cancelUrl      string
|
*/

$album = $album ?? [];

$selectedImage = (string)($album['cover_media_id'] ?? '');

$fieldName = 'cover_media_id';

$fieldLabel = 'Album Cover';

$selectedLanguage = $album['language'] ?? 'English';

$selectedStatus = $album['status'] ?? 'draft';

?>

<div class="row">

    <!-- LEFT COLUMN -->

    <div class="col-lg-7">

        <?php

        $cardTitle = 'Album Information';
        $cardIcon  = 'fa-solid fa-compact-disc';

        require ADMIN_COMPONENTS . '/card.php';

        ?>

        <div class="mb-4">

            <label class="form-label">

                Album Title
                <span class="text-danger">*</span>

            </label>

            <input
                type="text"
                name="title"
                class="form-control"
                required
                value="<?= htmlspecialchars($album['title'] ?? '') ?>">

        </div>

        <?php

        require ADMIN_COMPONENTS . '/language-select.php';

        ?>

        <div class="row">

            <div class="col-md-6">

                <div class="mb-4">

                    <label class="form-label">

                        Release Date

                    </label>

                    <input
                        type="date"
                        name="release_date"
                        class="form-control"
                        value="<?= htmlspecialchars($album['release_date'] ?? '') ?>">

                </div>

            </div>

            <div class="col-md-6">

                <?php

                require ADMIN_COMPONENTS . '/status-select.php';

                ?>

            </div>

        </div>

        <?php

        require ADMIN_COMPONENTS . '/card-end.php';

        ?>

    </div>

    <!-- RIGHT COLUMN -->

    <div class="col-lg-5">

        <?php

        $cardTitle = 'Cover Artwork';
        $cardIcon  = 'fa-solid fa-image';

        require ADMIN_COMPONENTS . '/card.php';

        require ADMIN_COMPONENTS . '/media-picker.php';

        require ADMIN_COMPONENTS . '/card-end.php';

        ?>

    </div>

</div>

<?php

$cardTitle = 'Description';
$cardIcon  = 'fa-solid fa-align-left';

require ADMIN_COMPONENTS . '/card.php';

?>

<textarea
    name="description"
    rows="8"
    class="form-control"><?= htmlspecialchars($album['description'] ?? '') ?></textarea>

<?php

require ADMIN_COMPONENTS . '/card-end.php';

$cancelLabel = 'Cancel';

require ADMIN_COMPONENTS . '/form-actions.php';