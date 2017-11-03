<?php
    /** @var \League\Plates\Template\Template $this */
    $title = $title ?? 'Gulchuk :: Personal Website';
    $description = $description ?? 'Personal Website. Blog. Articles about web development';
    $image = $image ?? config('app.default_social_image');
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?= $title ?></title>
        <meta name="description" content="<?= $description ?>">
        <meta name="keywords" content="<?= $keywords ?? 'gulchuk, website, blog, personal, page, site, web' ?>">

        <link rel="alternate" type="application/rss+xml" title="<?= config('app.name') ?> RSS Feed" href="/feed">

        <?php /* Social: Google+ / Schema.org */ ?>
        <link href="https://plus.google.com/110104943340923924368" rel="publisher">
        <meta itemprop="name" content="<?= $title ?>">
        <meta itemprop="description" content="<?= $description ?>">
        <meta itemprop="image" content="<?= $image ?>">
        <link itemprop="url" href="<?= currentURL() ?>">

        <?php /* Social: Facebook / Open Graph */ ?>
        <meta property="og:url" content="<?= currentURL() ?>">
        <meta property="og:type" content="article">
        <meta property="og:title" content="<?= $title ?>">
        <meta property="og:image" content="<?= $image ?>"/>
        <meta property="og:description" content="<?= $description ?>">
        <meta property="og:site_name" content="<?= config('app.name') ?>">

        <?php /* Social: Twitter */ ?>
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@gulch_47">
        <meta name="twitter:creator" content="@gulch_47">

        <?php if (isset($noindex)): ?>
            <meta name="robots" content="noindex">
        <?php endif; ?>

        <?php $this->insert('frontend/includes/preload') ?>

        <?php $this->insert('frontend/includes/svg-icons-loader') ?>

        <?php $this->insert('frontend/includes/loader-style') ?>

        <?php $this->insert('assets/favicon') ?>
    </head>
    <body>
        <!-- Loader -->
        <div class="cssload-container">
            <div class="cssload-loading">
                <div class="ball-scale-multiple">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

        <?php $this->insert('frontend/includes/header') ?>

        <?= $this->section('content') ?>

        <?php $this->insert('frontend/includes/footer') ?>

        <?php $this->insert('frontend/includes/counters') ?>
        <?php $this->insert('frontend/includes/css', ['styles' => $styles ?? null]) ?>
        <?php $this->insert('frontend/includes/js', ['scripts' => $scripts ?? null]) ?>
    </body>
</html>