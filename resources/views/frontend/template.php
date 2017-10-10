<?php
    /** @var $this \League\Plates\Template\Template */
    $title = $title ?? 'Gulchuk :: Personal Website';
    $description = $description ?? 'Personal Website. Blog. Articles about web development';
?>
<html>
    <head>
        <title><?= $title ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="description" content="<?= $description ?>">
        <meta name="keywords" content="<?= $keywords ?? 'gulchuk, website, blog, personal, page, site, web' ?>">

        <?php /* Social: Google+ / Schema.org */ ?>
        <link href="https://plus.google.com/110104943340923924368" rel="publisher">
        <meta itemprop="name" content="<?= $title ?>">
        <meta itemprop="description" content="<?= $description ?>">
        <meta itemprop="image" content="<?= $image ?>">
        <link itemprop="url" href="<?= currentURL() ?>"/>

        <?php /* Social: Facebook / Open Graph */ ?>
        <meta property="og:url" content="<?= currentURL() ?>">
        <meta property="og:type" content="article">
        <meta property="og:title" content="<?= $title ?>">
        <meta property="og:image" content="<?= $image ?>"/>
        <meta property="og:description" content="<?= $description ?>">
        <meta property="og:site_name" content="GULCHUK.COM">

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

        <!-- SVG Logo -->
        <svg xmlns="http://www.w3.org/2000/svg" class="display-none">
            <symbol id="logo" viewBox="0 0 100 100">
                <circle fill="none" stroke="#414042" stroke-width="3" stroke-miterlimit="10" cx="50" cy="50" r="48"/>
                <path fill="none" stroke="#414042" stroke-width="3" stroke-miterlimit="10" d="M18.3 50c0-17.1 13.4-31.2 31.6-31.2 10.9 0 17.4 2.9 23.7 8.3l-8.4 10.1c-4.7-3.9-8.8-6.1-15.8-6.1-9.7 0-17.3 8.5-17.3 19 0 11 7.6 19.1 18.3 19.1 4.8 0 9.1-1.2 12.5-3.6V57H49.6V45.4h26.2v26.2c-6.2 5.3-14.7 9.6-25.8 9.6C31.3 81.2 18.3 68 18.3 50z"/>
            </symbol>
        </svg>

        <?php $this->insert('frontend/includes/header') ?>

        <?= $this->section('content') ?>

        <?php $this->insert('frontend/includes/footer') ?>

        <?php $this->insert('frontend/includes/counters') ?>
        <?php $this->insert('frontend/includes/css', ['styles' => $styles ?? null]) ?>
        <?php $this->insert('frontend/includes/js', ['scripts' => $scripts ?? null]) ?>
    </body>
</html>