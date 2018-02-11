<?php

namespace App\Helpers;

use Exception;
use Psr\Container\ContainerInterface;
use App\Helpers\SingletonTrait;

class Container
{
    use SingletonTrait;

    /** @var ContainerInterface */
    private $container;

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
