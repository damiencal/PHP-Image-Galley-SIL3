<?php

/**
 * A PHP MVC Image Gallery
 * @author Damien Calvignac
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load application config (error reporting etc.)
require 'application/config/config.php';

// load application class
require 'application/libs/application.php';
require 'application/libs/controller.php';

// start the application
$app = new Application();
