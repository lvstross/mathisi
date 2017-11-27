<?php 
namespace App\Controllers\Auth;

use Core\View;
use App\Models\User;
use Core\Auth;
use Core\Controller as BaseController;

/**
* App Login Class
* 
* Apart of the authentication system
*/
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
            $this->redirect(Auth::getReturnToPage());
        } else {
            View::renderTemplate('Auth/login.html', [
                'user' => $user
            ]);
        }
    }

    /**
    * Log the user out
    *
    * @return void
    */
    public function logout()
    {
        Auth::destroySession();
        $this->redirect('/');
    }
}
