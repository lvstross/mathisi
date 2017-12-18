<?php 
/**
* Composer Autoloader
*/
require_once dirname(__DIR__) . '/vendor/autoload.php';


/**
* Symfony Dotenv Loader config
*/
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');
// For several files
// $dotenv->load(
//     dirname(__DIR__) . '/env', 
//     dirname(__DIR__) . '/env.dev'
// );

/**
* Error and Exception handling
*/
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
* Session Starter
*/
session_start();


/**
* Routes Loader
*/
require_once dirname(__DIR__) . '/Routes/routes.php';

/**
* Symfony Vardumps Configuration
*/
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

VarDumper::setHandler(function ($var) {
    $cloner = new VarCloner();
    $dumper = 'cli' === PHP_SAPI ? new CliDumper() : new HtmlDumper();

    $dumper->dump($cloner->cloneVar($var));
});