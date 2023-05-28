<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">

    <title>
        <?= $title ?? 'Gulchuk :: Personal Website' ?>
    </title>

    <?php $this->insert('assets/favicon') ?>

    <?php $this->insert('frontend/includes/css') ?>
</head>

<body>
    <main class="ui container flex-one">
        <div class="ui center aligned grid vcenter-align errors-grid">
            <div class="twelve wide computer sixteen wide tablet column">

                <?= $this->section('content') ?>

                <p>
                    <a href="/">Go to Home page</a>
                </p>
            </div>
        </div>
    </main>
</body>

</html>
