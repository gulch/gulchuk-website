<?php

class Container
{
    private static $instance;
    private $container;

    private function __construct() {}

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        if (null === $this->container) {
            throw new Exception('Set your container first');
        }

        return $this->container;
    }
}