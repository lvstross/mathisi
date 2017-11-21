<?php 
use Core\Router as Router;

$router = new Router();

// Variable Pattern Routes
$router->add('{action/{controller}'); // - /posts/edit 
// Custom Variable Routes: {name:regex}
$router->add('{controller}/{id:\d+}/{action}'); // - /posts/23/edit
$router->add('{controller}/{name:[a-z]+}/{id:\d+}/{action}'); // - /posts/levi/23/add 
// Routes with parameters
$router->add('/', ['controller' => 'Home', 'action' => 'index']);
$router->add('/posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('/api/posts', ['controller' => 'Posts', 'action' => 'all']);
$router->add('/admin/users/index', [
    'controller' => 'Users', 
    'action' => 'index', 
    'namespace' => 'Admin'
]);

// Dispatch Current Route
$router->dispatch($_SERVER['REQUEST_URI']);
var_dump($_SERVER['REQUEST_METHOD']);



//Display the routing table and show the matched routes
/*
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