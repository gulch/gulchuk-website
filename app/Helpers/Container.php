<?php

namespace App\Helpers;

use Psr\Container\ContainerInterface;

class Container
{
    /** @var ContainerInterface */
    private $container;

    private static $instance;

    private function __construct() {}
    private function __clone () {}
    private function __wakeup() {}

    public static function getInstance(): self
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public static function bootstrap(ContainerInterface $container): void
    {
        $instance = static::getInstance();

        if (null !== $instance->container) {
            throw new Exception('Container exists already');
        }

        $instance->container = $container;
    }

    public function getContainer(): ContainerInterface
    {
        if (null === $this->container) {
            throw new Exception('Set your container first');
        }

        return $this->container;
    }
}