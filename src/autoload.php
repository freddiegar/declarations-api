<?php

spl_autoload_register(function ($className) {
    $src = __DIR__ . '/';
    $classFile = $src . str_replace('\\', '/', $className) . '.php';

    if (!file_exists($classFile)) {
        throw new Exception("File $classFile not exist! [$className]", 1);
    }

    require_once $classFile;
});
