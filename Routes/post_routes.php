<?php
/**
* Routes for default posts app
*/
$router->add('/posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('/api/posts', ['controller' => 'Posts', 'action' => 'all']);