<?php 
namespace App\Controllers\Admin;
use \Core\Controller as BaseController;


class Users extends BaseController
{
    /**
    * Before filter
    *
    * @return void
    */
    protected function before()
    {
        // return false;
    }

    /**
    * Show the index page
    * @return void
    */
    public function index()
    {
        echo "User admin index";
    }
}