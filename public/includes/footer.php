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

    <div class="container">

        <div class="row justify-content-center text-center">

            <div class="col-lg-8">

                <img
                    src="/assets/images/logo/logo.png"
                    class="footer-logo"
                    alt="<?= htmlspecialchars($footerSiteName, ENT_QUOTES, 'UTF-8') ?>"
                    loading="lazy">

                <h3 class="footer-title">

                    <?= htmlspecialchars($footerSiteName, ENT_QUOTES, 'UTF-8') ?>

                </h3>

                <p class="footer-tagline">

                    <?= htmlspecialchars($footerTagline, ENT_QUOTES, 'UTF-8') ?>

                </p>

                <?php if (
                    $youtubeUrl !== '' ||
                    $facebookUrl !== '' ||
                    $instagramUrl !== ''
                ): ?>

                    <div class="footer-social-links">

                        <?php if ($youtubeUrl !== ''): ?>

                            <a
                                href="<?= htmlspecialchars($youtubeUrl, ENT_QUOTES, 'UTF-8') ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="YouTube">

                                <i class="bi bi-youtube"></i>

                            </a>

                        <?php endif; ?>

                        <?php if ($facebookUrl !== ''): ?>

                            <a
                                href="<?= htmlspecialchars($facebookUrl, ENT_QUOTES, 'UTF-8') ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Facebook">

                                <i class="bi bi-facebook"></i>

                            </a>

                        <?php endif; ?>

                        <?php if ($instagramUrl !== ''): ?>

                            <a
                                href="<?= htmlspecialchars($instagramUrl, ENT_QUOTES, 'UTF-8') ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Instagram">

                                <i class="bi bi-instagram"></i>

                            </a>

                        <?php endif; ?>

                    </div>

                <?php endif; ?>

                <hr class="footer-divider">

                <div class="footer-copyright">

                    <?= htmlspecialchars($footerText, ENT_QUOTES, 'UTF-8') ?>

                </div>

            </div>

        </div>

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>