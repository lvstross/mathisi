<?php 
namespace Core;

use \Twig_Environment as twig_env;
use \Twig_Loader_filesystem as twig_system;

/**
* Core View Class
*/
class View
{
    /**
    * Render a view file
    *
    * @param string $view the View file
    * @return void
    */
    public static function render($view, $args=[])
    {
        extract($args, EXTR_SKIP);
        $file = "../App/Views/$view"; // relative to Core directory
        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    /**
    * Render a view template using Twig
    *
    * @param string $template The template file
    * @param array $args Associative array of data to display in the view (optional)
    *
    * @return void
    */
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;
        if($twig === null) {
            $loader = new twig_system('../App/Views');
            $twig = new twig_env($loader);
            if(isset($_SESSION['id'])){
                $twig->addGlobal('user', \Core\Auth::getUser());
            }
        }
        echo $twig->render($template, $args);
    }
}