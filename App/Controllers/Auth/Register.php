<?php 
namespace App\Controllers\Auth;

use \Core\View;
use \App\Models\User;
use \Core\Controller as BaseController;

class Register extends BaseController
{
    /**
    * Show the signup page
    *
    * @return void
    */
    public function form()
    {
        View::renderTemplate('Auth/register.html');
    }

    /**
    * Register User
    *
    * @return void
    */
    public function create()
    {
        $user = new User($_POST);
        $user->save();
        echo "Successfully added user";
    }
}
