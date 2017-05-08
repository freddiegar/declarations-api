<?php

namespace app\Traits;

trait ReturnUrlTrait
{
    public function returnUrl()
    {
        $protocol = ($_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';

        return sprintf('%s%s%s/../public/index.php', $protocol, $_SERVER['SERVER_NAME'], $_SERVER['SCRIPT_NAME']);
    }
}
