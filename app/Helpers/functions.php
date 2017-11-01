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

function container(string $name = null)
{
    $container = \App\Helpers\Container::getInstance()->getContainer();

    if (!$name) {
        return $container;
    }

    return $container->get($name);
}

function config(string $key)
{
    return \App\Helpers\Config::getInstance()->get($key);
}

function getUploadPathPrefix(): string
{
    return date('/Y/m');
}

function getUploadFilePath(string $path, string $prefix = ''): string
{
    $prefix = $prefix ?: getUploadPathPrefix();

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
        $result = config('app.url') . $result;
    }

    /* Remove right slash */
    if (strlen($result) > 1) {
        $result = rtrim($result, '/');
    }

    return $result;
}