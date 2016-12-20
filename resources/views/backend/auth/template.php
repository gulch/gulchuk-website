<!DOCTYPE html>
<html>
    <head>
        <title>
            <?= $title ?? 'Gulchuk :: Personal Website' ?>
        </title>
        <meta name="robots" content="noindex">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php $this->insert('assets/favicon') ?>

        <?php $this->insert('assets/fonts') ?>

        <?php $this->insert('backend/includes/css') ?>
    </head>
    <body>
        <!--Меню-->
        <div class="ui borderless main menu">
            <div class="ui text container">
                <a href="/" class="header item">
                    <img class="logo" src="/assets/favicon/favicon-32x32.png">
                </a>
                <div class="right menu">
                    <a href="/auth/recover" class="ui item">Recover password?</a>
                    <a href="/auth/login" class="ui item">Login</a>
                </div>
            </div>
        </div>

        <?= $this->section('content') ?>

        <?php $this->insert('backend/includes/js') ?>
    </body>
</html>