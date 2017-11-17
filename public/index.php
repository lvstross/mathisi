<?php 
/**
* Front controller
*/

/**
* Autoloader
*/
spl_autoload_register(function ($class) {
    $root = dirname(__DIR__); // get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});

$router = new Core\Router();

// Flexable Routes 
$router->add('{controller}/{action}'); // - /posts/edit 
// Custom Routes: {name:regex}
$router->add('{controller}/{id:\d+}/{action}'); // - /posts/23/edit
$router->add('{controller}/{name:[a-z]+}/{id:\d+}/{action}'); // - /posts/levi/23/add 
// Fixed Routes with optional parameters
$router->add('/', ['controller' => 'Home', 'action' => 'index']);
$router->add('/posts', ['controller' => 'Posts', 'action' => 'addNew']);
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

$router->dispatch($_SERVER['REQUEST_URI']);



/*
//Display the routing table and show the matched routes
echo '<pre>';
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';

$url = $_SERVER['REQUEST_URI'];
if($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
}else{
    echo "No route found for URL '$url' <br><br>";
}
*/