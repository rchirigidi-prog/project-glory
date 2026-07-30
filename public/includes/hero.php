<section class="hero" id="home">

    <div class="hero-overlay"></div>

    <div class="container">

        <div class="row align-items-center gy-5">

            <!-- Hero Content -->
            <div class="col-lg-6 fade-up">

                <span class="hero-subtitle">
                    ✝️ 24/7 Christian Worship Radio
                </span>

                <h1>
                    <?= htmlspecialchars(setting('hero_title') ?: "Experience God's Presence") ?>
                </h1>

                <p>
                    <?= htmlspecialchars(setting('hero_subtitle') ?: 'Sharing the love of Jesus Christ through worship music, Christian radio, Bible reading, prayer and messages of hope around the world.') ?>
                </p>

                <div class="hero-buttons">

                    <a
                        href="<?= htmlspecialchars(setting('hero_button_url') ?: '#player') ?>"
                        class="btn btn-warning btn-lg">

                        ▶ <?= htmlspecialchars(setting('hero_button_text') ?: 'Listen Live') ?>

                    </a>

                    <a
                        href="<?= htmlspecialchars(setting('youtube_button_url') ?: '#youtube') ?>"
                        class="btn btn-outline-light btn-lg">

                        📺 <?= htmlspecialchars(setting('youtube_button_text') ?: 'Watch Videos') ?>

                    </a>

                </div>

                <div class="hero-features">

                    <span>📻 Live Radio</span>

                    <span>🎵 Worship Music</span>

                    <span>📖 Bible Reading</span>

                    <span>🙏 Prayer</span>

                    <span>❤️ Daily Hope</span>

                </div>

            </div>

            <!-- Hero Image -->
            <div class="col-lg-6 text-center fade-up">

                <img
                    src="<?= htmlspecialchars(setting('hero_image') ?: 'assets/images/hero/hero-image.png') ?>"
                    alt="Jesus Christ"
                    class="img-fluid hero-image"
                    loading="eager">

            </div>

        </div>

    </div>

</section>