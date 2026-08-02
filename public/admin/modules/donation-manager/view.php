<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

ob_start();

use App\Controllers\DonationManagerController;

$id = (int)($_GET['id'] ?? 0);

$controller = new DonationManagerController();

$transaction = $controller->transaction($id);

if (!$transaction) {
?>

<div class="container-fluid">

    <div class="alert alert-danger mt-4">

        <i class="fa-solid fa-circle-exclamation me-2"></i>

        Donation transaction not found.

    </div>

</div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';

return;

}

$statusClass = match ($transaction['status']) {

    'pending' => 'warning',

    'verified' => 'success',

    'rejected' => 'danger',

    default => 'secondary'

};

$methodClass = match ($transaction['payment_method']) {

    'upi' => 'primary',

    'bank' => 'info',

    'razorpay' => 'success',

    'paypal' => 'dark',

    'stripe' => 'secondary',

    default => 'secondary'

};

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="fa-solid fa-money-check-dollar text-success me-2"></i>

                Donation Transaction #<?= (int)$transaction['id']; ?>

            </h2>

            <p class="text-muted mb-0">

                Submitted on

                <?= date('d M Y h:i A', strtotime($transaction['created_at'])); ?>

            </p>

        </div>

        <div>

            <span class="badge bg-<?= $statusClass ?> fs-6 me-2">

                <?= ucfirst($transaction['status']) ?>

            </span>

            <a
                href="?module=donation-manager&action=transactions"
                class="btn btn-secondary">

                <i class="fa-solid fa-arrow-left me-2"></i>

                Back

            </a>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-4 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-light">

                    <h5 class="mb-0">

                        <i class="fa-solid fa-user me-2"></i>

                        Donor Information

                    </h5>

                </div>

                <div class="card-body">

                    <p>

                        <strong>Name</strong><br>

                        <?= htmlspecialchars($transaction['full_name']) ?>

                    </p>

                    <p>

                        <strong>Email</strong><br>

                        <a href="mailto:<?= htmlspecialchars($transaction['email']) ?>">

                            <?= htmlspecialchars($transaction['email']) ?>

                        </a>

                    </p>

                    <p>

                        <strong>Phone</strong><br>

                        <?= htmlspecialchars($transaction['phone']) ?>

                    </p>

                    <p class="mb-0">

                        <strong>Country</strong><br>

                        <?= htmlspecialchars($transaction['country']) ?>

                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-8 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-light">

                    <h5 class="mb-0">

                        <i class="fa-solid fa-receipt me-2"></i>

                        Donation Details

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-borderless mb-0">

                        <tr>

                            <th width="220">

                                Payment Method

                            </th>

                            <td>

                                <span class="badge bg-<?= $methodClass ?>">

                                    <?= strtoupper(htmlspecialchars($transaction['payment_method'])) ?>

                                </span>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Amount

                            </th>

                            <td>

                                <?= htmlspecialchars($transaction['currency']) ?>

                                <?= number_format((float)$transaction['amount'], 2) ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Transaction Reference

                            </th>

                            <td>

                                <?= htmlspecialchars($transaction['transaction_reference']) ?>

                            </td>

                        </tr>
                        <tr>

                            <th>

                                Donor Message

                            </th>

                            <td>

                                <?php if (!empty($transaction['donor_message'])): ?>

                                    <?= nl2br(htmlspecialchars($transaction['donor_message'])) ?>

                                <?php else: ?>

                                    <span class="text-muted">

                                        No message provided.

                                    </span>

                                <?php endif; ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Current Status

                            </th>

                            <td>

                                <span class="badge bg-<?= $statusClass ?>">

                                    <?= ucfirst(htmlspecialchars($transaction['status'])) ?>

                                </span>

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-6 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-light">

                    <h5 class="mb-0">

                        <i class="fa-solid fa-image me-2"></i>

                        Payment Screenshot

                    </h5>

                </div>

                <div class="card-body text-center">

                    <?php if (!empty($transaction['payment_screenshot'])): ?>

                        <img
                            src="/<?= htmlspecialchars($transaction['payment_screenshot']) ?>"
                            class="img-fluid rounded border"
                            style="max-height:500px;">

                    <?php else: ?>

                        <div class="py-5 text-muted">

                            <i class="fa-solid fa-image fa-3x mb-3"></i>

                            <p class="mb-0">

                                No payment screenshot uploaded.

                            </p>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-light">

                    <h5 class="mb-0">

                        <i class="fa-solid fa-user-shield me-2"></i>

                        Verification

                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Verified By

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            readonly
                            value="<?= $transaction['verified_by'] ?: 'Not Verified'; ?>">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Verified At

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            readonly
                            value="<?= $transaction['verified_at'] ?: 'Not Verified'; ?>">

                    </div>

                    <div class="mb-0">

                        <label class="form-label">

                            Admin Remarks

                        </label>

                        <textarea
                            class="form-control"
                            rows="5"
                            readonly><?= htmlspecialchars($transaction['remarks'] ?? '') ?></textarea>

                    </div>

                </div>

            </div>

        </div>

    </div> 
    <div class="row">

    <div class="col-lg-8">

        <div class="alert alert-info border-0 shadow-sm">

            <h5 class="mb-3">

                <i class="fa-solid fa-circle-info me-2"></i>

                Ministry Verification Checklist

            </h5>

            <ul class="mb-0">

                <li>
                    Verify the transaction reference with your payment provider.
                </li>

                <li>
                    Confirm the donation amount matches the received payment.
                </li>

                <li>
                    Review the uploaded payment screenshot, if available.
                </li>

                <li>
                    Contact the donor if additional clarification is required.
                </li>

                <li>
                    Verify only after the donation has been successfully received.
                </li>

            </ul>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-light">

                <h5 class="mb-0">

                    <i class="fa-solid fa-bolt me-2"></i>

                    Quick Actions

                </h5>

            </div>

            <div class="card-body d-grid gap-2">

                <?php if ($transaction['status'] !== 'verified'): ?>

                    <a
                        href="?module=donation-manager&action=verify&id=<?= (int)$transaction['id']; ?>"
                        class="btn btn-success">

                        <i class="fa-solid fa-circle-check me-2"></i>

                        Verify Donation

                    </a>

                <?php endif; ?>

                <?php if ($transaction['status'] !== 'rejected'): ?>

                    <a
                        href="?module=donation-manager&action=reject&id=<?= (int)$transaction['id']; ?>"
                        class="btn btn-warning">

                        <i class="fa-solid fa-circle-xmark me-2"></i>

                        Reject Donation

                    </a>

                <?php endif; ?>

                <a
                    href="?module=donation-manager&action=delete&id=<?= (int)$transaction['id']; ?>"
                    class="btn btn-danger"
                    onclick="return confirm('Are you sure you want to delete this donation transaction?');">

                    <i class="fa-solid fa-trash me-2"></i>

                    Delete Donation

                </a>

                <a
                    href="?module=donation-manager&action=transactions"
                    class="btn btn-secondary">

                    <i class="fa-solid fa-arrow-left me-2"></i>

                    Back to Transactions

                </a>

            </div>

        </div>

    </div>

</div>
 </div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';                      