<?php
namespace App\Controllers;

use \Core\View;

class Posts extends \Core\Controller
{
    /**
    * Show the index page
    * @return void
    */
    public function index()
    {
       View::renderTemplate('Posts/index.html');
    }

    /**
    * Show the add new page
    * @return void
    */
    public function addNew()
    {
        echo "Hello from the addNew action in the Posts controller!";
    }
}