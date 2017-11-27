<?php
namespace App\Controllers;

use Core\View;
use Core\Auth;
use Core\Controller as BaseController;

class Home extends BaseController
{
    /**
    * Show the index page
    * @return void
    */
    public function index()
    {
        View::renderTemplate('Home/index.html');
    }

    /**
    * Show the documentation page
    * @return void
    */
    public function docs()
    {
        View::renderTemplate('Home/docs.html');
    }
}