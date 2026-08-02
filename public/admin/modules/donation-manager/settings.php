<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

ob_start();

use App\Controllers\DonationManagerController;

$controller = new DonationManagerController();

$settings = $controller->settings();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [

        'id' => (int)($settings['id'] ?? 1),

        'ministry_name' =>
            trim($_POST['ministry_name'] ?? ''),

        'donation_title' =>
            trim($_POST['donation_title'] ?? ''),

        'donation_description' =>
            trim($_POST['donation_description'] ?? ''),

        'thank_you_message' =>
            trim($_POST['thank_you_message'] ?? ''),

        'enable_upi' =>
            isset($_POST['enable_upi']) ? 1 : 0,

        'upi_name' =>
            trim($_POST['upi_name'] ?? ''),

        'upi_id' =>
            trim($_POST['upi_id'] ?? ''),

        'upi_qr_image' =>
            $settings['upi_qr_image'] ?? '',

        'enable_bank' =>
            isset($_POST['enable_bank']) ? 1 : 0,

        'bank_name' =>
            trim($_POST['bank_name'] ?? ''),

        'account_name' =>
            trim($_POST['account_name'] ?? ''),

        'account_number' =>
            trim($_POST['account_number'] ?? ''),

        'ifsc_code' =>
            trim($_POST['ifsc_code'] ?? ''),

        'branch_name' =>
            trim($_POST['branch_name'] ?? ''),

        'swift_code' =>
            trim($_POST['swift_code'] ?? ''),

        'enable_razorpay' =>
            isset($_POST['enable_razorpay']) ? 1 : 0,

        'razorpay_link' =>
            trim($_POST['razorpay_link'] ?? ''),

        'enable_paypal' =>
            isset($_POST['enable_paypal']) ? 1 : 0,

        'paypal_link' =>
            trim($_POST['paypal_link'] ?? ''),

        'enable_stripe' =>
            isset($_POST['enable_stripe']) ? 1 : 0,

        'stripe_link' =>
            trim($_POST['stripe_link'] ?? '')

    ];

    $controller->saveSettings($data);

    header(
        'Location: ?module=donation-manager&action=settings&saved=1'
    );

    exit;

}

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="fa-solid fa-gear text-primary me-2"></i>

                Donation Settings

            </h2>

            <p class="text-muted mb-0">

                Configure all payment methods used by your ministry.

            </p>

        </div>

    </div>

<?php if (isset($_GET['saved'])): ?>

<div class="alert alert-success">

    <i class="fa-solid fa-circle-check me-2"></i>

    Donation settings updated successfully.

</div>

<?php endif; ?>

<form
    method="post"
    enctype="multipart/form-data">

<ul
    class="nav nav-tabs mb-4"
    id="donationTabs"
    role="tablist">

    <li class="nav-item">

        <button
            class="nav-link active"
            data-bs-toggle="tab"
            data-bs-target="#general">

            General

        </button>

    </li>

    <li class="nav-item">

        <button
            class="nav-link"
            data-bs-toggle="tab"
            data-bs-target="#upi">

            UPI

        </button>

    </li>

    <li class="nav-item">

        <button
            class="nav-link"
            data-bs-toggle="tab"
            data-bs-target="#bank">

            Bank

        </button>

    </li>

    <li class="nav-item">

        <button
            class="nav-link"
            data-bs-toggle="tab"
            data-bs-target="#razorpay">

            Razorpay

        </button>

    </li>

    <li class="nav-item">

        <button
            class="nav-link"
            data-bs-toggle="tab"
            data-bs-target="#paypal">

            PayPal

        </button>

    </li>

    <li class="nav-item">

        <button
            class="nav-link"
            data-bs-toggle="tab"
            data-bs-target="#stripe">

            Stripe

        </button>

    </li>

</ul>

<div class="tab-content">

<div
    class="tab-pane fade show active"
    id="general">

<div class="card shadow-sm border-0">

<div class="card-body">

<div class="mb-3">

<label class="form-label">

Ministry Name

</label>

<input
    type="text"
    name="ministry_name"
    class="form-control"
    value="<?= htmlspecialchars($settings['ministry_name'] ?? '') ?>">

</div>

<div class="mb-3">

<label class="form-label">

Donation Title

</label>

<input
    type="text"
    name="donation_title"
    class="form-control"
    value="<?= htmlspecialchars($settings['donation_title'] ?? '') ?>">

</div>

<div class="mb-3">

<label class="form-label">

Donation Description

</label>

<textarea
    name="donation_description"
    class="form-control"
    rows="5"><?= htmlspecialchars($settings['donation_description'] ?? '') ?></textarea>

</div>

<div class="mb-0">

<label class="form-label">

Thank You Message

</label>

<textarea
    name="thank_you_message"
    class="form-control"
    rows="5"><?= htmlspecialchars($settings['thank_you_message'] ?? '') ?></textarea>

</div>

</div>

</div>

