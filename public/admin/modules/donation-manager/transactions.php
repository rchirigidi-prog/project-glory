<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

ob_start();

use App\Services\DonationManagerService;

$service = new DonationManagerService();

$transactions = $service->transactions();

$stats = $service->stats();

$total = (int)($stats['total'] ?? 0);
$totalAmount = (float)($stats['total_amount'] ?? 0);

$pending = (int)($stats['pending'] ?? 0);
$verified = (int)($stats['verified'] ?? 0);
$rejected = (int)($stats['rejected'] ?? 0);

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="fa-solid fa-money-check-dollar text-success me-2"></i>

                Donation Transactions

            </h2>

            <p class="text-muted mb-0">

                Review, verify and manage all ministry donations.

            </p>

        </div>

        <a
            href="?module=donation-manager"
            class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left me-2"></i>

            Dashboard

        </a>

    </div>

    <div class="row g-3 mb-4">

        <div class="col-lg-3">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <h6>Total Donations</h6>

                    <h2><?= $total ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <h6>Total Amount</h6>

                    <h2>

                        ₹<?= number_format($totalAmount, 2) ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-2">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <h6>Pending</h6>

                    <h2><?= $pending ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-2">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <h6>Verified</h6>

                    <h2><?= $verified ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-2">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <h6>Rejected</h6>

                    <h2><?= $rejected ?></h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="row">

                <div class="col-md-4">

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search donor...">

                </div>

                <div class="col-md-3">

                    <select class="form-select">

                        <option>All Status</option>

                        <option>Pending</option>

                        <option>Verified</option>

                        <option>Rejected</option>

                    </select>

                </div>

                <div class="col-md-3">

                    <select class="form-select">

                        <option>All Methods</option>

                        <option>UPI</option>

                        <option>Bank</option>

                        <option>Razorpay</option>

                        <option>PayPal</option>

                        <option>Stripe</option>

                    </select>

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100">

                        Search

                    </button>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm border-0 mt-4">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>ID</th>

                        <th>Donor</th>

                        <th>Method</th>

                        <th>Amount</th>

                        <th>Status</th>

                        <th>Date</th>

                        <th width="220">

                            Actions

                        </th>

                    </tr>

                </thead>

                <tbody>
<?php if (empty($transactions)): ?>

<tr>

    <td colspan="7" class="text-center py-5">

        <i class="fa-solid fa-circle-info fa-2x text-muted mb-3"></i>

        <p class="mb-0 text-muted">

            No donation transactions found.

        </p>

    </td>

</tr>

<?php else: ?>

<?php foreach ($transactions as $transaction): ?>

<?php

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

    default => 'light'

};

?>

<tr>

    <td>

        #<?= (int)$transaction['id'] ?>

    </td>

    <td>

        <strong>

            <?= htmlspecialchars($transaction['full_name']) ?>

        </strong>

        <br>

        <small class="text-muted">

            <?= htmlspecialchars($transaction['email']) ?>

        </small>

    </td>

    <td>

        <span class="badge bg-<?= $methodClass ?>">

            <?= strtoupper(htmlspecialchars($transaction['payment_method'])) ?>

        </span>

    </td>

    <td>

        ₹<?= number_format((float)$transaction['amount'], 2) ?>

    </td>

    <td>

        <span class="badge bg-<?= $statusClass ?>">

            <?= ucfirst(htmlspecialchars($transaction['status'])) ?>

        </span>

    </td>

    <td>

        <?= date(
            'd M Y',
            strtotime($transaction['created_at'])
        ) ?>

        <br>

        <small class="text-muted">

            <?= date(
                'h:i A',
                strtotime($transaction['created_at'])
            ) ?>

        </small>

    </td>

    <td>

        <a
            href="?module=donation-manager&action=view&id=<?= (int)$transaction['id'] ?>"
            class="btn btn-sm btn-primary">

            <i class="fa-solid fa-eye"></i>

        </a>

        <a
            href="?module=donation-manager&action=verify&id=<?= (int)$transaction['id'] ?>"
            class="btn btn-sm btn-success">

            <i class="fa-solid fa-check"></i>

        </a>

        <a
            href="?module=donation-manager&action=reject&id=<?= (int)$transaction['id'] ?>"
            class="btn btn-sm btn-warning">

            <i class="fa-solid fa-xmark"></i>

        </a>

        <a
            href="?module=donation-manager&action=delete&id=<?= (int)$transaction['id'] ?>"
            class="btn btn-sm btn-danger"
            onclick="return confirm('Delete this donation transaction?');">

            <i class="fa-solid fa-trash"></i>

        </a>

    </td>

</tr>

<?php endforeach; ?>

<?php endif; ?>
                 </tbody>

            </table>

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-light">

                    <h5 class="mb-0">

                        <i class="fa-solid fa-chart-line me-2"></i>

                        Donation Summary

                    </h5>

                </div>

                <div class="card-body">

                    <div class="row text-center">

                        <div class="col-md-3">

                            <h3 class="text-primary">

                                <?= $total ?>

                            </h3>

                            <small class="text-muted">

                                Total Donations

                            </small>

                        </div>

                        <div class="col-md-3">

                            <h3 class="text-warning">

                                <?= $pending ?>

                            </h3>

                            <small class="text-muted">

                                Pending

                            </small>

                        </div>

                        <div class="col-md-3">

                            <h3 class="text-success">

                                <?= $verified ?>

                            </h3>

                            <small class="text-muted">

                                Verified

                            </small>

                        </div>

                        <div class="col-md-3">

                            <h3 class="text-danger">

                                <?= $rejected ?>

                            </h3>

                            <small class="text-muted">

                                Rejected

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-light">

                    <h5 class="mb-0">

                        <i class="fa-solid fa-circle-info me-2"></i>

                        Verification Guide

                    </h5>

                </div>

                <div class="card-body">

                    <ul class="mb-0">

                        <li class="mb-2">

                            Verify the payment reference.

                        </li>

                        <li class="mb-2">

                            Confirm the payment amount.

                        </li>

                        <li class="mb-2">

                            Check the uploaded screenshot if available.

                        </li>

                        <li class="mb-2">

                            Mark the donation as <strong>Verified</strong> only after confirmation.

                        </li>

                        <li>

                            Reject suspicious or invalid payments.

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>
 </div>

</div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';                      