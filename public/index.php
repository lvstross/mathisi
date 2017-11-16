<?php 
/**
* Front controller
*/
require '../Core/Router.php';
$router = new Router();

/**
* Defining Routes
*/
// Flexable Routes 
$router->add('{controller}/{action}'); // - /posts/edit 
// or
$router->add('{action}/{controller}'); // - /edit/posts 


// Custom Routes: {name:regex}
$router->add('{controller}/{id:\d+}/{action}'); // - /posts/23/edit
$router->add('{controller}/{name:[a-z]+}/{id:\d+}/{action}'); // - /posts/levi/23/add 


// Fixed Routes with optional parameters
$router->add('/', ['controller' => 'CommentsController', 'action' => 'getComments']);
$router->add('/posts', ['controller' => 'PostsController', 'action' => 'getPosts']);


//Display the routing table
echo '<pre>';
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';

/** 
* Match the requested route and mapping the url to the variable names
* Route must be defined above in order for it to match
*/
$url = $_SERVER['REQUEST_URI'];
if($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
}else{
    echo "No route found for URL '$url' ";
}
