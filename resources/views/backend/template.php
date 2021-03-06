<!DOCTYPE html>
<html>
    <head>
        <title>
            <?= $title ?? 'Gulchuk :: Personal Website' ?>
        </title>
        <meta name="robots" content="noindex">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php $this->insert('assets/favicon') ?>

        <?php $this->insert('backend/includes/css') ?>
    </head>
    <body>
        <div class="ui main stackable large menu">
            <a href="/" class="header item">
                <img class="logo" src="/assets/favicon/favicon-32x32.png">
            </a>
            <a href="/<?= config('app.backend_segment') ?>" class="item">
                <i class="dashboard icon"></i>
                Dashboard
            </a>
            <a href="/<?= config('app.backend_segment') ?>/articles" class="item">
                <i class="file text outline icon"></i>
                Articles
            </a>
            <a href="/<?= config('app.backend_segment') ?>/tags" class="item">
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

        <?= container('body-css')->write() ?>

        <?php $this->insert('backend/includes/js') ?>

    </body>
</html>
