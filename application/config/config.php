<?php
/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show important errors in production.
 * Set to 0 in production!!!
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: Headers
 * Useful to add some extra headers for security purpose.
 */
header('Cache-Control: no-cache, must-revalidate');
header('Strict-Transport-Security: max-age=16070400; includeSubDomains');
header('X-Frame-Options: deny');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
//header("Content-Security-Policy: default-src 'self'");

/**
 * Configuration for: Project URL
 * Put your URL here, for local development "127.0.0.1" or "localhost" (plus sub-folder) is fine
 * HTTPS Protocol should now be used as default
 */
define('URL', 'http://localhost/SIL3/Projet/');

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_TYPE', 'sqlite:db.sqlite');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'galeriephotomvc');
define('DB_USER', 'root');
define('DB_PASS', 'password');
