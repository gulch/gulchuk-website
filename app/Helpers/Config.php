<?php

class Config
{
    private static $instance;
    private $config;

    private function __construct() {}

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    public function get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}