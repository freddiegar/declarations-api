<?php

namespace app\Controllers;

use app\Exceptions\MyException;
use app\Traits\HelperTrait;

class Controller
{
    use HelperTrait;

    public function __construct()
    {
    }

    public function index()
    {
        $br = $this->isConsole() ? PHP_EOL : '<br/>';
        $dir = 'app/Examples';
        $text[] = 'Hello dev!, yoy can use the following calls: ';

        if (!is_dir($dir)) {
            throw new MyException( sprintf('Directory [%s] from %s not is valid.', $dir, getcwd()));
        }

        $examples = opendir($dir);
        while (($example = readdir($examples)) !== false) {
            if (in_array($example, ['.', '..'])) {
                continue;
            }

            $text[] = "\t - " . str_replace('.php', '', $example);
        }

        echo implode($br, $text);
    }

    public function __call($method, array $options = [])
    {
        $class = 'app\Examples\\' . ucfirst($method);

        if (!class_exists($class)) {
            throw new MyException("Method [{$method}] not exist on " . get_class($this), 1);
        }

        return (new $class($options[0]))->call()->response();

    }

    public static function __callStatic($method, array $options = [])
    {
        if (!method_exists(self::class, $method)) {
            throw new MyException("Method static [{$method}] not exist on " . get_class(self::class), 1);
        }
    }
}
