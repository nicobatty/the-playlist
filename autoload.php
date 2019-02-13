<?php

$prefix = 'NicoBatty\ThePlaylist';
$src = 'src';

spl_autoload_register(function ($className) use ($prefix, $src) {
    $noPrefixClassName = substr($className, strlen($prefix) + 1);
    $path = __DIR__ . '/' . $src . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $noPrefixClassName) . '.php';
    if (!file_exists($path)) {
        throw new Exception('Path for class ' . $className . ' does not exists in path ' . $path);
    }
    require $path;
});