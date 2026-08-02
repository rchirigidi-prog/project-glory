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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $status = $_POST['status'] ?? 'pending';

    $remarks = trim($_POST['remarks'] ?? '');

    /*
    |--------------------------------------------------------------------------
    | TODO
    |--------------------------------------------------------------------------
    | Replace with your logged-in administrator ID.
    | Later we'll connect this with the Authentication module.
    */

    $verifiedBy = 1;

    if ($status === 'verified') {

        $controller->verify(
            $id,
            $verifiedBy,
            $remarks
        );

    } elseif ($status === 'rejected') {

        $controller->reject(
            $id,
            $verifiedBy,
            $remarks
        );

    }

    header(
        'Location: ?module=donation-manager&action=view&id=' . $id
    );

    exit;

}

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="fa-solid fa-circle-check text-success me-2"></i>

                Verify Donation

            </h2>

            <p class="text-muted mb-0">

                Donation #<?= (int)$transaction['id']; ?>

            </p>

        </div>

        <a
            href="?module=donation-manager&action=view&id=<?= (int)$transaction['id']; ?>"
            class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left me-2"></i>

            Back

        </a>

    </div>

    <form method="post">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-light">

                <h5 class="mb-0">

                    Verification Details

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Donor

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            readonly
                            value="<?= htmlspecialchars($transaction['full_name']) ?>">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Amount

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            readonly
                            value="<?= htmlspecialchars($transaction['currency']) . ' ' . number_format((float)$transaction['amount'], 2) ?>">

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Transaction Reference

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        readonly
                        value="<?= htmlspecialchars($transaction['transaction_reference']) ?>">

                </div>
                 <div class="mb-3">

                    <label class="form-label">

                        Verification Status

                    </label>

                    <select
                        name="status"
                        class="form-select"
                        required>

                        <option
                            value="verified"
                            <?= $transaction['status'] === 'verified' ? 'selected' : '' ?>>

                            Verified

                        </option>

                        <option
                            value="rejected"
                            <?= $transaction['status'] === 'rejected' ? 'selected' : '' ?>>

                            Rejected

                        </option>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="form-label">

                        Verification Remarks

                    </label>

                    <textarea
                        name="remarks"
                        class="form-control"
                        rows="6"
                        placeholder="Add internal verification notes..."><?= htmlspecialchars($transaction['remarks'] ?? '') ?></textarea>

                    <div class="form-text">

                        These remarks are for internal ministry records only.

                    </div>

                </div>

                <div class="alert alert-info">

                    <h6 class="mb-3">

                        <i class="fa-solid fa-circle-info me-2"></i>

                        Verification Checklist

                    </h6>

                    <ul class="mb-0">

                        <li>Verify the payment reference.</li>

                        <li>Confirm the payment amount.</li>

                        <li>Check the payment screenshot if available.</li>

                        <li>Ensure the payment has been received.</li>

                        <li>Record any important internal notes.</li>

                    </ul>

                </div>

            </div>

            <div class="card-footer d-flex justify-content-between">

                <a
                    href="?module=donation-manager&action=view&id=<?= (int)$transaction['id']; ?>"
                    class="btn btn-secondary">

                    <i class="fa-solid fa-arrow-left me-2"></i>

                    Cancel

                </a>

                <button
                    type="submit"
                    class="btn btn-success">

                    <i class="fa-solid fa-floppy-disk me-2"></i>

                    Save Verification

                </button>

            </div>

        </div>

    </form>
 </div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';
                  