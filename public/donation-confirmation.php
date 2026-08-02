<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

ob_start();

use App\Services\DonationManagerService;
use App\Services\UploadService;

$service = new DonationManagerService();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $paymentScreenshot = '';

if (
    isset($_FILES['payment_screenshot']) &&
    $_FILES['payment_screenshot']['error'] !== UPLOAD_ERR_NO_FILE
) {

    $uploadService = new UploadService();

    $upload = $uploadService->upload(

        $_FILES['payment_screenshot'],

        'donations'

    );

    if (!empty($upload['success'])) {

        $paymentScreenshot = $upload['data']['path'];

    } else {

        $message = 'error';

    }
}
    $data = [

        'support_request_id' =>
            !empty($_POST['support_request_id'])
                ? (int)$_POST['support_request_id']
                : null,

        'full_name' =>
            trim($_POST['full_name'] ?? ''),

        'email' =>
            trim($_POST['email'] ?? ''),

        'phone' =>
            trim($_POST['phone'] ?? ''),

        'country' =>
            trim($_POST['country'] ?? ''),

        'payment_method' =>
            trim($_POST['payment_method'] ?? ''),

        'amount' =>
            (float)($_POST['amount'] ?? 0),

        'currency' =>
            trim($_POST['currency'] ?? 'INR'),

        'transaction_reference' =>
            trim($_POST['transaction_reference'] ?? ''),

        'payment_screenshot' => $paymentScreenshot,

        'donor_message' =>
            trim($_POST['donor_message'] ?? '')

    ];

    if ($service->createTransaction($data)) {

        $message = 'success';

    } else {

        $message = 'error';

    }

}

require_once __DIR__ . '/includes/header.php';

?>

<section class="section-padding">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow border-0">

<div class="card-body p-5">

<div class="text-center mb-5">

<i class="fa-solid fa-circle-check fa-4x text-success mb-4"></i>

<h2>

Donation Confirmation

</h2>

<p class="text-muted">

Complete this form after you have made your donation.

</p>

</div>

<?php if ($message === 'success'): ?>

<div class="alert alert-success">

<i class="fa-solid fa-circle-check me-2"></i>

Thank you!

Your donation information has been submitted successfully.
Our ministry team will verify your donation shortly.

</div>

<?php elseif ($message === 'error'): ?>

<div class="alert alert-danger">

Unable to submit your donation.
Please try again.

</div>

<?php endif; ?>

<form
    method="post"
    enctype="multipart/form-data">

<input
    type="hidden"
    name="support_request_id"
    value="<?= htmlspecialchars($_GET['request'] ?? '') ?>">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Full Name

</label>

<input
    type="text"
    name="full_name"
    class="form-control"
    required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Email Address

</label>

<input
    type="email"
    name="email"
    class="form-control"
    required>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Phone Number

</label>

<input
    type="text"
    name="phone"
    class="form-control">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Country

</label>

<input
    type="text"
    name="country"
    class="form-control">

</div>

</div>
<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">

            Payment Method

        </label>

        <select
            name="payment_method"
            class="form-select"
            required>

            <option value="">

                Select Payment Method

            </option>

            <option value="upi">

                UPI

            </option>

            <option value="bank">

                Bank Transfer

            </option>

            <option value="razorpay">

                Razorpay

            </option>

            <option value="paypal">

                PayPal

            </option>

            <option value="stripe">

                Stripe

            </option>

        </select>

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">

            Donation Amount

        </label>

        <div class="input-group">

            <span class="input-group-text">

                ₹

            </span>

            <input
                type="number"
                name="amount"
                class="form-control"
                min="1"
                step="0.01"
                required>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Currency

        </label>

        <select
            name="currency"
            class="form-select">

            <option value="INR" selected>

                INR

            </option>

            <option value="USD">

                USD

            </option>

            <option value="EUR">

                EUR

            </option>

            <option value="GBP">

                GBP

            </option>

        </select>

    </div>

    <div class="col-md-8 mb-3">

        <label class="form-label">

            Transaction Reference

        </label>

        <input
            type="text"
            name="transaction_reference"
            class="form-control"
            placeholder="Enter UPI / Bank / Razorpay Reference"
            required>

        <div class="form-text">

            Enter the payment reference or transaction ID provided by your payment method.

        </div>

    </div>

</div>
<div class="mb-4">

    <label class="form-label">

        Payment Screenshot (Optional)

    </label>

    <input
        type="file"
        name="payment_screenshot"
        class="form-control"
        accept=".jpg,.jpeg,.png,.webp">

    <div class="form-text">

        Upload a screenshot of your payment confirmation to help us verify your donation faster.

    </div>

</div>

<div class="mb-4">

    <label class="form-label">

        Message (Optional)

    </label>

    <textarea
        name="donor_message"
        class="form-control"
        rows="5"
        placeholder="Write a message for our ministry..."></textarea>

</div>

<div class="alert alert-info">

    <h5 class="mb-3">

        <i class="fa-solid fa-circle-info me-2"></i>

        Before You Submit

    </h5>

    <ul class="mb-0">

        <li>

            Make sure your donation has already been completed.

        </li>

        <li>

            Enter the correct payment reference or transaction ID.

        </li>

        <li>

            Upload a payment screenshot if available.

        </li>

        <li>

            Your donation will be verified by our ministry team.

        </li>

        <li>

            We sincerely thank you for supporting God's ministry.

        </li>

    </ul>

</div>
<div class="d-flex justify-content-between mt-4">

    <a
        href="/donation-methods.php"
        class="btn btn-outline-secondary">

        <i class="fa-solid fa-arrow-left me-2"></i>

        Back to Donation Methods

    </a>

    <button
        type="submit"
        class="btn btn-success">

        <i class="fa-solid fa-paper-plane me-2"></i>

        Submit Donation Confirmation

    </button>

</div>

</form>

<hr class="my-5">

<div class="text-center">

    <i class="fa-solid fa-heart fa-3x text-danger mb-3"></i>

    <h4>

        Thank You for Supporting Our Ministry

    </h4>

    <p class="text-muted mb-0">

        Your generosity helps us share the Gospel through worship music,
        online radio, Bible teaching, videos, and digital outreach.
        Every contribution is prayed over and greatly appreciated.

    </p>

</div>

</div>

</div>

</div>

</div>

</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>