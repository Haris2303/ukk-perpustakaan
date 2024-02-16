<?php

require_once 'config/config.php';

// autoload class on folder core
spl_autoload_register(function ($class) {
    // get class name, if use namespace
    $class = explode('\\', $class);
    $class = end($class);

    require_once __DIR__ . '/core/' . $class . '.php';
});
