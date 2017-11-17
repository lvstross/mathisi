<?php
namespace App\Controllers;
use \Core\View;

class Home extends \Core\Controller
{
    /**
    * Before filter
    *
    * @return void
    */
    protected function before()
    {
        // echo "this was ran before the used action ";
        // return false;
    }

    /**
    * After filter
    *
    * @return void
    */
    protected function after()
    {
        // echo " This method was ran after the used action";
    }

    /**
    * Show the index page
    * @return void
    */
    public function index()
    {
        View::renderTemplate('Home/index.html', [
            'name' => 'Levi',
            'colors' => ['red', 'green', 'blue'] 
        ]);
    }
}