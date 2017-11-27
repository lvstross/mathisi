<?php
namespace Core;

use Core\Auth;

/**
* Base Controller
*/
abstract class Controller
{
    /**
    * Parameters from the matched route
    * @var array
    */
    protected $route_params = [];

    /**
    * Class contructor
    *
    * @param array $route_params Parameters from the route
    * @return void
    */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    /**
    * Before filter - called before an action method.
    *
    * @return void
    */
    protected function before()
    {
    }

    /**
    * After filter - called after an action method.
    *
    * @return void
    */
    protected function after()
    {   
    }

    /**
    * calling before and after methods on every controller that declares them
    * 
    */
    public function __call($name, $args)
    {
        $method = $name . 'Action';
        if (method_exists($this, $method)) {
            if ($this->before() != false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
    * Dump and Die
    *
    * @return dumped variable
    */
    public function dd($var)
    {
        var_dump($var);
        die();
    }

    /**
    * Check it user is authenticated
    *
    * @return void
    */
    public function middleware()
    {
        Auth::rememberRequestedPage();
        if(Auth::getUser()){
            return;
        }
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/login", true, 303);
        exit;
    }

    /**
    * Redirect to a different page
    *
    * @param string $url The relative URL
    * @return void
    */
    public function redirect($url)
    {
        header("Location: http://" . $_SERVER['HTTP_HOST'] . $url, true, 303);
        exit;
    }
}