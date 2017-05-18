<?php

namespace app;

use app\Controllers\Controller;
use app\Exceptions\MyException;
use Exception;

require 'autoload.php';
require 'helpers.php';

try {
    $method = 'index';
    $options = [];
    $queryString = '';

    if (!empty($_SERVER['QUERY_STRING'])) {
        // For instance: consumerRent/xml in browser
        $queryString = $_SERVER['QUERY_STRING'];
    } elseif (isset($argc)) {
        // For instance: index.php consumerRent xml in console
        unset($argv[0]); // This is path file
        $queryString = implode('/', $argv);
    }

    $url = explode('/', $queryString);

    if (!empty($url[0])) {
        $method = $url[0];
        unset($url[0]);
    }

    if (!empty($url[1])) {
        // Exist options in request
        foreach ($url as $index => $option) {
            $options[] = $option;
        }
    }

    $controller = new Controller();
    echo $controller->{$method}($options);
} catch (MyException $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}
