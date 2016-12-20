<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            <?= $title ?? 'Gulchuk :: Personal Website' ?>
        </title>
        <meta name="description" content="">
        <meta name="keywords" content="">

        <?php if (isset($noindex)): ?>
            <meta name="robots" content="noindex">
        <?php endif; ?>

        <?php $this->insert('assets/favicon') ?>
        <?php $this->insert('assets/fonts') ?>
        <?php $this->insert('frontend/includes/css') ?>
    </head>
    <body>
        <svg xmlns="http://www.w3.org/2000/svg" class="display-none">
            <symbol id="logo" viewBox="0 0 100 100">
                <circle fill="none" stroke="#414042" stroke-width="3" stroke-miterlimit="10" cx="50" cy="50" r="48"/>
                <path fill="none" stroke="#414042" stroke-width="3" stroke-miterlimit="10" d="M18.3 50c0-17.1 13.4-31.2 31.6-31.2 10.9 0 17.4 2.9 23.7 8.3l-8.4 10.1c-4.7-3.9-8.8-6.1-15.8-6.1-9.7 0-17.3 8.5-17.3 19 0 11 7.6 19.1 18.3 19.1 4.8 0 9.1-1.2 12.5-3.6V57H49.6V45.4h26.2v26.2c-6.2 5.3-14.7 9.6-25.8 9.6C31.3 81.2 18.3 68 18.3 50z"/>
            </symbol>
        </svg>

        <?php $this->insert('frontend/includes/header') ?>

        <?= $this->section('content') ?>

        <?php $this->insert('frontend/includes/footer') ?>

        <?php $this->insert('frontend/includes/js') ?>
    </body>
</html>