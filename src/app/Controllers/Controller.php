<?php

namespace app\Controllers;

use app\Exceptions\MyException;
use app\Models\Service;
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
     * @return string
     * @throws MyException
     */
    public function index()
    {
        $dir = 'app/Examples';

        if ($this->isConsole()) {
            $message = 'Use syntax: php index.php example [' . implode('|', $this->commandHelp()) . ']';
        } else {
            $message = 'Use syntax: index.php/{Example}/[' . implode('/', $this->commandHelp()) . ']';
        }

        $text[] = 'Hello dev!';
        $text[] = $message;
        $text[] = 'Try using one the following example : ';

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

        $text[] = '';
        $text[] = 'Options available:';
        $text[] = '';
        $text[] = sprintf("%s", $this->showHelp());

        return implode($this->breakLine(), $text);
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
            throw new MyException("Method [{$method}] not exist in " . get_class($this), 1);
        }

        /** @var Service $service */
        $service = new $class($options[0]);
        return $service->call()->response();

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
