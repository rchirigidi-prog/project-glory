<?php

require_once __DIR__ . '/../../bootstrap.php';

use App\Controllers\SupporterController;
use App\Core\Flash;
use App\Core\ModuleLoader;

$controller = new SupporterController();
$loader = new ModuleLoader();

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id) {
    Flash::set(
        'error',
        'Invalid supporter ID.'
    );

    header('Location: ' . $loader->url('supporters'));
    exit;
}

$supporter = $controller->show($id);

if (!$supporter) {
    Flash::set(
        'error',
        'Supporter was not found.'
    );

    header('Location: ' . $loader->url('supporters'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($controller->update($id, $_POST)) {

        header('Location: ' . $loader->url('supporters'));
        exit;
    }

    $supporter = array_merge(
        $supporter,
        $_POST
    );
}

$pageTitle = 'Edit Supporter';
$pageIcon = 'fa-solid fa-pen-to-square';
$backUrl = $loader->url('supporters');
$backLabel = 'Back to Supporters';

$submitLabel = 'Update Supporter';
$cancelUrl = $loader->url('supporters');

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