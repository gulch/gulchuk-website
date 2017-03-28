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

function obfuscate($value)
{
    $safe = '';

    foreach (str_split($value) as $letter) {
        if (ord($letter) > 128) {
            return $letter;
        }

        // To properly obfuscate the value, we will randomly convert each letter to
        // its entity or hexadecimal representation, keeping a bot from sniffing
        // the randomly obfuscated letters out of the string on the responses.
        switch (rand(1, 3)) {
            case 1:
                $safe .= '&#' . ord($letter) . ';';
                break;

            case 2:
                $safe .= '&#x' . dechex(ord($letter)) . ';';
                break;

            case 3:
                $safe .= $letter;
        }
    }

    return $safe;
}

function mailto_link($email, $title = null)
{
    $email = str_replace('@', '&#64;', obfuscate($email));
    $email = obfuscate('mailto:') . $email;
    $title = $title ?: $email;

    return $this->toHtmlString('<a href="' . $email . '">' . htmlentities($title, ENT_QUOTES, 'UTF-8', false) . '</a>');
}

function container(string $name)
{
    $container = Container::getContainer();

    return $container->get($name);
}

function config(string $name)
{
    return Config::getInstance()->get($name);
}