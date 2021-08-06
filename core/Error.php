<?php

namespace Core;
use Exception;

class Error 
{
    /**
     * The error handler method.
     * 
     * @param int $level  Error level
     * @param string $message  Error message
     * @param string $file  Filename the error was raised in
     * @param int $line  Line number in the file
     * @return void
     */
    public static function errorHandler(int $level, string $message, string $file, int $line) : void 
    {
        if (error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * The exception handler method.
     *
     * @param Exception $exception The exception
     * @return void
     */
    public static function exceptionHandler($exception) : void 
    {
        $errorinfo = "";
        $header = "404";
        $homepage = DEFAULT_ROUTE;

        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }

        http_response_code($code);

        if (SHOW_ERRORS) {
            $errorinfo = self::getErrorInfo($exception);
        } else {
            self::logToFile($exception);
        }

        View::renderError(compact(["errorinfo", "header", "homepage"]));
    }

    /**
     * The method that write error info to log file.
     *
     * @param Exception $exception The exception
     * @return void
     */
    public static function logToFile(Exception $exception) : void 
    {
        ini_set('error_log', APPLICATION_PATH . '/logs/' . date('Y-m-d') . '.txt');

        $message = "Uncaught exception: '" . get_class($exception) . "'";
        $message .= " with message '" . $exception->getMessage() . "'";
        $message .= "\nStack trace: " . $exception->getTraceAsString();
        $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();

        error_log($message);
    }

    /**
     * The method makes error info string.
     *
     * @param Exception $exception  The exception
     * @return string
     */
    public static function getErrorInfo($exception) : string 
    {
        $errorinfo = "";
        $errorinfo .= "<h1>Fatal error</h1>";
        $errorinfo .= "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
        $errorinfo .= "<p class=\"text-danger\">Message: '" . $exception->getMessage() . "'</p>";
        $errorinfo .= "<p class=\"text-warning text-left\">Stack trace:<br /><span>" . nl2br($exception->getTraceAsString()) . "</span></p>";
        $errorinfo .= "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
        return $errorinfo;
    }
}