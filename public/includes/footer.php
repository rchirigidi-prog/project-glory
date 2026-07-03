<?php

$footerSiteName = setting(
    'site_name',
    'SingThyGlory'
);

$footerTagline = setting(
    'site_tagline',
    'Glorifying Jesus Through Every Song'
);

$footerText = setting(
    'footer_text',
    '© ' . date('Y') . ' SingThyGlory. All Rights Reserved.'
);

$youtubeUrl = setting('youtube_url');
$facebookUrl = setting('facebook_url');
$instagramUrl = setting('instagram_url');

?>

<footer class="footer">

    <div class="container text-center">

        <img
            src="/assets/images/logo/logo.png"
            width="70"
            alt="<?= htmlspecialchars($footerSiteName, ENT_QUOTES, 'UTF-8') ?>">

        <h3 class="mt-3">
            <?= htmlspecialchars($footerSiteName, ENT_QUOTES, 'UTF-8') ?>
        </h3>

        <p>
            <?= htmlspecialchars($footerTagline, ENT_QUOTES, 'UTF-8') ?>
        </p>

        <?php if (
            $youtubeUrl !== '' ||
            $facebookUrl !== '' ||
            $instagramUrl !== ''
        ): ?>

            <div class="footer-social-links my-4">

                <?php if ($youtubeUrl !== ''): ?>

                    <a
                        href="<?= htmlspecialchars($youtubeUrl, ENT_QUOTES, 'UTF-8') ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mx-2"
                        aria-label="YouTube">

                        <i class="bi bi-youtube fs-3"></i>

                    </a>

                <?php endif; ?>

                <?php if ($facebookUrl !== ''): ?>

                    <a
                        href="<?= htmlspecialchars($facebookUrl, ENT_QUOTES, 'UTF-8') ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mx-2"
                        aria-label="Facebook">

                        <i class="bi bi-facebook fs-3"></i>

                    </a>

                <?php endif; ?>

                <?php if ($instagramUrl !== ''): ?>

                    <a
                        href="<?= htmlspecialchars($instagramUrl, ENT_QUOTES, 'UTF-8') ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mx-2"
                        aria-label="Instagram">

                        <i class="bi bi-instagram fs-3"></i>

                    </a>

                <?php endif; ?>

            </div>

        <?php endif; ?>

        <hr>

        <small>
            <?= htmlspecialchars($footerText, ENT_QUOTES, 'UTF-8') ?>
        </small>

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
