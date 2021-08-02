<?php

// These values need to be moved to an .env file (todo)
# Project
define('PROJECT_DIR', 'phpmvc');


# DB
define('DB_HOST', 'localhost');
define('DB_USER', 'YOUR_USERNAME');
define('DB_PASS', 'YOUR_PASS');
define('DB_NAME', 'YOUR_DATABASE_NAME');
define('DB_CHAR', 'utf8mb4');

# Global
define('SHOW_ERRORS', true);
define('DEFAULT_ROUTE', 'home');
define('APPLICATION_PATH', substr(realpath(dirname(__FILE__)), 0, -6));

# Env
define('ENV', 'dev');