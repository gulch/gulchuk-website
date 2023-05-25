<?php

namespace App\Helpers;

use App\Helpers\SingletonTrait;
use Exception;
use Psr\Container\ContainerInterface;

class Container
{
    use SingletonTrait;

    private ContainerInterface $container;

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
