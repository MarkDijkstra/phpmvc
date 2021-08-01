<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('APPLICATION_PATH', substr(realpath(dirname(__FILE__)), 0, -6));

require '../config/config.php';
require '../src/Psr4AutoloaderClass.php';

// PSR4 autoloader class.
$loader = new Core\Psr4AutoloaderClass();
$loader->register();

// Error and Exception handling.
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

// Route dispatch
$router = new Core\Router();
$router->dispatch();
