<?php

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
