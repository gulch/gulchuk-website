<?php

namespace App\Helpers;

use Psr\Container\ContainerInterface;
use Exception;

class Container
{
    /** @var ContainerInterface */
    private $container;

    private static $instance;

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

    public static function getInstance(): self
    {
        if (!self::$instance) {
            throw new Exception('Instance not initialized. Bootstrap first!');
        }

        return self::$instance;
    }

    public static function bootstrap(ContainerInterface $container): void
    {
        if (self::$instance) {
            throw new Exception('Already bootstraped!');
        }

        self::$instance = new self;
        self::$instance->container = $container;
    }

    public function getContainer(): ContainerInterface
    {
        if (null === $this->container) {
            throw new Exception('Container not isset!');
        }

        return $this->container;
    }
}
