<?php

require '../config/config.php';

if (ENV && ENV == 'dev') {
    error_reporting(E_ALL);
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    ini_set("log_errors", 1);
    ini_set("error_log", "./../logs/error-log.log");
}

require '../vendor/autoload.php';

// require '../src/Psr4AutoloaderClass.php';

// // PSR4 autoloader class.
// $loader = new Core\Psr4AutoloaderClass();
// $loader->register();

// Error and Exception handling.
// set_error_handler('Core\Error::errorHandler');
// set_exception_handler('Core\Error::exceptionHandler');

// Route dispatch
$router = new Core\Router();
$router->dispatch();
