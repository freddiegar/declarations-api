<?php

use FreddieGar\DeclarationApi\Controllers\Controller;
use FreddieGar\DeclarationApi\Exceptions\DeclarationApiException;

require '../vendor/autoload.php';
require '../src/helpers.php';

try {
    $method = 'index';
    $options = [];
    $queryString = '';
    if (!empty($_SERVER['QUERY_STRING'])) {
        // For instance: index.php?consumerRent/xml in browser
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

    $type = 'Server response:';
    $controller = new Controller();
    $response = $controller->{$method}($options);
} catch (DeclarationApiException $e) {
    $type = 'Server error:';
    $response = $e->getMessage();
} catch (Exception $e) {
    $type = 'Client exception:';
    $response = $e->getMessage();
} finally {
    echo $type . breakLine() . $response;
}
