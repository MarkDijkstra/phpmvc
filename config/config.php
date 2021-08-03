<?php

// These values need to be moved to an .env file (todo)
# Project
define('PROJECT_DIR', 'phpmvc');


# DB
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'phpmvc');
define('DB_CHAR', 'utf8mb4');

# Global
define('SHOW_ERRORS', true);
define('DEFAULT_ROUTE', '/');
define('APPLICATION_PATH', substr(realpath(dirname(__FILE__)), 0, -6));

# Env
define('ENV', 'dev');