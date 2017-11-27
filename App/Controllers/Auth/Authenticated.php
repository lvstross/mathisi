<?php 

namespace App\Controllers\Auth;

/**
* App Authenticated base controller
* 
* Apart of the authentication system
*/
abstract class Authenticated extends \Core\Controller
{
    /**
    * Run middleware before every [method]Action call
    *
    * @return void
    */
    protected function before()
    {
        $this->middleware();
        return true;
    }
}