<?php

use app\Exceptions\MyException;

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
            $configs = file('.env');

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
