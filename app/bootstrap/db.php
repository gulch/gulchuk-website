<?php

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection(config('database'));
$capsule->setAsGlobal();
$capsule->bootEloquent();
