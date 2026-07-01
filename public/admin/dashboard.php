<?php

require_once __DIR__ . '/bootstrap.php';

use App\Controllers\DashboardController;

$data = (new DashboardController())->index();

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/sidebar.php';

?>

<div class="main-wrapper">

<?php require_once __DIR__ . '/includes/navbar.php'; ?>

<div class="dashboard">

<h2 class="mb-4">
    Welcome Back 👋
</h2>

<div class="row g-4">

    <div class="col-lg-3">
        <div class="stat-card">
            <h5>Users</h5>
            <h2><?= $data['users']; ?></h2>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="stat-card">
            <h5>Artists</h5>
            <h2><?= $data['artists']; ?></h2>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="stat-card">
            <h5>Albums</h5>
            <h2><?= $data['albums']; ?></h2>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="stat-card">
            <h5>Songs</h5>
            <h2><?= $data['songs']; ?></h2>
        </div>
    </div>

</div>

<div class="row mt-4">

    <div class="col-lg-6">

        <div class="section-card">

            <h4>📻 Radio Status</h4>

            <h2 class="text-success">
                <?= $data['radio']; ?>
            </h2>

        </div>

    </div>

    <div class="col-lg-6">

        <div class="section-card">

            <h4>Recent Activity</h4>

            <ul class="list-group">

                <li class="list-group-item">
                    ✅ Dashboard initialized successfully.
                </li>

                <li class="list-group-item">
                    👤 Users Module is operational.
                </li>

            </ul>

        </div>

    </div>

</div>

</div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>