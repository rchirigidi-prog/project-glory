<?php

declare(strict_types=1);

require ADMIN_INCLUDES . '/header.php';
?>

<div class="admin-wrapper">

    <?php require ADMIN_INCLUDES . '/sidebar.php'; ?>

    <div class="main-wrapper">

        <?php require ADMIN_INCLUDES . '/navbar.php'; ?>

        <main class="dashboard container-fluid py-4">

            <?= $content ?>

        </main>

    </div>

</div>

<?php require ADMIN_INCLUDES . '/footer.php'; ?>