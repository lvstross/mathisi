<?php 
/**
* Composer Autoloader
*/
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
* Error and Exception handling
*/
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
* Routes
*/
require_once dirname(__DIR__) . '/Routes/routes.php';