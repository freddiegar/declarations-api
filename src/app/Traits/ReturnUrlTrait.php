<?php

namespace app\Traits;

/**
 * Trait ReturnUrlTrait
 * @package app\Traits
 */
trait ReturnUrlTrait
{
    /**
     * @return string
     */
    public function returnUrl()
    {
        $protocol = ($_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';

        return sprintf('%s%s%s/../public/index.php', $protocol, $_SERVER['SERVER_NAME'], $_SERVER['SCRIPT_NAME']);
    }
}
