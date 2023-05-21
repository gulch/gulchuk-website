<?php

/** @var \League\Plates\Template\Template $this */
$title = $title ?? 'Gulchuk :: Personal Website';
$description = $description ?? 'Personal Website. Blog. Articles about web development';
$image = $image ?? config('app.default_social_image');
?>
<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#" itemscope="itemscope" itemtype="http://schema.org/WebSite">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>">
    <meta name="keywords" content="<?= $keywords ?? 'gulchuk, website, blog, personal, page, site, web' ?>">

    <link rel="alternate" type="application/rss+xml" title="<?= config('app.name') ?> RSS Feed" href="/feed">

    <?php /* Schema.org */ ?>
    <meta itemprop="name" content="<?= $title ?>">
    <meta itemprop="description" content="<?= $description ?>">
    <meta itemprop="image" content="<?= $image ?>">
    <link itemprop="url" href="<?= currentURL() ?>">

    <?php /* Social: Facebook / Open Graph */ ?>
    <meta property="og:url" content="<?= currentURL() ?>">
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?= $title ?>">
    <meta property="og:image" content="<?= $image ?>" />
    <meta property="og:description" content="<?= $description ?>">
    <meta property="og:site_name" content="<?= config('app.name') ?>">

    <?php /* Social: Twitter */ ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@gulch_47">
    <meta name="twitter:creator" content="@gulch_47">

    <?php if (isset($noindex)) : ?>
        <meta name="robots" content="noindex">
    <?php endif; ?>

    <?php $this->insert('frontend/includes/preload') ?>

    <?php /* Application Version */ ?>
    <meta name="version" content="<?= config('app.version') ?>">

    <?php /* SVG Iconn Sprite Loader */ ?>
    <script async src="<?= config('app.build_folder_path') . config('app.version') ?>/s.js"></script>

    <?php $this->insert('assets/favicon') ?>
</head>

<body>
    <?php $this->insert('frontend/includes/header') ?>

    <?= $this->section('content') ?>

    <?php /*$this->insert('frontend/includes/footer')*/ ?>

    <?php $this->insert('frontend/includes/css', ['styles' => $styles ?? null]) ?>
    <?php $this->insert('frontend/includes/js', ['scripts' => $scripts ?? null]) ?>

    <?php if (config('app.google_analytics_id')) : ?>
        <script async 
                src="<?= config('app.build_folder_path') . config('app.version') ?>/a.js"
                data-gaid="<?= config('app.google_analytics_id') ?>"
        ></script>
    <?php endif; ?>
</body>

</html>
