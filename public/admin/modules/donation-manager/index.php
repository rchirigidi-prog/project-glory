<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

ob_start();

use App\Services\DonationManagerService;

$service = new DonationManagerService();

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

                <i class="fa-solid fa-hand-holding-heart text-success me-2"></i>

                Donation Manager

            </h2>

            <p class="text-muted mb-0">

                Manage ministry donations and payment verification.

            </p>

        </div>

    </div>

    <div class="row g-3 mb-4">

        <div class="col-lg-3">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <i class="fa-solid fa-wallet fa-2x text-success mb-3"></i>

                    <h6>Total Donations</h6>

                    <h2><?= $total ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <i class="fa-solid fa-indian-rupee-sign fa-2x text-primary mb-3"></i>

                    <h6>Total Amount</h6>

                    <h2>₹<?= number_format($totalAmount, 2) ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-2">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <i class="fa-solid fa-clock fa-2x text-warning mb-3"></i>

                    <h6>Pending</h6>

                    <h2><?= $pending ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-2">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <i class="fa-solid fa-circle-check fa-2x text-success mb-3"></i>

                    <h6>Verified</h6>

                    <h2><?= $verified ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-2">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <i class="fa-solid fa-circle-xmark fa-2x text-danger mb-3"></i>

                    <h6>Rejected</h6>

                    <h2><?= $rejected ?></h2>

                </div>

            </div>

        </div>

    </div>

    <div class="row g-4">

        <div class="col-lg-4">

            <a
                href="?module=donation-manager&action=settings"
                class="text-decoration-none">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body text-center">

                        <i class="fa-solid fa-gear fa-3x text-primary mb-3"></i>

                        <h4>Donation Settings</h4>

                        <p class="text-muted">

                            Configure UPI, Bank, Razorpay and other payment methods.

                        </p>

                    </div>

                </div>

            </a>

        </div>

        <div class="col-lg-4">

            <a
                href="?module=donation-manager&action=transactions"
                class="text-decoration-none">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body text-center">

                        <i class="fa-solid fa-money-check-dollar fa-3x text-success mb-3"></i>

                        <h4>Transactions</h4>

                        <p class="text-muted">

                            Review and verify all donation transactions.

                        </p>

                    </div>

                </div>

            </a>

        </div>

        <div class="col-lg-4">

            <a
                href="?module=donation-manager&action=reports"
                class="text-decoration-none">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body text-center">

                        <i class="fa-solid fa-chart-column fa-3x text-warning mb-3"></i>

                        <h4>Reports</h4>

                        <p class="text-muted">

                            View donation summaries and ministry reports.

                        </p>

                    </div>

                </div>

            </a>

        </div>

    </div>

</div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';