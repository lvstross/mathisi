<?php
namespace Core;

use \Core\Mail;

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
    * calling before and after methods on every controller that declares them
    * 
    */
    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            echo "Method $method not found in controller " . get_class($this);
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

}