<?php

use FreddieGar\DeclarationApi\Exceptions\MyException;

if (!function_exists('env')) {
    /**
     * @param $var
     * @param null $default
     * @return null
     * @throws MyException
     */
    function env($var, $default = null)
    {
        static $env = [];

        if (count($env) == 0) {
            $configs = file('../.env');

            if (!$configs) {
                throw new MyException('File .env not found, create it and try again.');
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
