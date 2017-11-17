<?php 
namespace App\Controllers\Admin;

class Users extends \Core\Controller
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
    public function indexAction()
    {
        echo "User admin index";
    }
}