<?php

namespace app\Controllers;

use app\Exceptions\MyException;
use app\Traits\HelperTrait;

/**
 * Class Controller
 * @package app\Controllers
 */
class Controller
{
    use HelperTrait;

    const DIR_EXAMPLES = 'app\Examples\\';

    /**
     * @throws MyException
     */
    public function index()
    {
        $br = $this->isConsole() ? PHP_EOL : '<br/>';
        $dir = 'app/Examples';

        $text[] = 'Hello dev!';
        $text[] = 'Use syntax: php index.php example [' . implode('|', $this->commandHelp()) . ']';
        $text[] = 'Try again using one the following example : ';

        if (!is_dir($dir)) {
            throw new MyException(sprintf('Directory [%s] from %s not is valid.', $dir, getcwd()));
        }

        $examples = opendir($dir);
        while (($example = readdir($examples)) !== false) {
            if (in_array($example, ['.', '..'])) {
                continue;
            }

            $text[] = sprintf("\t - %s", str_replace('.php', '', $example));
        }

        echo implode($br, $text);
    }

    /**
     * @param $method
     * @param array $options
     * @return mixed
     * @throws MyException
     */
    public function __call($method, array $options = [])
    {
        $class = self::DIR_EXAMPLES . ucfirst($method);

        if (!class_exists($class)) {
            throw new MyException("Method [{$method}] not exist on " . get_class($this), 1);
        }

        return (new $class($options[0]))->call()->response();

    }

    /**
     * @param $method
     * @param array $options
     * @throws MyException
     */
    public static function __callStatic($method, array $options = [])
    {
        if (!method_exists(self::class, $method)) {
            throw new MyException("Method static [{$method}] not exist on " . get_class(self::class), 1);
        }
    }
}
