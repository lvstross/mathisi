<?php 
namespace App\Controllers\Auth;

use App\Models\Auth\User;
use Core\View;
use Core\Auth;
use Core\Flash;
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
            if(isset($_POST['remember_me'])){
                $user->rememberLogin();
                setcookie('remember_me', $user->remember_token, $user->expire_date, '/');
            }
            Flash::addMessage('Login successful', Flash::SUCCESS);
            $this->redirect(Auth::getReturnToPage());
        } else {
            Flash::addMessage('Login unsuccessful, please try again', Flash::WARNING);
            View::renderTemplate('Auth/login.html', [
                'user' => $user,
                'remember_me' => $remember_me
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
        Flash::addMessage('Logout Successful!', Flash::SUCCESS);
        $this->redirect('/');
    }
}
