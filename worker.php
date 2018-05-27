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

$job_name = $options['job'] ?? null;

if (!$job_name) {
    die('Job not found');
}

$handler = config('jobs.map')[$job_name] ?? null;

if (!$handler) {
    die('Handler not exists');
}

call_user_func($handler, $options);

exit();
