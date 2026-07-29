<?php

/*
|--------------------------------------------------------------------------
| Supporters Shared Form
|--------------------------------------------------------------------------
|
| Required variables:
|
| $supporter      array
| $submitLabel    string
| $cancelUrl      string
|
*/

$supporter = $supporter ?? [];

$selectedImage = (string)($supporter['photo_media_id'] ?? '');

$fieldName = 'photo_media_id';

$fieldLabel = 'Supporter Photo';

$selectedSupportType = $supporter['support_type'] ?? 'Prayer';

$selectedStatus = $supporter['status'] ?? 'active';

?>

<div class="row">

    <!-- LEFT COLUMN -->

    <div class="col-lg-7">

        <?php

        $cardTitle = 'Supporter Information';
        $cardIcon  = 'fa-solid fa-hand-holding-heart';

        require ADMIN_COMPONENTS . '/card.php';

        ?>

        <div class="mb-4">

            <label class="form-label">

                Name
                <span class="text-danger">*</span>

            </label>

            <input
                type="text"
                name="name"
                class="form-control"
                required
                value="<?= htmlspecialchars($supporter['name'] ?? '') ?>">

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="mb-4">

                    <label class="form-label">

                        Email

                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?= htmlspecialchars($supporter['email'] ?? '') ?>">

                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-4">

                    <label class="form-label">

                        Phone

                    </label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="<?= htmlspecialchars($supporter['phone'] ?? '') ?>">

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="mb-4">

                    <label class="form-label">

                        Country

                    </label>

                    <input
                        type="text"
                        name="country"
                        class="form-control"
                        value="<?= htmlspecialchars($supporter['country'] ?? '') ?>">

                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-4">

                    <label class="form-label">

                        City

                    </label>

                    <input
                        type="text"
                        name="city"
                        class="form-control"
                        value="<?= htmlspecialchars($supporter['city'] ?? '') ?>">

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="mb-4">

                    <label class="form-label">

                        Support Type

                    </label>

                    <select
                        name="support_type"
                        class="form-select">

                        <?php
                        $types = [
                            'Prayer',
                            'Volunteer',
                            'One Time Donation',
                            'Monthly Partner',
                            'Sponsor'
                        ];

                        foreach ($types as $type):
                        ?>

                            <option
                                value="<?= $type ?>"
                                <?= $selectedSupportType === $type ? 'selected' : '' ?>>

                                <?= htmlspecialchars($type) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

            <div class="col-md-3">

                <div class="mb-4">

                    <label class="form-label">

                        Amount

                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="amount"
                        class="form-control"
                        value="<?= htmlspecialchars($supporter['amount'] ?? '') ?>">

                </div>

            </div>

            <div class="col-md-3">

                <div class="mb-4">

                    <label class="form-label">

                        Currency

                    </label>

                    <input
                        type="text"
                        name="currency"
                        class="form-control"
                        value="<?= htmlspecialchars($supporter['currency'] ?? 'INR') ?>">

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="mb-4">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option
                            value="active"
                            <?= $selectedStatus === 'active' ? 'selected' : '' ?>>

                            Active

                        </option>

                        <option
                            value="inactive"
                            <?= $selectedStatus === 'inactive' ? 'selected' : '' ?>>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-4">

                    <label class="form-label">

                        Display Order

                    </label>

                    <input
                        type="number"
                        name="display_order"
                        class="form-control"
                        value="<?= htmlspecialchars($supporter['display_order'] ?? 0) ?>">

                </div>

            </div>

        </div>

        <div class="form-check mb-4">

            <input
                class="form-check-input"
                type="checkbox"
                name="is_featured"
                value="1"
                id="is_featured"
                <?= !empty($supporter['is_featured']) ? 'checked' : '' ?>>

            <label
                class="form-check-label"
                for="is_featured">

                Featured Supporter

            </label>

        </div>

        <?php

        require ADMIN_COMPONENTS . '/card-end.php';

        ?>

    </div>

    <!-- RIGHT COLUMN -->

    <div class="col-lg-5">

        <?php

        $cardTitle = 'Supporter Photo';
        $cardIcon  = 'fa-solid fa-image';

        require ADMIN_COMPONENTS . '/card.php';

        require ADMIN_COMPONENTS . '/media-picker.php';

        require ADMIN_COMPONENTS . '/card-end.php';

        ?>

    </div>

</div>

<?php

$cardTitle = 'Message';
$cardIcon  = 'fa-solid fa-comment';

require ADMIN_COMPONENTS . '/card.php';

?>

<textarea
    name="message"
    rows="8"
    class="form-control"><?= htmlspecialchars($supporter['message'] ?? '') ?></textarea>

<?php

require ADMIN_COMPONENTS . '/card-end.php';

$cancelLabel = 'Cancel';

require ADMIN_COMPONENTS . '/form-actions.php';