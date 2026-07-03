-- SingThyGlory Studio
-- SEO Manager default settings
-- Safe to run more than once

INSERT INTO site_settings (setting_key, setting_value) VALUES
(
    'seo_title',
    'SingThyGlory | Christian Worship Music, Radio, Bible, Prayer & Hope'
),
(
    'meta_description',
    'SingThyGlory shares the love of Jesus Christ through Christian worship music, 24/7 radio, Bible reading, prayer and messages of hope.'
),
(
    'meta_keywords',
    'Christian worship music, Christian radio, Jesus songs, Hindi Christian songs, English worship songs, Telugu Christian songs, Bible reading, Christian prayer'
),
(
    'canonical_url',
    'https://singthyglory.com/'
),
(
    'og_title',
    'SingThyGlory | Glorifying Jesus Through Every Song'
),
(
    'og_description',
    'Experience Christian worship music, 24/7 radio, Bible reading, prayer and messages of hope with SingThyGlory.'
),
(
    'og_image',
    'https://singthyglory.com/assets/images/banners/banner.jpg'
)
ON DUPLICATE KEY UPDATE
    setting_value = VALUES(setting_value);
