<?php

require_once __DIR__ . '/../../bootstrap.php';

ob_start();
?>

<h2 class="mb-4">
    <i class="fa-solid fa-globe"></i>
    Website Manager
</h2>

<div class="row g-4">

    <!-- General Settings -->

    <div class="col-lg-3">

        <a href="general.php" class="text-decoration-none">

            <div class="card shadow h-100">

                <div class="card-body text-center">

                    <i class="fa-solid fa-globe fa-3x text-primary mb-3"></i>

                    <h4>General Settings</h4>

                    <p class="text-muted">
                        Site Name, Contact, Footer
                    </p>

                </div>

            </div>

        </a>

    </div>

    <!-- Homepage -->

    <div class="col-lg-3">

        <a href="homepage.php" class="text-decoration-none">

            <div class="card shadow h-100">

                <div class="card-body text-center">

                    <i class="fa-solid fa-house fa-3x text-success mb-3"></i>

                    <h4>Homepage</h4>

                    <p class="text-muted">
                        Hero Section & Homepage
                    </p>

                </div>

            </div>

        </a>

    </div>

    <!-- Social Media -->

    <div class="col-lg-3">

        <a href="../social/index.php" class="text-decoration-none">

            <div class="card shadow h-100">

                <div class="card-body text-center">

                    <i class="fa-solid fa-share-nodes fa-3x text-danger mb-3"></i>

                    <h4>Social Media</h4>

                    <p class="text-muted">
                        YouTube, Facebook, Instagram
                    </p>

                </div>

            </div>

        </a>

    </div>

    <!-- Support Ministry -->

    <div class="col-lg-3">

        <a href="../support/index.php" class="text-decoration-none">

            <div class="card shadow h-100">

                <div class="card-body text-center">

                    <i class="fa-solid fa-hand-holding-heart fa-3x text-warning mb-3"></i>

                    <h4>Support Ministry</h4>

                    <p class="text-muted">
                        Prayer, Donate, Volunteer & Sponsor
                    </p>

                </div>

            </div>

        </a>

    </div>

</div>

<?php

$content = ob_get_clean();

require ADMIN_LAYOUTS . '/app.php';