<?php

$seoTitle = setting(
    'seo_title',
    'SingThyGlory | 24/7 Christian Worship Radio'
);

$metaDescription = setting(
    'meta_description',
    'SingThyGlory shares the love of Jesus Christ through Christian worship music, 24/7 radio, Bible reading, prayer and messages of hope.'
);

$metaKeywords = setting(
    'meta_keywords',
    'Christian worship music, Christian radio, Jesus songs, Bible reading, Christian prayer'
);

$canonicalUrl = setting(
    'canonical_url',
    'https://singthyglory.com/'
);

$ogTitle = setting(
    'og_title',
    $seoTitle
);

$ogDescription = setting(
    'og_description',
    $metaDescription
);

$ogImage = setting(
    'og_image',
    'https://singthyglory.com/assets/images/banners/banner.jpg'
);

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?= htmlspecialchars($seoTitle, ENT_QUOTES, 'UTF-8') ?></title>

<meta
    name="description"
    content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8') ?>">

<meta
    name="keywords"
    content="<?= htmlspecialchars($metaKeywords, ENT_QUOTES, 'UTF-8') ?>">

<link
    rel="canonical"
    href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8') ?>">

<!-- Open Graph -->

<meta property="og:type" content="website">

<meta
    property="og:title"
    content="<?= htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8') ?>">

<meta
    property="og:description"
    content="<?= htmlspecialchars($ogDescription, ENT_QUOTES, 'UTF-8') ?>">

<meta
    property="og:url"
    content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8') ?>">

<meta
    property="og:image"
    content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8') ?>">

<meta property="og:site_name" content="SingThyGlory">

<!-- Twitter / X Card -->

<meta name="twitter:card" content="summary_large_image">

<meta
    name="twitter:title"
    content="<?= htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8') ?>">

<meta
    name="twitter:description"
    content="<?= htmlspecialchars($ogDescription, ENT_QUOTES, 'UTF-8') ?>">

<meta
    name="twitter:image"
    content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8') ?>">

<!-- Google Fonts -->

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">

<!-- Bootstrap -->

<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    rel="stylesheet">

<!-- Bootstrap Icons -->

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Custom CSS -->

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
