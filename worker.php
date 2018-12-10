#!/usr/bin/env php
<?php

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/app/bootstrap/core.php';

/* Register Logger */
$logger = new \Monolog\Logger(config('app.name'), [
    new \Monolog\Handler\StreamHandler(projectPath() . '/storage/logs/' . date('Ymd') . '.log'),
]);

$options = $_POST;

$job_name = $options['job'] ?? null;

if (!$job_name) {
    $logger->error('Job POST param not found. Params: ' . "\n" . print_r($options));
    exit();
}

if (!class_exists($job_name)) {
    $logger->error('Job Class: ' . $job_name . ' not exists!');
    exit();
}

/** @var \App\Contracts\Job $job */
$job = new $job_name;
$job->handle($options);

exit();
