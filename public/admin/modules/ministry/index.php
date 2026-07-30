<?php

require_once __DIR__ . '/../../bootstrap.php';

ob_start();
?>

<h2 class="mb-4">
    <i class="fa-solid fa-hand-holding-heart"></i>
    Ministry
</h2>

<div class="row g-4">

    <!-- Support the Ministry -->

    <div class="col-lg-4">

        <a href="support-ministry.php" class="text-decoration-none">

            <div class="card shadow h-100">

                <div class="card-body text-center">

                    <i class="fa-solid fa-hand-holding-heart fa-3x text-danger mb-3"></i>

                    <h4>Support the Ministry</h4>

                    <p class="text-muted">
                        Prayer, Donate, Volunteer & Sponsor
                    </p>

                </div>

            </div>

        </a>

    </div>

    <!-- Ministry Partners -->

    <div class="col-lg-4">

        <a href="../supporters/index.php" class="text-decoration-none">

            <div class="card shadow h-100">

                <div class="card-body text-center">

                    <i class="fa-solid fa-users fa-3x text-primary mb-3"></i>

                    <h4>Ministry Partners</h4>

                    <p class="text-muted">
                        Manage ministry partners and supporters
                    </p>

                </div>

            </div>

        </a>

    </div>

    <!-- Prayer Requests (Coming Soon) -->

    <div class="col-lg-4">

        <div class="card shadow h-100">

            <div class="card-body text-center">

                <i class="fa-solid fa-hands-praying fa-3x text-success mb-3"></i>

                <h4>Prayer Requests</h4>

                <p class="text-muted">
                    Coming Soon
                </p>

            </div>

        </div>

    </div>

</div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';