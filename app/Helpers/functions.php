<?php

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }
        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }
        if (is_string($value) && substr($value, 0, 1) === '"' && substr($value, -1, 1) === '"') {
            return substr($value, 1, -1);
        }
        return $value;
    }
}

if (! function_exists('elixir')) {
    /**
     * Get the path to a versioned Elixir file.
     *
     * @param  string  $file
     * @param  string  $buildDirectory
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    function elixir($file, $buildDirectory = 'build')
    {
        static $manifest = [];
        static $manifestPath;

        if (empty($manifest) || $manifestPath !== $buildDirectory) {
            $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $buildDirectory.'/rev-manifest.json';

            if (file_exists($path)) {
                $manifest = json_decode(file_get_contents($path), true);
                $manifestPath = $buildDirectory;
            }
        }

        $file = ltrim($file, '/');

        if (isset($manifest[$file])) {
            return '/'.trim($buildDirectory.'/'.$manifest[$file], '/');
        }

        $unversioned = $_SERVER['DOCUMENT_ROOT'] . '/' . $file;

        if (file_exists($unversioned)) {
            return '/'.trim($file, '/');
        }

        throw new InvalidArgumentException("File {$file} not defined in asset manifest.");
    }
}

function container(string $name = null)
{
    $container = Container::getContainer();

    if (!$name) {
        return $container;
    }

    return $container->get($name);
}

function config(string $name)
{
    return Config::getInstance()->get($name);
}

function getPathPrefix(): string
{
    return date('/Y/m');
}

function getFilePath(string $path, string $prefix = ''): string
{
    $prefix = $prefix ?: getPathPrefix();

    $file_path = publicPath() . $path . $prefix;

    if (!file_exists($file_path)) {
        mkdir($file_path, 750, true);
    }

    return $file_path;
}

function publicPath(): string
{
    return realpath(__DIR__ . '/../../public/');
}

function currentURL(bool $full_url = true, bool $with_query = false): string
{
    $result = '';

    $requst_uri = $_SERVER['REQUEST_URI'];

    if (!$with_query) {
        $requst_uri = str_replace('?' . $_SERVER['QUERY_STRING'], '', $requst_uri);
    }

    $result = $requst_uri;

    if ($full_url) {
        $result = config('app_url') . $result;
    }

    /* Remove right slash */
    if (strlen($result) > 1) {
        $result = rtrim($result, '/');
    }

    return $result;
}