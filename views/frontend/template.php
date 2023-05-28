<!DOCTYPE html>
<html lang="en">

<?php
    /** @var \League\Plates\Template\Template $this */
    $title = $title ?? 'Gulchuk :: Personal Website';
    $description = $description ?? 'Personal Website. Blog. Articles about web development';
    $image = $image ?? config('app.default_social_image');
?>

<head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>">
    <meta name="keywords" content="<?= $keywords ?? 'gulchuk, website, blog' ?>">
    <link rel="image_src" href="{{ $image }}">

    <?php if (isset($noindex)) : ?>
        <meta name="robots" content="noindex">
    <?php endif; ?>

    <?php /* Preload */ ?>
    <link rel="preload" href="<?= g_asset('f.css') ?>" as="style">
    <link rel=preload href="<?= g_asset('s.js') ?>" as=script>
    <link rel=preload href="/f/f.woff2" as=font type="font/woff2" crossorigin=anonymous>

    <?php /* Social: Facebook / Open Graph */ ?>
    <meta property="og:url" content="<?= currentURL() ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $title ?>">
    <meta property="og:image" content="<?= $image ?>" />
    <meta property="og:description" content="<?= $description ?>">
    <meta property="og:site_name" content="<?= config('app.name') ?>">

    <?php /* Social: Twitter */ ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@gulch_47">
    <meta name="twitter:creator" content="@gulch_47">

    <?php /* Application Version */ ?>
    <meta name="version" content="<?= config('app.version') ?>">

    <?php $this->insert('frontend/includes/css', ['styles' => $styles ?? null]) ?>

    <?php /* SVG Iconn Sprite Loader */ ?>
    <script async src="<?= g_asset('s.js') ?>" fetchpriority="high"></script>

    <?php /* RSS Feed */ ?>
    <link rel="alternate" type="application/rss+xml" title="<?= config('app.name') ?> RSS Feed" href="/feed">

    <?php $this->insert('assets/favicon') ?>
</head>

<body>
    <?php $this->insert('frontend/includes/header') ?>

    <?= $this->section('content') ?>

    <?php /*$this->insert('frontend/includes/footer')*/ ?>

    <?php $this->insert('frontend/includes/js', ['scripts' => $scripts ?? null]) ?>

    <?php /* Google Analytics */ ?>
    <?php if (config('app.google_analytics_id')) : ?>
        <script async 
                src="<?= g_asset('a.js') ?>"
                data-gaid="<?= config('app.google_analytics_id') ?>"
        ></script>
    <?php endif; ?>
</body>
</html>
