<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="robots" content="noindex">
        <title>
            <?= $title ?? 'Gulchuk :: Personal Website' ?>
        </title>
        <?php $this->insert('assets::favicon') ?>
        <?php $this->insert('assets::css') ?>
    </head>
    <body>
        <main class="center-flex">
            <section class="section vcenter-section">
                <div class="container">
                    <?= $this->section('content') ?>
                    <p class="has-text-centered">
                        <a href="/">Go to Home page</a>
                    </p>
                </div>
            </section>
        </main>
    </body>
</html>