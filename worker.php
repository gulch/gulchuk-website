#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

/* Register Dotenv */
(new \Dotenv\Dotenv(__DIR__))->load();

/* Load Configuration */
\App\Helpers\Config::bootstrap(__DIR__ . '/config');

/* Boot Eloquent ORM */
require __DIR__ . '/app/bootstrap/db.php';

$options = $_POST;

$handler = config('jobs.map')[$options['job']];

if (!$handler) {
    die('Handler not exists');
}

call_user_func($handler, $options);

exit();
