<?php

namespace app\Traits;

/**
 * Trait ReturnUrlTrait
 * @package app\Traits
 */
trait ReturnUrlTrait
{
    use HelperTrait;

    /**
     * @return string
     */
    public function returnUrl()
    {
        $returnUrl = 'https://www.google.com.co/';

        if (!isConsole()) {
            $protocol = ($_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
            $returnUrl = sprintf('%s%s%s/../public/index.php', $protocol, $_SERVER['SERVER_NAME'], $_SERVER['SCRIPT_NAME']);

        }

        return $returnUrl;
    }
}
