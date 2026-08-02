<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

ob_start();

use App\Services\DonationManagerService;

$service = new DonationManagerService();

$stats = $service->stats();

$transactions = $service->transactions();

$total = (int)($stats['total'] ?? 0);

$totalAmount = (float)($stats['total_amount'] ?? 0);

$pending = (int)($stats['pending'] ?? 0);

$verified = (int)($stats['verified'] ?? 0);

$rejected = (int)($stats['rejected'] ?? 0);

$today = date('Y-m-d');

$todayTotal = 0;

$monthTotal = 0;

$yearTotal = 0;

foreach ($transactions as $transaction) {

    $date = date('Y-m-d', strtotime($transaction['created_at']));

    if ($date === $today) {

        $todayTotal += (float)$transaction['amount'];

    }

    if (date('Y-m', strtotime($transaction['created_at'])) === date('Y-m')) {

        $monthTotal += (float)$transaction['amount'];

    }

    if (date('Y', strtotime($transaction['created_at'])) === date('Y')) {

        $yearTotal += (float)$transaction['amount'];

    }

}

?>

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>

            <i class="fa-solid fa-chart-column text-primary me-2"></i>

            Donation Reports

        </h2>

        <p class="text-muted mb-0">

            Donation statistics and ministry reports.

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

                    ₹<?= number_format($totalAmount,2) ?>

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

<div class="row">

<div class="col-lg-4">

<div class="card shadow-sm border-0">

<div class="card-header bg-light">

<h5 class="mb-0">

Today's Summary

</h5>

</div>

<div class="card-body">

<h3>

₹<?= number_format($todayTotal,2) ?>

</h3>

<p class="text-muted mb-0">

Received Today

</p>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="card shadow-sm border-0">

<div class="card-header bg-light">

<h5 class="mb-0">

Monthly Summary

</h5>

</div>

<div class="card-body">

<h3>

₹<?= number_format($monthTotal,2) ?>

</h3>

<p class="text-muted mb-0">

Current Month

</p>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="card shadow-sm border-0">

<div class="card-header bg-light">

<h5 class="mb-0">

Yearly Summary

</h5>

</div>

<div class="card-body">

<h3>

₹<?= number_format($yearTotal,2) ?>

</h3>

<p class="text-muted mb-0">

Current Year

</p>

</div>

</div>

</div>

</div>

<div class="card shadow-sm border-0 mt-4">

<div class="card-header bg-light">

<h5 class="mb-0">

Recent Donations

</h5>

</div>

<div class="table-responsive">

<table class="table table-hover align-middle mb-0">

<thead>

<tr>

<th>Donor</th>

<th>Method</th>

<th>Amount</th>

<th>Status</th>

<th>Date</th>

</tr>

</thead>

<tbody>
 <?php if (empty($transactions)): ?>

<tr>

    <td colspan="5" class="text-center py-5">

        <i class="fa-solid fa-circle-info fa-2x text-muted mb-3"></i>

        <p class="mb-0 text-muted">

            No donation transactions available.

        </p>

    </td>

</tr>

<?php else: ?>

<?php foreach (array_slice($transactions, 0, 10) as $transaction): ?>

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

        <?= htmlspecialchars($transaction['currency']) ?>

        <?= number_format((float)$transaction['amount'], 2) ?>

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

</tr>

<?php endforeach; ?>

<?php endif; ?>
                </tbody>

            </table>

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-lg-6">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-light">

                    <h5 class="mb-0">

                        <i class="fa-solid fa-credit-card me-2"></i>

                        Payment Method Summary

                    </h5>

                </div>

                <div class="card-body">

                    <?php

                    $methodStats = [];

                    foreach ($transactions as $transaction) {

                        $method = strtoupper($transaction['payment_method']);

                        if (!isset($methodStats[$method])) {

                            $methodStats[$method] = 0;

                        }

                        $methodStats[$method]++;

                    }

                    ?>

                    <?php if (empty($methodStats)): ?>

                        <p class="text-muted mb-0">

                            No payment methods recorded yet.

                        </p>

                    <?php else: ?>

                        <?php foreach ($methodStats as $method => $count): ?>

                            <div class="d-flex justify-content-between align-items-center mb-2">

                                <strong><?= htmlspecialchars($method) ?></strong>

                                <span class="badge bg-primary">

                                    <?= $count ?>

                                </span>

                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-light">

                    <h5 class="mb-0">

                        <i class="fa-solid fa-chart-pie me-2"></i>

                        Verification Summary

                    </h5>

                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">

                        <span>Pending</span>

                        <span class="badge bg-warning">

                            <?= $pending ?>

                        </span>

                    </div>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Verified</span>

                        <span class="badge bg-success">

                            <?= $verified ?>

                        </span>

                    </div>

                    <div class="d-flex justify-content-between">

                        <span>Rejected</span>

                        <span class="badge bg-danger">

                            <?= $rejected ?>

                        </span>

                    </div>

                    <hr>

                    <div class="text-center">

                        <h5 class="text-success">

                            ₹<?= number_format($totalAmount, 2) ?>

                        </h5>

                        <small class="text-muted">

                            Total Donations Received

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="alert alert-info mt-4">

        <h5 class="mb-3">

            <i class="fa-solid fa-lightbulb me-2"></i>

            Ministry Insight

        </h5>

        <p class="mb-2">

            Use this report to monitor donation trends, verify incoming contributions promptly,
            and identify the most frequently used payment methods.

        </p>

        <p class="mb-0">

            Future versions will include charts, Excel export, PDF reports,
            custom date ranges, and donor analytics.

        </p>

    </div>
</div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';
       