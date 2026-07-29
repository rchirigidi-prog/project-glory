<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\SupporterController;
use App\Core\Flash;

$controller = new SupporterController();

$supporter = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $supporter = $_POST;

    if ($controller->store($_POST)) {

        header('Location: dashboard.php?module=supporters');
        exit;
    }
}

$pageTitle = 'Create Supporter';
$pageIcon = 'fa-solid fa-hand-holding-heart';
$backUrl = 'index.php';
$backLabel = 'Back to Supporters';

$submitLabel = 'Save Supporter';
$cancelUrl = 'index.php';

require_once ADMIN_INCLUDES . '/header.php';
require_once ADMIN_INCLUDES . '/sidebar.php';
?>

<div class="main-wrapper">

<?php require_once __DIR__ . '/../../includes/navbar.php'; ?>

<div class="dashboard">

<?php

require ADMIN_LAYOUTS . '/admin-form.php';

if ($message = Flash::get('error')) {

    $alertType = 'danger';
    $alertMessage = $message;

    require ADMIN_COMPONENTS . '/alert.php';
}

?>

<form method="POST">

<?php require __DIR__ . '/partials/form.php'; ?>

</form>

<?php require ADMIN_LAYOUTS . '/admin-form-end.php'; ?>

</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>