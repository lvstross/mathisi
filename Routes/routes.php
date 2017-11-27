<?php 
use Core\Router as Router;
/**
* All routes must either be defined in this file or required in this file
*/

// Router instance
$router = new Router();

/**
* Default Routes for Docs and Home page
*/
$router->add('/', ['controller' => 'Home', 'action' => 'index']);
$router->add('/docs', ['controller' => 'Home', 'action' => 'docs']);


/**
* Routes defined for default app
*/
require 'post_routes.php';

/**
* Routes defined for authentication system
*/
require 'auth_routes.php';

/**
* Dispatch Current Route
*/
$router->dispatch($_SERVER['REQUEST_URI']);





// Uncomment to display the routing table and show the matched routes
/*
echo '<pre>';
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';
*/

// Uncomment to show the current routes controller|action|(and,or) namespace
/*
$url = $_SERVER['REQUEST_URI'];
if($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
}else{
    echo "No route found for URL '$url' <br><br>";
}
*/