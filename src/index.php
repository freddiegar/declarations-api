<?php

namespace app;

use app\Controllers\Controller;
use app\Exceptions\MyException;
use Exception;

require 'autoload.php';

try {
    if (!empty($_SERVER['QUERY_STRING'])) {
        // For instance: consumerRent/xml
        $queryString = $_SERVER['QUERY_STRING'];
    } else {
        // For instance: index.php consumerRent xml
        unset($argv[0]); // This is path file
        $queryString = implode('/', $argv);
    }

    $method = 'index';
    $options = [];
    $url = explode('/', $queryString);

    if (!empty($url[0])) {
        $method = $url[0];
        unset($url[0]);
    }

    if (!empty($url[1])) {
        // request  : Show request do in service
        // no-call  : No call web service, by default always make it
        // link     : Creating a link in response
        // save     : Create or Update requestId
        // redirect : Redirection to application, only when exist
        //            property redirectTo in response
        foreach ($url as $index => $option) {
            $options[] = $option;
        }
    }

    $controller = new Controller();
    echo $controller->{$method}($options);
} catch (MyException $e) {
    die($e->getMessage());
} catch (Exception $e) {
    die($e->getMessage());
}
