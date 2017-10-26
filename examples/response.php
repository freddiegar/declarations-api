<?php

echo 'Hello dev!<br/>' . PHP_EOL;

$response = [];

if (isset($_GET) && count($_GET) > 0) {
    $response = array_merge($response, $_GET);
}

if (isset($_POST) && count($_POST) > 0) {
    $response = array_merge($response, $_POST);
}

if (count($response) > 0) {
    echo '<pre>' . print_r($response, true) . '</pre>';
}
