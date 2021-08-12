<?php

require '../config/config.php';
require '../vendor/autoload.php';

if (ENV && ENV == 'dev') {
    error_reporting(E_ALL);
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    ini_set("log_errors", 1);
    ini_set("error_log", "./../logs/error-log.log");
}

// Error and Exception handling.
// This will redirect to an custom (error) page
// we will skip this use a 404 container for this instead
//set_error_handler('Core\Error::errorHandler');
//set_exception_handler('Core\Error::exceptionHandler');
require_once('../routes/web.php');
// Route dispatch
// $router = new Core\Router();
// $router->dispatch();

