<?php

namespace App\Helpers;

use Symfony\Component\Finder\Finder;

class Config
{
    /** @var array */
    private $config;

    private static $instance;

    private function __construct() {}
    private function __clone () {}
    private function __wakeup() {}

    public static function getInstance(): self
    {
        if (!self::$instance) {
            throw new Exception('Instance not instantiated. Bootstrap first!');
        }

        return self::$instance;
    }

    public static function bootstrap(string $path): void
    {
        if (!$path) {
            throw new Exception('Path to configuration files not isset!');
        }

        if (self::$instance) {
            throw new Exception('Already bootstraped!');
        }

        self::$instance = new self;
        self::$instance->loadFromConfigurationFiles($path);
    }

    public function get(string $key)
    {
        if (isset($this->config[$key])) {
            return $this->config[$key];
        }

        $result = $this->config;

        foreach (explode('.', $key) as $segment) {
            if (is_array($result) && array_key_exists($segment, $result)) {
                $result = $result[$segment];
            } else {
                return null;
            }
        }

        return $result;
    }

    private function loadFromConfigurationFiles(string $path): void
    {
        $files = $this->getConfigurationFiles($path);

        foreach ($files as $key => $file) {
            $this->config[$key] = require $file;
        }
    }

    private function getConfigurationFiles(string $path): array
    {
        $files = [];
        $configPath = realpath($path);

        foreach (Finder::create()->files()->name('*.php')->in($configPath) as $file) {
            $files[basename($file->getRealPath(), '.php')] = $file->getRealPath();
        }

        return $files;
    }
}