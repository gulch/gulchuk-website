#!/usr/bin/env php
<?php

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/app/bootstrap/core.php';

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
