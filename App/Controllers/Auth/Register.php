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
        if($user->save()){
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/register/success', true, 303);
            exit;
        } else {
            View::renderTemplate('Auth/register.html', [
                'user' => $user
            ]);
        }
    }

    /**
    * Success Action
    *
    * @return void
    */
    public function success()
    {
        View::renderTemplate('Auth/success.html');
    }
}
