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