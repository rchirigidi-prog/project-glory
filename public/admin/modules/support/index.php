<?php
/**
 * ------------------------------------------------------------
 * SingThyGlory Studio
 * Module : M-008 Support Ministry
 * File   : public/admin/modules/support/index.php
 * ------------------------------------------------------------
 */

$data = $data ?? [];

/**
 * Escape helper
 */
if (!function_exists('e')) {
    function e($value): string
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}
?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Support Ministry</h2>
            <p class="text-muted mb-0">
                Configure the Support Ministry section displayed on the website.
            </p>
        </div>
    </div>

    <form method="POST" action="index.php?module=support&action=save">

        <div class="accordion" id="supportAccordion">

            <!-- ===================================================== -->
            <!-- Section -->
            <!-- ===================================================== -->

            <div class="accordion-item">

                <h2 class="accordion-header">
                    <button class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#sectionCollapse">
                        Website Section
                    </button>
                </h2>

                <div id="sectionCollapse"
                     class="accordion-collapse collapse show"
                     data-bs-parent="#supportAccordion">

                    <div class="accordion-body">

                        <div class="mb-3">
                            <label class="form-label">
                                Section Title
                            </label>

                            <input
                                type="text"
                                name="section_title"
                                class="form-control"
                                value="<?= e($data['section_title'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Section Subtitle
                            </label>

                            <input
                                type="text"
                                name="section_subtitle"
                                class="form-control"
                                value="<?= e($data['section_subtitle'] ?? '') ?>">
                        </div>

                        <div class="mb-0">
                            <label class="form-label">
                                Section Description
                            </label>

                            <textarea
                                name="section_description"
                                rows="4"
                                class="form-control"><?= e($data['section_description'] ?? '') ?></textarea>
                        </div>

                    </div>

                </div>

            </div>

            <!-- ===================================================== -->
            <!-- Prayer -->
            <!-- ===================================================== -->

            <div class="accordion-item">

                <h2 class="accordion-header">

                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#prayerCollapse">

                        Prayer Request

                    </button>

                </h2>

                <div id="prayerCollapse"
                     class="accordion-collapse collapse"
                     data-bs-parent="#supportAccordion">

                    <div class="accordion-body">

                        <div class="form-check form-switch mb-4">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="prayer_enabled"
                                value="1"
                                <?= !empty($data['prayer_enabled']) ? 'checked' : '' ?>>

                            <label class="form-check-label">
                                Enable Prayer Section
                            </label>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Title
                            </label>

                            <input
                                type="text"
                                name="prayer_title"
                                class="form-control"
                                value="<?= e($data['prayer_title'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                class="form-control"
                                rows="4"
                                name="prayer_description"><?= e($data['prayer_description'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Button Text
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="prayer_button_text"
                                value="<?= e($data['prayer_button_text'] ?? '') ?>">
                        </div>

                        <div class="mb-0">
                            <label class="form-label">
                                Button URL
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="prayer_button_url"
                                value="<?= e($data['prayer_button_url'] ?? '') ?>">
                        </div>

                    </div>

                </div>

            </div>

            <!-- ===================================================== -->
            <!-- Donate -->
            <!-- ===================================================== -->

            <div class="accordion-item">

                <h2 class="accordion-header">

                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#donateCollapse">

                        Donate

                    </button>

                </h2>

                <div id="donateCollapse"
                     class="accordion-collapse collapse"
                     data-bs-parent="#supportAccordion">

                    <div class="accordion-body">

                        <div class="form-check form-switch mb-4">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="donate_enabled"
                                value="1"
                                <?= !empty($data['donate_enabled']) ? 'checked' : '' ?>>

                            <label class="form-check-label">
                                Enable Donation Section
                            </label>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Title
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="donate_title"
                                value="<?= e($data['donate_title'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                class="form-control"
                                rows="4"
                                name="donate_description"><?= e($data['donate_description'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Button Text
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="donate_button_text"
                                value="<?= e($data['donate_button_text'] ?? '') ?>">
                        </div>

                        <div>
                            <label class="form-label">
                                Button URL
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="donate_button_url"
                                value="<?= e($data['donate_button_url'] ?? '') ?>">
                        </div>

                    </div>

                </div>

            </div>

            <!-- ===================================================== -->
            <!-- Volunteer -->
            <!-- ===================================================== -->

            <div class="accordion-item">

                <h2 class="accordion-header">

                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#volunteerCollapse">

                        Volunteer

                    </button>

                </h2>

                <div id="volunteerCollapse"
                     class="accordion-collapse collapse"
                     data-bs-parent="#supportAccordion">

                    <div class="accordion-body">

                        <div class="form-check form-switch mb-4">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="volunteer_enabled"
                                value="1"
                                <?= !empty($data['volunteer_enabled']) ? 'checked' : '' ?>>

                            <label class="form-check-label">
                                Enable Volunteer Section
                            </label>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Title
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="volunteer_title"
                                value="<?= e($data['volunteer_title'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                class="form-control"
                                rows="4"
                                name="volunteer_description"><?= e($data['volunteer_description'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Button Text
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="volunteer_button_text"
                                value="<?= e($data['volunteer_button_text'] ?? '') ?>">
                        </div>

                        <div>
                            <label class="form-label">
                                Button URL
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="volunteer_button_url"
                                value="<?= e($data['volunteer_button_url'] ?? '') ?>">
                        </div>

                    </div>

                </div>

            </div>

            <!-- ===================================================== -->
            <!-- Sponsor -->
            <!-- ===================================================== -->

            <div class="accordion-item">

                <h2 class="accordion-header">

                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#sponsorCollapse">

                        Sponsor

                    </button>

                </h2>

                <div id="sponsorCollapse"
                     class="accordion-collapse collapse"
                     data-bs-parent="#supportAccordion">

                    <div class="accordion-body">

                        <div class="form-check form-switch mb-4">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="sponsor_enabled"
                                value="1"
                                <?= !empty($data['sponsor_enabled']) ? 'checked' : '' ?>>

                            <label class="form-check-label">
                                Enable Sponsor Section
                            </label>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Title
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="sponsor_title"
                                value="<?= e($data['sponsor_title'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                class="form-control"
                                rows="4"
                                name="sponsor_description"><?= e($data['sponsor_description'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Button Text
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="sponsor_button_text"
                                value="<?= e($data['sponsor_button_text'] ?? '') ?>">
                        </div>

                        <div>
                            <label class="form-label">
                                Button URL
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="sponsor_button_url"
                                value="<?= e($data['sponsor_button_url'] ?? '') ?>">
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="mt-4 text-end">

            <button
                type="submit"
                class="btn btn-primary btn-lg">

                <i class="fa-solid fa-floppy-disk me-2"></i>
                Save Changes

            </button>

        </div>

    </form>

</div>