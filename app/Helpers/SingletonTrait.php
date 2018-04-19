<?php

namespace App\Helpers;

use Exception;

trait SingletonTrait
{
    private static $instance;

    public static function getInstance(): self
    {
        if (!self::$instance) {
            throw new Exception('Instance not initialized. Bootstrap first!');
        }

        return self::$instance;
    }

    private function __construct()
    {
        //
    }

    private function __clone()
    {
        //
    }

    private function __wakeup()
    {
        //
    }
}
