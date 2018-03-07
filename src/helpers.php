<?php

namespace PlacetoPay\DeclarationClient;

if (!function_exists('env')) {
    /**
     * @param $var
     * @param null $default
     * @return array|false|null|string
     */
    function env($var, $default = null)
    {
        static $loaded = null;

        if (!$loaded) {
            $loaded = true;
            try {
                $dotenv = new \Dotenv\Dotenv(__DIR__);
                $dotenv->load();
            } finally {
                // File not exist
                return $default;
            }
        }

        return getenv($var);
    }
}

if (!function_exists('isConsole')) {
    /**
     * @return bool
     */
    function isConsole()
    {
        static $isConsole;

        if (is_null($isConsole)) {
            $isConsole = 'cli' == php_sapi_name();
        }

        return $isConsole;
    }
}

if (!function_exists('breakLine')) {
    /**
     * @return string
     */
    function breakLine()
    {
        static $breakLine;

        if (is_null($breakLine)) {
            $breakLine = isConsole() ? PHP_EOL : '<br/>';
        }

        return $breakLine;
    }
}
