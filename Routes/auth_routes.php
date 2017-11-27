<?php

//  ===== Auth routes =====
/**
* These routes are added for the authentication system.
*/

// Show the registration page
$router->add('/register', [
    'controller' => 'Register',
    'action' => 'form',
    'namespace' => 'auth'
]);
// Create new user
$router->add('/register/create', [
    'controller' => 'Register',
    'action' => 'create',
    'namespace' => 'auth'
]);
// Show the registers success page
$router->add('/register/success', [
    'controller' => 'Register',
    'action' => 'success',
    'namespace' => 'auth'
]);
// Show the login page
$router->add('/login', [
    'controller' => 'Login',
    'action' => 'form',
    'namespace' => 'auth'
]);
// Authenticate
$router->add('/login/login', [
    'controller' => 'Login',
    'action' => 'login',
    'namespace' => 'auth'
]);
// Log the user out
$router->add('/login/logout', [
    'controller' => 'login',
    'action' => 'logout',
    'namespace' => 'auth'
]);