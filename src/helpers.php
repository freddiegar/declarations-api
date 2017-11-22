<?php

use FreddieGar\DeclarationApi\Exceptions\DeclarationApiException;

if (!function_exists('env')) {
    /**
     * @param $var
     * @param null $default
     * @return null
     * @throws DeclarationApiException
     */
    function env($var, $default = null)
    {
        static $env = [];

        if (count($env) == 0) {
            $configs = file('../.env');

            if (!$configs) {
                return $env[$var] = $default;
            }

            foreach ($configs as $config) {
                list($name, $value) = explode('=', $config);
                $env[$name] = trim($value);
            }
        }

        return isset($env[$var]) ? $env[$var] : $default;
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