</div>
<div
    class="tab-pane fade"
    id="upi">

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="form-check form-switch mb-4">

                <input
                    class="form-check-input"
                    type="checkbox"
                    id="enable_upi"
                    name="enable_upi"
                    <?= !empty($settings['enable_upi']) ? 'checked' : '' ?>>

                <label
                    class="form-check-label"
                    for="enable_upi">

                    Enable UPI Payments

                </label>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    UPI Display Name

                </label>

                <input
                    type="text"
                    class="form-control"
                    name="upi_name"
                    placeholder="SingThyGlory Digital Services"
                    value="<?= htmlspecialchars($settings['upi_name'] ?? '') ?>">

                <div class="form-text">

                    This name will be shown to donors.

                </div>

            </div>

            <div class="mb-4">

                <label class="form-label">

                    UPI ID

                </label>

                <input
                    type="text"
                    class="form-control"
                    name="upi_id"
                    placeholder="yourname@bank"
                    value="<?= htmlspecialchars($settings['upi_id'] ?? '') ?>">

                <div class="form-text">

                    Example: singthyglory@ibl

                </div>

            </div>

            <hr>

            <h5 class="mb-3">

                QR Code

            </h5>

            <?php if (!empty($settings['upi_qr_image'])): ?>

                <div class="mb-3">

                    <img
                        src="/<?= htmlspecialchars($settings['upi_qr_image']) ?>"
                        class="img-thumbnail"
                        style="max-width:220px;">

                </div>

            <?php endif; ?>

            <div class="mb-3">

                <label class="form-label">

                    Upload New QR Code

                </label>

                <input
                    type="file"
                    class="form-control"
                    name="upi_qr_image"
                    accept=".png,.jpg,.jpeg,.webp">

                <div class="form-text">

                    Recommended size: 600 × 600 pixels.

                </div>

            </div>

            <div class="alert alert-info mb-0">

                <i class="fa-solid fa-circle-info me-2"></i>

                Uploading a new QR Code will replace the previous one after it is saved.

            </div>

        </div>

    </div>

</div>
<div
    class="tab-pane fade"
    id="bank">

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="form-check form-switch mb-4">

                <input
                    class="form-check-input"
                    type="checkbox"
                    id="enable_bank"
                    name="enable_bank"
                    <?= !empty($settings['enable_bank']) ? 'checked' : '' ?>>

                <label
                    class="form-check-label"
                    for="enable_bank">

                    Enable Bank Transfer

                </label>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Bank Name

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="bank_name"
                        value="<?= htmlspecialchars($settings['bank_name'] ?? '') ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Account Name

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="account_name"
                        value="<?= htmlspecialchars($settings['account_name'] ?? '') ?>">

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Account Number

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="account_number"
                        value="<?= htmlspecialchars($settings['account_number'] ?? '') ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        IFSC Code

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="ifsc_code"
                        value="<?= htmlspecialchars($settings['ifsc_code'] ?? '') ?>">

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Branch Name

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="branch_name"
                        value="<?= htmlspecialchars($settings['branch_name'] ?? '') ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        SWIFT Code (Optional)

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="swift_code"
                        value="<?= htmlspecialchars($settings['swift_code'] ?? '') ?>">

                </div>

            </div>

            <div class="alert alert-info mb-0">

                <i class="fa-solid fa-building-columns me-2"></i>

                These bank details will be displayed to donors when Bank Transfer is enabled.

            </div>

        </div>

    </div>

</div>
<div
    class="tab-pane fade"
    id="razorpay">

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="form-check form-switch mb-4">

                <input
                    class="form-check-input"
                    type="checkbox"
                    id="enable_razorpay"
                    name="enable_razorpay"
                    <?= !empty($settings['enable_razorpay']) ? 'checked' : '' ?>>

                <label
                    class="form-check-label"
                    for="enable_razorpay">

                    Enable Razorpay

                </label>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Razorpay Payment Link

                </label>

                <input
                    type="url"
                    class="form-control"
                    name="razorpay_link"
                    placeholder="https://rzp.io/..."
                    value="<?= htmlspecialchars($settings['razorpay_link'] ?? '') ?>">

            </div>

            <div class="alert alert-info mb-0">

                <i class="fa-solid fa-circle-info me-2"></i>

                Paste your Razorpay Payment Link here.

            </div>

        </div>

    </div>

</div>

<div
    class="tab-pane fade"
    id="paypal">

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="form-check form-switch mb-4">

                <input
                    class="form-check-input"
                    type="checkbox"
                    id="enable_paypal"
                    name="enable_paypal"
                    <?= !empty($settings['enable_paypal']) ? 'checked' : '' ?>>

                <label
                    class="form-check-label"
                    for="enable_paypal">

                    Enable PayPal

                </label>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    PayPal Link

                </label>

                <input
                    type="url"
                    class="form-control"
                    name="paypal_link"
                    placeholder="https://paypal.me/..."
                    value="<?= htmlspecialchars($settings['paypal_link'] ?? '') ?>">

            </div>

            <div class="alert alert-info mb-0">

                <i class="fa-solid fa-circle-info me-2"></i>

                Paste your PayPal donation link.

            </div>

        </div>

    </div>

</div>

<div
    class="tab-pane fade"
    id="stripe">

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="form-check form-switch mb-4">

                <input
                    class="form-check-input"
                    type="checkbox"
                    id="enable_stripe"
                    name="enable_stripe"
                    <?= !empty($settings['enable_stripe']) ? 'checked' : '' ?>>

                <label
                    class="form-check-label"
                    for="enable_stripe">

                    Enable Stripe

                </label>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Stripe Payment Link

                </label>

                <input
                    type="url"
                    class="form-control"
                    name="stripe_link"
                    placeholder="https://buy.stripe.com/..."
                    value="<?= htmlspecialchars($settings['stripe_link'] ?? '') ?>">

            </div>

            <div class="alert alert-info mb-0">

                <i class="fa-solid fa-circle-info me-2"></i>

                Paste your Stripe Payment Link.

            </div>

        </div>

    </div>

</div>
</div>

<hr class="my-4">

<div class="d-flex justify-content-between">

    <a
        href="?module=donation-manager"
        class="btn btn-secondary">

        <i class="fa-solid fa-arrow-left me-2"></i>

        Back to Dashboard

    </a>

    <button
        type="submit"
        class="btn btn-success">

        <i class="fa-solid fa-floppy-disk me-2"></i>

        Save Donation Settings

    </button>

</div>

</form>

</div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';
