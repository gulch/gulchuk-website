<!DOCTYPE html>
<html>
    <head>
        <title>
            <?= $title ?? 'Gulchuk :: Personal Website' ?>
        </title>
        <meta name="robots" content="noindex">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="/assets/vendor/semantic/2.2.6/semantic.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/backend.css">

        <script src="/assets/vendor/jquery/3.1.0/jquery.min.js"></script>
    </head>
    <body>
        <div class="ui main stackable large menu">
            <a href="/" class="header item">
                <img class="logo" src="/assets/favicon/favicon-32x32.png">
            </a>
            <a href="/<?= config('backend_segment') ?>" class="item">
                <i class="dashboard icon"></i>
                Dashboard
            </a>
            <a href="/<?= config('backend_segment') ?>/tags" class="item">
                <i class="tags icon"></i>
                Tags
            </a>
            <div class="right menu">
                <a href="/auth/logout" class="ui item">Logout</a>
            </div>
        </div>

        <div class="ui hidden divider"></div>

        <div class="ui container">
            <?= $this->section('content') ?>
        </div>

        <!-- ----- SCRIPTS ----- -->
        <script defer src="/assets/vendor/semantic/2.2.6/semantic.js"></script>
        <script defer src="/assets/js/backend.js"></script>

    </body>
</html>
