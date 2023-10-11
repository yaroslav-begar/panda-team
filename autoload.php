<?php

$classmap = [
    'controller' => __DIR__ . '/src/Controller',
    'model' => __DIR__ . '/src/Model'
];

\spl_autoload_register(function(string $className) use ($classmap) {
    $parts = \explode('\\', $className);

    $namespace = \strtolower(\array_shift($parts));
    $classFile = \array_pop($parts) . '.php';

    if (!\array_key_exists($namespace, $classmap)) {
        return;
    }

    $path = \implode(DIRECTORY_SEPARATOR, $parts);
    $file = $classmap[$namespace] . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $classFile;

    if (!\file_exists($file)) {
        return;
    }

    require_once $file;
});
