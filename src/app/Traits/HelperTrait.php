<?php

namespace app\Traits;

use app\Constants\Command;

/**
 * Trait HelperTrait
 * @package app\Traits
 */
trait HelperTrait
{
    /**
     * @return bool
     */
    protected function isConsole()
    {
        return 'cli' == php_sapi_name();
    }

    /**
     * @return array
     */
    protected function help()
    {
        return [
            [
                'command' => Command::REQUEST,
                'description' => 'Show request do in service'
            ],
            [
                'command' => Command::NO_CALL,
                'description' => 'No call web service, by default always make it'
            ],
            [
                'command' => Command::LINK,
                'description' => 'Creating a link in response'
            ],
            [
                'command' => Command::SAVE,
                'description' => 'Create or Update requestId'
            ],
            [
                'command' => Command::REDIRECT,
                'description' => 'Redirection to application, only when exist property redirectTo in response'
            ],
            [
                'command' => Command::SOAP,
                'description' => 'Do request with SOAP, this value is by default'
            ],
            [
                'command' => Command::REST,
                'description' => 'Do request with method RestFul'
            ],
        ];
    }

    /**
     * @return array
     */
    protected function commandHelp()
    {
        return $this->pluck('command', $this->help());
    }

    /**
     * @param $key
     * @param array $array
     * @return array
     */
    protected function pluck($key, array $array = [])
    {
        return array_map(function ($item) use ($key) {
            return $item[$key];
        }, $array);
    }
}
