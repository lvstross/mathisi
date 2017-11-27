<?php
namespace Core;

/**
* Core Router Class
*/
class Router
{
    /**
    * Associative array of routes (the routing table)
    * @var array
    */
    protected $routes = [];

    /**
    * Parameters from the matched route
    * @var array
    */
    protected $params = [];

    /**
    * Add a route to the routing table and converting to regular expressions
    * @param string $route the route URL
    * @param array $params Parameters (controller, action, etc,)
    *
    * @return void
    */
    public function add($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);
        // Check for varibales
        if(strpos($route, '{', 1)){
            // Convert variables e.g. {controller}
            $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
            // Convert variables with custom regular expressions e.g. {id:\d+}
            $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
            // Add starting forward slash, start and end delimiters, and case insensitive flag
            $route = '/^\/' . $route . '$/i';
        }else{
            // start and end delimiters, and case insensitive flag
            $route = '/^' . $route . '$/i';
        }
        $this->routes[$route] = $params;
    }

    /**
    * Get all the routes from the routing table
    *
    * @return array
    */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
    * Match the route to the routes in the routing table, setting the $params
    * property if a route is found.
    *
    * @param string $url the route URL
    *
    * @return boolean true if a match found, false otherwise
    */
    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if(preg_match($route, $url, $matches)) {
                foreach($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
    * Get the currently matched parameters
    *
    * @return array
    */
    public function getParams()
    {
        return $this->params;
    }

    /**
    * something
    *
    * @param string $url The route URL
    * @return void
    */
    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariables($url);

        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNamespace() . $controller;

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if (preg_match('/actions$/i', $action) == 0) {
                    $controller_object->$action();
                } else {
                    throw new \Exception("Method $action (in controller $controller) not found");
                }
            } else {
                throw new \Exception("Controller class $controller not found");
            }
        } else {
            View::renderTemplate('404.html');
        }
    }

    /**
    * Convert the string with hyphens to StudlyCaps,
    * e.g. post-aurthors => PostAuthors
    *
    * @param string $string The String to convert
    * @return string
    */
    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
    * Convert the string with hyphens to camelCase,
    * e.g. add-new => addNew
    *
    * @param string $string The string to convert
    * @return string
    */
    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    /**
    * Remove query strings so that the route can match.
    * 
    * @param string $url the full URL
    * @return string the URL with the query string variables removed
    */
    protected function removeQueryStringVariables($url)
    {
        if($url != ''){
            if (strpos($url, '?') != false){
                $parts = explode('?', $url);
                if (strpos($parts[0], '=') === false) {
                    $url = $parts[0];
                }else{
                    $url = '';
                }
            }
        }
        return $url;
    }

    /**
    * Get the namespace for the controller class. The namesspace defined in the
    * route parameters is added if present.
    *
    * @return string The request URL
    */
    protected function getNamespace()
    {
        $namespace = 'App\Controllers\\';
        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }
        return $namespace;
    }

} // end of class