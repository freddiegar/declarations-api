<?php

namespace app\Traits;

trait HelperTrait
{
    /**
     * @return bool
     */
    protected function isConsole()
    {
        if ('cli' == php_sapi_name()) {
            return true;
        }

        return false;
    }
}
