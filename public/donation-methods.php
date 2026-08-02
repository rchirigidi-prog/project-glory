<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

use App\Services\DonationManagerService;

$service = new DonationManagerService();

$settings = $service->settings();

$pageTitle = $settings['donation_title'] ?? 'Support Our Ministry';

require_once __DIR__ . '/includes/header.php';

?>

<section class="section-padding">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-10">

<div class="card shadow border-0">

<div class="card-body p-5">

<div class="text-center mb-5">

<i class="fa-solid fa-hand-holding-heart fa-4x text-danger mb-4"></i>

<h2>

<?= htmlspecialchars($pageTitle) ?>

</h2>

<p class="lead text-muted">

<?= nl2br(htmlspecialchars($settings['donation_description'] ?? '')) ?>

</p>

</div>

<?php if (!empty($settings['thank_you_message'])): ?>

<div class="alert alert-success">

<i class="fa-solid fa-circle-check me-2"></i>

<?= nl2br(htmlspecialchars($settings['thank_you_message'])) ?>

</div>

<?php endif; ?>

<div class="row g-4">
<?php if (!empty($settings['enable_upi'])): ?>

<div class="col-lg-6">

    <div class="card shadow-sm border-primary h-100">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">

                <i class="fa-solid fa-qrcode me-2"></i>

                UPI Payment

            </h4>

        </div>

        <div class="card-body text-center">

            <?php if (!empty($settings['upi_qr_image'])): ?>

                <img
                    src="/<?= htmlspecialchars($settings['upi_qr_image']) ?>"
                    class="img-fluid rounded mb-4"
                    style="max-width:250px;"
                    alt="UPI QR Code">

            <?php endif; ?>

            <h5>

                <?= htmlspecialchars($settings['upi_name'] ?? '') ?>

            </h5>

            <div class="alert alert-light border">

                <strong>

                    <?= htmlspecialchars($settings['upi_id'] ?? '') ?>

                </strong>

            </div>

            <p class="text-muted mb-0">

                Scan the QR Code or use the UPI ID above to complete your donation.

            </p>

        </div>

    </div>

</div>

<?php endif; ?>

<?php if (!empty($settings['enable_bank'])): ?>

<div class="col-lg-6">

    <div class="card shadow-sm border-success h-100">

        <div class="card-header bg-success text-white">

            <h4 class="mb-0">

                <i class="fa-solid fa-building-columns me-2"></i>

                Bank Transfer

            </h4>

        </div>

        <div class="card-body">

            <table class="table table-borderless mb-0">

                <tr>

                    <th width="160">

                        Bank

                    </th>

                    <td>

                        <?= htmlspecialchars($settings['bank_name'] ?? '') ?>

                    </td>

                </tr>

                <tr>

                    <th>

                        Account Name

                    </th>

                    <td>

                        <?= htmlspecialchars($settings['account_name'] ?? '') ?>

                    </td>

                </tr>

                <tr>

                    <th>

                        Account No.

                    </th>

                    <td>

                        <?= htmlspecialchars($settings['account_number'] ?? '') ?>

                    </td>

                </tr>

                <tr>

                    <th>

                        IFSC

                    </th>

                    <td>

                        <?= htmlspecialchars($settings['ifsc_code'] ?? '') ?>

                    </td>

                </tr>

                <?php if (!empty($settings['branch_name'])): ?>

                <tr>

                    <th>

                        Branch

                    </th>

                    <td>

                        <?= htmlspecialchars($settings['branch_name']) ?>

                    </td>

                </tr>

                <?php endif; ?>

                <?php if (!empty($settings['swift_code'])): ?>

                <tr>

                    <th>

                        SWIFT

                    </th>

                    <td>

                        <?= htmlspecialchars($settings['swift_code']) ?>

                    </td>

                </tr>

                <?php endif; ?>

            </table>

        </div>

    </div>

</div>

<?php endif; ?>
 <?php if (!empty($settings['enable_razorpay'])): ?>

<div class="col-lg-4">

    <div class="card shadow-sm border-warning h-100">

        <div class="card-header bg-warning">

            <h4 class="mb-0">

                <i class="fa-solid fa-credit-card me-2"></i>

                Razorpay

            </h4>

        </div>

        <div class="card-body text-center">

            <p class="mb-4">

                Donate securely using Razorpay.

            </p>

            <a
                href="<?= htmlspecialchars($settings['razorpay_link']) ?>"
                target="_blank"
                class="btn btn-warning">

                <i class="fa-solid fa-arrow-up-right-from-square me-2"></i>

                Donate via Razorpay

            </a>

        </div>

    </div>

</div>

<?php endif; ?>

<?php if (!empty($settings['enable_paypal'])): ?>

<div class="col-lg-4">

    <div class="card shadow-sm border-dark h-100">

        <div class="card-header bg-dark text-white">

            <h4 class="mb-0">

                <i class="fa-brands fa-paypal me-2"></i>

                PayPal

            </h4>

        </div>

        <div class="card-body text-center">

            <p class="mb-4">

                Donate securely using PayPal.

            </p>

            <a
                href="<?= htmlspecialchars($settings['paypal_link']) ?>"
                target="_blank"
                class="btn btn-dark">

                <i class="fa-solid fa-arrow-up-right-from-square me-2"></i>

                Donate via PayPal

            </a>

        </div>

    </div>

</div>

<?php endif; ?>

<?php if (!empty($settings['enable_stripe'])): ?>

<div class="col-lg-4">

    <div class="card shadow-sm border-secondary h-100">

        <div class="card-header bg-secondary text-white">

            <h4 class="mb-0">

                <i class="fa-solid fa-credit-card me-2"></i>

                Stripe

            </h4>

        </div>

        <div class="card-body text-center">

            <p class="mb-4">

                Donate securely using Stripe.

            </p>

            <a
                href="<?= htmlspecialchars($settings['stripe_link']) ?>"
                target="_blank"
                class="btn btn-secondary">

                <i class="fa-solid fa-arrow-up-right-from-square me-2"></i>

                Donate via Stripe

            </a>

        </div>

    </div>

</div>

<?php endif; ?>
 </div>

<hr class="my-5">

<div class="alert alert-info">

    <h5>

        <i class="fa-solid fa-circle-info me-2"></i>

        Important

    </h5>

    <p class="mb-2">

        After completing your donation, please keep your payment reference
        or transaction ID for your records.

    </p>

    <p class="mb-0">

        You can submit your transaction reference on the next page so our
        ministry team can verify your donation and acknowledge your support.

    </p>

</div>

<div class="d-flex justify-content-between flex-wrap gap-3 mt-4">

    <a
        href="/support"
        class="btn btn-outline-secondary">

        <i class="fa-solid fa-arrow-left me-2"></i>

        Back to Support Ministry

    </a>

    <a
        href="/donation-confirmation.php"
        class="btn btn-success">

        <i class="fa-solid fa-circle-check me-2"></i>

        I've Completed My Donation

    </a>

</div>

</div>

</div>

</div>

</div>

</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
  