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

        <?php $this->insert('assets/favicon') ?>
        <?php $this->insert('assets/css') ?>
    </head>
    <body>
        <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
            <symbol id="logo" viewBox="0 0 100 100">
                <circle
                    cx="50"
                    cy="50"
                    r="49"
                    style="fill:#2D2D2D;stroke:#808285"
                />
                <path d="M17.7 50c0-17.5 13.6-31.8 32.3-31.8 11.1 0 17.8 3 24.2 8.4l-8.5 10.3c-4.8-4-9-6.2-16.1-6.2 -9.9 0-17.7 8.7-17.7 19.4 0 11.3 7.7 19.5 18.7 19.5 4.9 0 9.3-1.2 12.8-3.7V57H49.6V45.3h26.7v26.7c-6.3 5.4-15 9.8-26.3 9.8C30.9 81.8 17.7 68.4 17.7 50z"
                      style="fill:none;stroke-width:4;stroke:#808285"
                />
            </symbol>
        </svg>

        <?php $this->insert('frontend/header') ?>
        <?= $this->section('content') ?>
        <?php $this->insert('frontend/footer') ?>
        <?php $this->insert('assets/js') ?>
    </body>
</html>