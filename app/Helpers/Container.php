<?php

class Container
{
    private static $instance;
    private $container;

    private function __construct() {}

    private static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public static function create($container)
    {
        $instance = static::getInstance();

        if (null !== $instance->container) {
            throw new Exception('Container exists already');
        }

        $instance->container = $container;
    }

    public static function getContainer()
    {
        if (null === static::$instance->container) {
            throw new Exception('Set your container first');
        }

        return static::$instance->container;
    }
}