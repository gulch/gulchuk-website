<?php

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

function projectPath(): string
{
    return realpath(__DIR__ . '/../../');
}

function currentURL(bool $full_url = true, bool $with_query = false): string
{
    $result = '';

    $request_uri = $_SERVER['REQUEST_URI'];

    if (!$with_query) {
        $request_uri = str_replace('?' . $_SERVER['QUERY_STRING'], '', $request_uri);
    }

    $result = $request_uri;

    if ($full_url) {
        $result = config('app.url') . $result;
    }

    /* Remove right slash */
    if (strlen($result) > 1) {
        $result = rtrim($result, '/');
    }

    return $result;
}

if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    function value($value, ...$args)
    {
        return $value instanceof Closure ? $value(...$args) : $value;
    }
}

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        return \App\Helpers\Env::get($key, $default);
    }
}
