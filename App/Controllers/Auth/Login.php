<?php 
namespace App\Controllers\Auth;

use \Core\View;
use \App\Models\User;
use \Core\Controller as BaseController;

class Login extends BaseController
{
    /**
    * Show the login page
    *
    * @return void
    */
    public function form()
    {
        View::renderTemplate('Auth/login.html');
    }

    /**
    * Log in a user
    * @return void
    */
    public function login()
    {
        $user = new User($_POST);
        if($user->authenticate()){
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/', true, 303);
            exit;
        } else {
            View::renderTemplate('Auth/login.html', [
                'user' => $user
            ]);
        }
    }
}
