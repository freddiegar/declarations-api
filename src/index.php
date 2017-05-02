<?php

namespace app;

use app\Exceptions\MyException;
use Exception;
use app\Controllers\Controller;

require 'autoload.php';

try {
    if (!empty($_SERVER['QUERY_STRING'])) {
        $method = 'undefined';
        $arguments = [];
        $url = explode('/', $_SERVER['QUERY_STRING']);

        if (!empty($url[0])) {
            $method = $url[0];
            unset($url[0]);
        }

        if (!empty($url[1])) {
            // save     : Create or Update requestId
            // xml      : Show request in XML
            // redirect : Redirection to application, only when exist
            //            property redirectTo in response
            foreach ($url as $index => $argument) {
                $arguments[] = $argument;
            }
        }

        $controller = new Controller();
        echo $controller->{$method}($arguments);
    }
} catch (MyException $e) {
    die($e->getMessage());
} catch (Exception $e) {
    die($e->getMessage());
}
