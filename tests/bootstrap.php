<?php
spl_autoload_register(function ($class) {
    if (strpos($class, 'CollectionJson') !== false) {
        require __DIR__ . '/../' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    }
});
